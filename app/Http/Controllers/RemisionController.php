<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRemisionRequest;
use App\Models\Clients;
use App\Models\CompanyData;
use App\Models\Cstate;
use App\Models\Remision;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RemisionController extends Controller
{
    public function index(){
        return view('admin.create_remision');
    }

    public function store(StoreRemisionRequest $request){
        DB::beginTransaction();
        try{
            $client = Clients::where('dni', $request->dni)
                    ->where('document_type', $request->document_type)->first();
            if(!$client){
                $client = new Clients();
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
            return back()->with('success', 'Remison creada con exito.');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('fatal', 'No fue psible crear la remision.');
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
}
