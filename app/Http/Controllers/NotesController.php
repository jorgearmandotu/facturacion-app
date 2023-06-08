<?php

namespace App\Http\Controllers;

use App\Models\Cstate;
use App\Models\CtypesNotes;
use App\Models\Location;
use App\Models\Notes;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class NotesController extends Controller
{
    public function index(){
        $products = Product::all();
        $types = CtypesNotes::all();
        $locations = Location::where('cstate_id', Cstate::where('value', 'Activo')->first()->id)->get();
        return view('admin.create_notes', compact('products', 'types', 'locations'));
    }

    public function store(Request $request) {
        if( $request->typeNote || !$request->location){
            return response()->json(['msg' => 'Verifique tipo de nota y ubicación', 'status' => 400], 200);
        }
        if(!$request->totalItems || $request->totalItems < 1 || !$request->totalView) {
            return response()->json(['msg' => 'Verifique Productos registrados', 'status' => 400], 200);
        }
        //validar datos de nota
        try{
            $request->validate([
                'typeNote' => 'required|exists:ctypes_notes',
                'location' => 'required|exists:locations',
                'description' => 'max:230'
            ]);
        }catch (\Exception $e){
            return response()->json(['msg' => 'verifique el tipo de nota y la ubicación', 'status' => 400], 200);
        }
        //crear la nota y afectar inventario
        DB::beginTransaction();
        try{
            DB::commit();
            $note = new Notes();
            $note->type = $request->typeNote;
            $note->location_id = $request->location;
            $note->description = $request->description;
            $note->save();
            for($i=0; $i<$request->totalView; $i++){
                $position = $i+1;
            }
            return response()->json(['msg' => 'Nota creada', 'Nota' => $note->id, 'status' => 200], 200);
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['msg' => 'Verifique datos Ingresados. ', 'status' => 400], 200);

        }
    }
}
