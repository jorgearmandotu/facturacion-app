<?php

namespace App\Http\Controllers;

use App\Models\CategoriesDischarge;
use App\Models\CompanyData;
use App\Models\CpaymentMethods;
use App\Models\Cstate;
use App\Models\Discharge;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

class DischargeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:discharges')->only(['index', 'create', 'store', 'storeCategory', 'listCategories', 'printDischarge']);
    }
    //crea categorias de egresos
    public function index(){
        return view('admin.categories_discharge');
    }

    //crea egreso
    public function create(){
        $categories = CategoriesDischarge::all();
        $date = Carbon::now()->isoFormat('dddd D [de] MMMM [de] YYYY');
        $paymentMethods = CpaymentMethods::all();
        return view('admin.discharge_create', compact('categories', 'date', 'paymentMethods'));
    }

    //guarda egresos
    public function store(Request $request){
        $validate = $request->validate([
            'category' => 'required',
            'mount' => 'required|numeric|min:1000',
            'description' => 'required|min:5',
            'method_payment' => 'required',
        ],
        [
            'category.required' => 'La categoria de egreso es requerida',
            'mount' => 'El valor del monto es requerido, y debe ser numerico mayor a 1000',
            'description' => 'La descripción del egreso es requerida',
            'method_payment' => 'Metodo de pago es requerido',
        ]);
        if($validate){
            try{
                $state = Cstate::where('value', 'Activo')->first();
                $discharge = Discharge::create([
                    'category_discharge' => $request->category,
                    'description' => $request->description,
                    'mount' => $request->mount,
                    'date' => Carbon::now()->format('Y-m-d'),
                    'user_id' => Auth::id(),
                    'cstate_id' => $state->id,
                    'payment_method' => $request->method_payment,
                ]);
                return redirect('admin/printDischarge/'.$discharge->id);
            }catch(\Exception $e){
                return back()->withInput()->with('fatal', 'No fue posible generar el egreso, intyente mas tarde o contacte con el administrador del sistema'.$e);
            }
        }
    }

    public function storeCategory(Request $request){
        try{
            $validated = $request->validate([
                'name' => 'required|unique:categories_discharges,name',
            ],
            [
                'name.required' => 'El nombre de categoria es requerido',
                'name.unique' => 'El nombre de la categoria ya esta registrado',
            ]);
        }catch(\Illuminate\Validation\ValidationException $e){
            $errors = new MessageBag($e->errors());
            return response()->json([
                'errors' => $errors,'status' => 400
            ], 200);
        }
        try{
            if($validated){
                $category = new CategoriesDischarge();
                $category->name = strtoupper($request->name);
                $state = Cstate::where('value', 'Activo')->first();
                $category->cstate_id = $state->id;
                $category->save();
                return response()->json(['msg' => 'Categoria creada con exito', 'status' => 200], 200);
            }
        }catch(\Exception $e){
            return response()->json(['msg' => 'No fue posible crear categoria, intente mas tarde', 'status' => 400], 200);
        }
    }

    public function listCategories(){
        $categories = CategoriesDischarge::all();
        return DataTables()->collection($categories)->toJson();
    }

    public function printDischarge($id){
        $discharge = Discharge::find($id);
        $company = CompanyData::latest('id')->first();
        $user = User::find($discharge->user_id);
        return view('admin.print.print-discharge', compact('discharge', 'company', 'user'));
    }
}