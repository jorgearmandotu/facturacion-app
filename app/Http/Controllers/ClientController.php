<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Document_type;
use Exception;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(){
        $types = Document_type::all();
        return view('admin.clients', compact('types'));
    }

    public function listClients(){
        $clients = Clients::join('document_types', 'clients.document_type', 'document_types.id')
                    ->select('document_types.name as document_type', 'dni', 'clients.name as name', 'phone', 'address', 'email', 'clients.id as id' )->get();
        return DataTables()->collection($clients)->toJson();
    }

    public function store(Request $request) {
        try{
            if(!$request->document_type || !$request->dni || !$request->name){
                return response()->json(['msg' => 'Identificación de cliente es necesaria'], 200);
            }
            $client = Clients::where('dni', $request->dni)->first();
            if($client){
                return response()->json(['msg' => 'Identificación de cliente ya existe'], 200);
            }
            $client = new Clients();
            $client->dni = $request->dni;
            $client->document_type = $request->document_type;
            $client->name = mb_strtoupper($request->name, 'UTF-8');
            $client->phone = ($request->phone) ? $request->phone : '';
            $client->address = ($request->address) ? mb_strtoupper($request->address, 'UTF-8') : '';
            $client->email = ($request->email) ? mb_strtoupper($request->email, 'UTF-8') : '';
            $client->save();
            return response()->json(['msg' => 'Registro exitoso', 'status' => '200'], 200);
        }catch(Exception $e){
            return response()->json(['msg' => 'No fue posible procesar su solicitud'], 200);
        }
    }

    public function show(Clients $client){
        //$client = Clients
        return response()->json($client);
    }

    public function update(Clients $client, Request $request){
        try {
            $client->dni = $request->dni;
            $client->document_type = $request->document_type;
            $client->name = mb_strtoupper($request->name, 'UTF-8');
            $client->phone = ($request->phone) ? $request->phone : '';
            $client->address = ($request->address) ? mb_strtoupper($request->address, 'UTF-8') : '';
            $client->email = ($request->email) ? mb_strtoupper($request->email, 'UTF-8') : '';
            $client->save();
            return response()->json(['msg' => 'Registro exitoso', 'status' => '200'], 200);
        }catch(Exception $e){
            return response()->json(['msg' => 'No fue posible procesar su solicitud'], 200);
        }
    }
}
