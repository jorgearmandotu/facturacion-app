<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function index(){
        return view('admin.suppliers');
    }

    public function list(){
        $suppliers = Supplier::all();
        return DataTables()->collection($suppliers)->toJson();
    }

    public function store(Request  $request){
        try{
        if( empty($request->dni) || empty($request->name) ){
            return response()->json(['msg' => 'Todos los datos son necesarios'], 200);
        }
        $supplier = Supplier::where('dni', $request->dni)->first();
        if($supplier){
            return response()->json(['msg' => 'Identificacion de proveedor ya esta registrada'], 200);
        }
            $supplier = new Supplier();

            //guardar supplier
            $supplier->name = mb_strtoupper($request->name,"UTF-8");
            $supplier->dni = $request->dni;
            $supplier->save();
            return response()->json(['msg' => 'Ingreso exitoso', 'status' => 200], 200);

        }catch (Exception $e){
            return response()->json(['msg' => 'Error en servidor contacte al administrador: '.$e ], 400);
        }
    }
}
