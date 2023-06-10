<?php

namespace App\Http\Controllers;

use App\Models\Cstate;
use App\Models\Group;
use Exception;
use Illuminate\Http\Request;

class GroupController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:groups.index')->only(['index']);
        $this->middleware('can:groups.store', ['only' => ['create', 'store']]);
        $this->middleware('can:groups.update', ['only' => ['update']]);
    }

    public function index(){
        $lines = Group::join('cstates', 'groups.cstate_id', '=', 'cstates.id')
                ->join('lines', 'line_id', '=', 'lines.id')
                ->select('groups.id as id', 'cstates.value as state', 'groups.name as name', 'lines.name as line')->get();
        return DataTables()->collection($lines)->toJson();
    }

    public function store(Request $request){
        try{
            if($request->name == ''){
                return response()->json(['msg' => 'Datos invalidos'], 203);
            }
            $group = Group::where('name', $request->name)->where('line_id', $request->line)->first();
            if($group){
                return response()->json(['msg' => 'Grupo "'.$request->name.'" ya esta registrado para esta linea'], 203);
            }
            if($request->state){
                $state = Cstate::where('value', 'Activo')->first();
            }else{
                $state = Cstate::Where('value', 'Inactivo')->first();
            }
            $group = new Group();
            $group->name = mb_strtoupper($request->name,"UTF-8");
            $group->line_id = $request->line;
            $group->cstate_id = $state->id;
            $group->save();

            return response()->json(['msg' => 'Ingreso exitoso', 'status' => 200], 200);
        }catch(Exception $e){
            return response()->json(['msg' => 'Error en servidor contacte al administrador: '.$e ], 400);
        }
    }

    public function update(Request $request, $group) {
        try {
            $group = Group::find($group);
            if($group){
                $state = ($group->cstates->value == 'Activo') ? Cstate::where('value', 'Inactivo')->first() : Cstate::where('value', 'Activo')->first();
                //$state = $group->cstates; //Cstate::find($group->cstate_id);
                //$state = ($state->value == 'Activo') ? Cstate::where('value', 'Inactivo')->first() : Cstate::where('value', 'Activo')->first();
                $group->cstate_id = $state->id;
                $group->save();
                return response()->json(['msg' => 'Operacion exitosa', 'status' => 200], 200);
            }
        }catch(Exception $e){
            return response()->json(['msg' => 'Error en servidor contacte al administrador: '.$e ], 400);
        }
    }
}
