<?php

namespace App\Http\Controllers;

use App\Models\Cstate;
use App\Models\CtypesNotes;
use App\Models\Location;
use App\Models\LocationProduct;
use App\Models\Notes;
use App\Models\NotesProducts;
use App\Models\Product;
use App\Models\ProductsMovements;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class NotesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:notasAjuste')->only([ 'index', 'store']);
    }

    public function index(){
        $products = Product::all();
        $types = CtypesNotes::where('description', 'like', '%Nota%')->get();
        $locations = Location::where('cstate_id', Cstate::where('value', 'Activo')->first()->id)->get();
        return view('admin.create_notes', compact('products', 'types', 'locations'));
    }

    public function store(Request $request) {
        if( !$request->typeNote || !$request->location){
            return response()->json(['msg' => 'Verifique tipo de nota y ubicación', 'status' => 400], 200);
        }
        if(!$request->totalItems || $request->totalItems < 1 || !$request->totalView) {
            return response()->json(['msg' => 'Verifique Productos registrados', 'status' => 400], 200);
        }
        //validar datos de nota
        try{
            $request->validate([
                'typeNote' => 'required|exists:ctypes_notes,id',
                'location' => 'required|exists:locations,id',
                'description' => 'max:230',
            ]);
        }catch (\Exception $e){
            return response()->json(['msg' => 'verifique el tipo de nota y la ubicación'.$e, 'status' => 400], 200);
        }
        //crear la nota y afectar inventario
        DB::beginTransaction();
        try{
            $note = new Notes();
            $typeNote = CtypesNotes::find($request->typeNote);
            if( stripos($typeNote->description, 'nota')){
            return response()->json(['msg' => 'verifique el tipo de nota.', 'status' => 400], 200);
            }
            $note->type = $request->typeNote;
            $note->location_id = $request->location;
            $note->description = $request->description;
            $note->save();
            // foreach ($request->all() as $key => $value) {
                //     if (strpos($key, 'product') === 0) {
                    //         $position = intval(substr($key, strlen('product')));
                    //         $product = $value;
                    //         $quantity = $request->input('cant' . $position);

                    //         $dataNote = new NotesProducts();
                    //         $dataNote->product_id = $product;
                    //         $dataNote->note_id = $note->id;
                    //         $dataNote->quantity = $quantity;
                    //         $dataNote->save();
                    // }}
                for($i=0; $i<$request->totalView; $i++){
                    $position = $i+1;
                    $value = 'product'.$position;
                    $product = $request->$value;
                    $value = 'cant'.$position;
                    $quantity = $request->$value;
                    if($product && $quantity){
                        $dataNote = new NotesProducts();
                        $dataNote->product_id = $product;
                        $dataNote->note_id = $note->id;
                        $dataNote->quantity = $quantity;
                        $dataNote->save();

                        //actualizo inventario
                        $typeNote = CtypesNotes::find($request->typeNote);


                        if($typeNote->action == 'entrada'){
                            $locationProduct = LocationProduct::where('location_id', $note->location_id)->where('product_id', $product)->first();
                            if($locationProduct){
                                $locationProduct->stock = $locationProduct->stock + $quantity;
                                $locationProduct->save();
                            }else{
                                $locationProduct = new LocationProduct();
                                $locationProduct->location_id = $note->location_id;
                                $locationProduct->product_id = $product;
                                $locationProduct->stock = $quantity;
                                $locationProduct->save();
                            }


                            $productMovement = new ProductsMovements();
                            $productMovement->type = 'Entrada';
                            $productMovement->product_id = $product;
                            $productMovement->quantity = $quantity;
                            $locations = LocationProduct::where('product_id', $product)->get();
                            $totalProduct = 0;
                            foreach($locations as $location){
                                $totalProduct += $location->stock;
                            }
                            $productMovement->saldo = $totalProduct;
                            $productMovement->document_type = $note->type;
                            $productMovement->document_id = $note->id;
                            $productMovement->location_id = $note->location_id;
                            $productMovement->save();
                        }
                        if($typeNote->action == 'salida'){
                            $locationProduct = LocationProduct::where('location_id', $note->location_id)->where('product_id', $product)->first();
                            if($locationProduct){
                                $locationProduct->stock = $locationProduct->stock - $quantity;
                                $locationProduct->save();
                            }else{
                                $locationProduct = new LocationProduct();
                                $locationProduct->location_id = $note->location_id;
                                $locationProduct->product_id = $product;
                                $locationProduct->stock = -$quantity;
                                $locationProduct->save();
                            }

                            $productMovement = new ProductsMovements();
                            $productMovement->type = 'Salida';
                            $productMovement->product_id = $product;
                            $productMovement->quantity = $quantity;
                            $locations = LocationProduct::where('product_id', $product)->get();
                            $totalProduct = 0;
                            foreach($locations as $location){
                                $totalProduct += $location->stock;
                            }
                            $productMovement->saldo = $totalProduct;
                            $productMovement->document_type = $note->type;
                            $productMovement->document_id = $note->id;
                            $productMovement->location_id = $note->location_id;
                            $productMovement->save();
                        }
                    }


                }
            DB::commit();
            return response()->json(['msg' => 'Nota creada', 'Nota' => $note->id, 'status' => 200], 200);
        }catch (QueryException $e) {
            // Manejo específico para excepciones de consulta (QueryException)
            DB::rollBack();
            return response()->json(['msg' => 'No fue posble ingresar datos en base de datos, verifique la información .'.$e, 'status'=>400], 200);
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['msg' => 'Error en el servidor. '.$e, 'status' => 400], 200);

        }
    }
}
