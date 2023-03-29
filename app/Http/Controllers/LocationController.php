<?php

namespace App\Http\Controllers;

use App\Models\Cstate;
use App\Models\Location;
use Exception;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:locations.index')->only(['index']);
        $this->middleware('can:locations.store', ['only' => ['create', 'store']]);
        $this->middleware('can:locations.update', ['only' => ['update']]);
    }

    public function index(){
        $lines = Location::join('cstates', 'locations.cstate_id', '=', 'cstates.id')
                ->select('locations.id as id', 'cstates.value as state', 'locations.name as name')->get();
        return DataTables()->collection($lines)->toJson();
    }

    public function store(Request $request){
        try{
            if($request->name == ''){
                return response()->json(['msg' => 'Datos invalidos'], 203);
            }
            $location = Location::where('name', $request->name)->first();
            if($location){
                return response()->json(['msg' => 'Ubicación "'.$request->name.'" ya esta registrado'], 203);
            }
            if($request->state){
                $state = Cstate::where('value', 'Activo')->first();
            }else{
                $state = Cstate::Where('value', 'Inactivo')->first();
            }
            $location = new Location();
            $location->name = mb_strtoupper($request->name,"UTF-8");
            $location->cstate_id = $state->id;
            $location->save();

            return response()->json(['msg' => 'Ingreso exitoso', 'status' => 200], 200);
        }catch(Exception $e){
            return response()->json(['msg' => 'Error en servidor contacte al administrador: '.$e ], 400);
        }
    }

    public function update(Request $request, $location) {
        try {
            $location = Location::find($location);
            if($location){
                $state = ($location->cstates->value == 'Activo') ? Cstate::where('value', 'Inactivo')->first() : Cstate::where('value', 'Activo')->first();
                //$state = Cstate::find($location->cstate_id);
                //$state = ($state->value == 'Activo') ? Cstate::where('value', 'Inactivo')->first() : Cstate::where('value', 'Activo')->first();
                $location->cstate_id = $state->id;
                $location->save();
                return response()->json(['msg' => 'Operacion exitosa', 'status' => 200], 200);
            }
        }catch(Exception $e){
            return response()->json(['msg' => 'Error en servidor contacte al administrador: '.$e ], 400);
        }
    }

}
