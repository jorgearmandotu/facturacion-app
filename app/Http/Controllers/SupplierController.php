<?php

namespace App\Http\Controllers;

use App\Models\Tercero;


class SupplierController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:suppliers.index')->only(['index']);
        $this->middleware('can:suppliers-list', ['only' => ['list']]);
    }
    public function index(){
        return view('admin.suppliers');
    }

    public function list(){
        $suppliers = Tercero::where('supplier', true)->get();
        return DataTables()->collection($suppliers)->toJson();
    }

    // public function store(Request  $request){
    //     try{
    //     if( empty($request->dni) || empty($request->name) ){
    //         return response()->json(['msg' => 'Todos los datos son necesarios'], 200);
    //     }
    //     $supplier = Tercero::where('dni', $request->dni)->first();
    //     if($supplier){
    //         if($supplier->supplier){
    //             return response()->json(['msg' => 'Identificacion de proveedor ya esta registrada'], 200);
    //         }else{
    //             $supplier->supplier = true;
    //             $supplier->save();
    //         }
    //     }
    //         $supplier = new Tercero();

    //         //guardar supplier
    //         $supplier->name = mb_strtoupper($request->name,"UTF-8");
    //         $supplier->dni = $request->dni;
    //         $supplier->supplier = true;
    //         $supplier->save();
    //         return response()->json(['msg' => 'Ingreso exitoso', 'status' => 200], 200);

    //     }catch (Exception $e){
    //         return response()->json(['msg' => 'Error en servidor contacte al administrador: '.$e ], 200);
    //     }
    // }
}
