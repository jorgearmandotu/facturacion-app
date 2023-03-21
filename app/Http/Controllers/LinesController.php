<?php

namespace App\Http\Controllers;

use App\Models\Cstate;
use App\Models\Line;
use Exception;
use Illuminate\Http\Request;

class LinesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:lines.index')->only(['index']);
        $this->middleware('can:lines.store', ['only' => ['create', 'store']]);
        $this->middleware('can:lines.update', ['only' => ['update']]);
    }

    public function index(){
        $lines = Line::join('cstates', 'lines.cstate_id', '=', 'cstates.id')
                ->select('lines.id as id', 'cstates.value as state', 'lines.name as name')->get();
        return DataTables()->collection($lines)->toJson();
    }

    public function store(Request $request){
        try{
            if($request->name == ''){
                return response()->json(['msg' => 'Datos invalidos'], 203);
            }
            $line = Line::where('name', $request->name)->first();
            if($line){
                return response()->json(['msg' => 'Linea "'.$request->name.'" ya esta registrado'], 203);
            }
            if($request->state){
                $state = Cstate::where('value', 'Activo')->first();
            }else{
                $state = Cstate::Where('value', 'Inactivo')->first();
            }
            $line = new Line();
            $line->name = mb_strtoupper($request->name,"UTF-8");
            $line->cstate_id = $state->id;
            $line->save();

            return response()->json(['msg' => 'Ingreso exitoso', 'status' => 200], 200);
        }catch(Exception $e){
            return response()->json(['msg' => 'Error en servidor contacte al administrador: '.$e ], 400);
        }
    }

    public function update(Request $request, $line) {
        try {
            $line = Line::find($line);
            if($line){
                $state = ($line->cstates->value == 'Activo') ? Cstate::where('value', 'Inactivo')->first() : Cstate::where('value', 'Activo')->first();
                //$state = $line->cstates; //Cstate::find($line->cstate_id);
                //$state = ($state->value == 'Activo') ? Cstate::where('value', 'Inactivo')->first() : Cstate::where('value', 'Activo')->first();
                $line->cstate_id = $state->id;
                $line->save();
                return response()->json(['msg' => 'Operacion exitosa', 'status' => 200], 200);
            }
        }catch(Exception $e){
            return response()->json(['msg' => 'Error en servidor contacte al administrador: '.$e ], 400);
        }
    }
}
