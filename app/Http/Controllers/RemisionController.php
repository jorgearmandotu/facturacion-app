<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRemisionRequest;
use App\Models\CompanyData;
use App\Models\Cstate;
use App\Models\Remision;
use App\Models\Tercero;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RemisionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:remision.index')->only(['index']);
        $this->middleware('can:remision.store', ['only' => ['create', 'store']]);
        $this->middleware('can:printRemision', ['only' => ['printRemision']]);
        $this->middleware('can:listRemisiones', ['only' => ['listRemisiones']]);
        // $this->middleware('can:articulos.destroy', ['only' => ['destroy']]);

        // $this->middleware('can:cambiar.estado.articulos')->only(['cambio_de_estado']);
    }

    public function index(){
        return view('admin.create_remision');
    }

    public function store(StoreRemisionRequest $request){
        DB::beginTransaction();
        try{
            $client = Tercero::where('dni', $request->dni)->first();
                    //->where('document_type', $request->document_type)->first();
            if(!$client){
                $client = new Tercero();
                $client->document_type = $request->document_type;
                $client->dni = $request->dni;
            }
            $client->name = strtoupper($request->nameClient);
            $client->phone = $request->phone;
            $client->address = strtoupper($request->address);
            $client->email = strtoupper($request->email);
            $client->save();

            $remision = new Remision();
            $remision->vlr_payment = $request->payment;
            $remision->description = $request->description;
            $remision->client_id = $client->id;
            $remision->date_remision = Carbon::now()->format('Y-m-d');
            $cstate = Cstate::where('value', 'Pendiente')->first();
            $remision->cstate_id = $cstate->id;
            $remision->user_id = Auth::id();
            $remision->payment_method = $request->paymentMethod;
            $remision->vlr_total = $request->vlr_total;
            $remision->save();
            DB::commit();
            return redirect('admin/printRemision/'.$remision->id);
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('fatal', 'No fue psible crear la remision.'.$e);
        }

    }

    public function printRemision(Remision $remision){
        if(!$remision){
            return 'error al crear remision';
        }
        try{
            $seller = User::find($remision->user_id);
            $company = CompanyData::latest('id')->first();
            return view('admin.print-remision', compact('company', 'remision', 'seller'));

        }catch(\Exception $e){
            return 'Ocurrio un error al consultar los datos.';
        }
    }

    public function listRemisiones(){
        $state = Cstate::where('value', 'Pendiente')->first();
        $remisiones = Remision::where('cstate_id', $state->id)->get();

        return view('admin.list_remisiones', compact('remisiones'));
    }
}
