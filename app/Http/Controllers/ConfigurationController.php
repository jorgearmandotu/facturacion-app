<?php

namespace App\Http\Controllers;

use App\Models\CpaymentMethods;
use App\Models\Cstate;
use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Yajra\DataTables\Contracts\DataTable;

class ConfigurationController extends Controller
{
    public function index(){
        $methods_payment = CpaymentMethods::all();
        return view('admin.configuration', compact('methods_payment'));
    }

    public function paymentMethods(){
        $methods_payment = CpaymentMethods::join('cstates', 'cstates.id', 'cstate_id')->select('cpayment_methods.id as id', 'cpayment_methods.value as value', 'cstates.value as state')->get();
        return DataTables()->collection($methods_payment)->toJson();
    }

    public function listTaxes() {
        $taxes = Tax::all();
        return DataTables()->collection($taxes)->toJson();
    }

    public function statePaymentMethods(Request $request, $id){
        try{
            $method = CpaymentMethods::find($id);
            $state = ($method->state->value == 'Activo') ? Cstate::where('value', 'Inactivo')->first() : Cstate::where('value', 'Activo')->first();
            $method->cstate_id = $state->id;
            $method->save();
            return response()->json(['msg' => 'Operacion exitosa', 'status' => 200], 200);
        }catch(\Exception $e){
            return response()->json(['msg' => 'Error en servidor contacte al administrador: '], 200);
        }
    }

    public function paymentMethodsStore(Request $request){
        $validated = $request->validate([
            'value' => 'required|unique:cpayment_methods,value|max:70',
        ],
        [
        'value.required' => 'El nombre de metodo dde pago es requerido.',
        'value.unique' => 'El metodo de pago ya esta registrado.',
        'value.max' => 'El número de varacteres permitidos para el metodo de pago excede la longitud admitida.',
        ]);
        try{
            if($request->value == ''){
            return back()->with('fatal', 'El nombre de metodo de pago no puede ser vacio.');
            }
            $method = new CpaymentMethods();
            $method->value = strtoupper($request->value);
            $state = Cstate::where('value', 'Activo')->first();
            $method->cstate_id = $state->id;
            $method->save();
            return back()->with('success', 'Metodo de pago agregado.');
        }catch(\Exception $e){
            return back()->with('fatal', 'No fue posible crear metodo de pago.');
        }
    }
}
