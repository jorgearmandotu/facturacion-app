<?php

namespace App\Http\Controllers;

use App\Models\Document_type;
use App\Models\Tercero;
use Exception;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:terceros.index')->only(['index']);
        $this->middleware('can:terceros.store', ['only' => ['create', 'store']]);
        $this->middleware('can:terceros.update', ['only' => ['update']]);
        $this->middleware('can:terceros.show', ['only' => ['show']]);
        $this->middleware('can:list-terceros', ['only' => ['listClients']]);
    }

    public function index(){
        $types = Document_type::all();
        return view('admin.clients', compact('types'));
    }

    public function listClients(){
        $clients = Tercero::join('document_types', 'terceros.document_type', 'document_types.id')
                    ->select('document_types.name as document_type', 'dni', 'terceros.name as name', 'phone', 'address', 'email', 'terceros.id as id' )->get();
        return DataTables()->collection($clients)->toJson();
    }

    public function store(Request $request) {
        try{
            if(!$request->document_type || !$request->dni || !$request->name){
                return response()->json(['msg' => 'Identificación de tercero es necesaria'], 200);
            }
            $client = Tercero::where('dni', $request->dni)->first();
            if($client){
                return response()->json(['msg' => 'Identificación de tercero ya existe'], 200);
            }
            $client = new Tercero();
            $client->dni = $request->dni;
            $client->document_type = $request->document_type;
            $client->name = mb_strtoupper($request->name, 'UTF-8');
            $client->phone = ($request->phone) ? $request->phone : '';
            $client->address = ($request->address) ? mb_strtoupper($request->address, 'UTF-8') : '';
            $client->email = ($request->email) ? mb_strtoupper($request->email, 'UTF-8') : '';
            $client->supplier = ($request->supplier) ? true : false;
            $client->save();
            return response()->json(['msg' => 'Registro exitoso', 'status' => '200'], 200);
        }catch(Exception $e){
            return response()->json(['msg' => 'No fue posible procesar su solicitud'], 200);
        }
    }

    public function show(Tercero $client){
        //$client = Clients
        return response()->json($client);
    }

    public function update(Tercero $client, Request $request){
        try {
            $client->dni = $request->dni;
            $client->document_type = $request->document_type;
            $client->name = mb_strtoupper($request->name, 'UTF-8');
            $client->phone = ($request->phone) ? $request->phone : '';
            $client->address = ($request->address) ? mb_strtoupper($request->address, 'UTF-8') : '';
            $client->email = ($request->email) ? mb_strtoupper($request->email, 'UTF-8') : '';
            $client->supplier = ($request->supplier) ? true : false;
            $client->save();
            return response()->json(['msg' => 'Registro exitoso', 'status' => '200'], 200);
        }catch(Exception $e){
            return response()->json(['msg' => 'No fue posible procesar su solicitud'], 200);
        }
    }
}
