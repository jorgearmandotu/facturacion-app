<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Cstate;
use App\Models\Line;
use App\Models\Product;
use App\Models\Tax;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProductsController extends Controller
{
    public function index() {
        // $products = Product::all();
        // $list = [];
        // foreach($products as $product){
        //     $list[] = $product->groups->lines;
        // }
        // return $list;
        // $products = DB::select('select p.id as id, p.name as name, l.name as line, g.name as "group", p.code as code, c.value as state, reference , costo, price, profit from products p join `groups` g ON p.group_id = g.id join `lines` l on l.id = g.line_id join cstates c on p.cstate_id = c.id ');

        $products = DB::select('select * from products_list_view');
        return DataTables()->collection($products)->toJson();
        //
    }

    public function viewProducts(){
        $taxes = Tax::all();
        return view('admin.products', compact('taxes'));
    }

    public function store(StoreProductRequest $request) {
        try{
            $product = Product::where('group_id', $request->group)
                                ->where('code', $request->code)->first();
            if($product) return redirect()->back()->withErrors('No fue posible crearRegistro. Código de producto ya existe en este grupo');
            //guardar producto
            $product = new Product();
            //$product->line = $request->line;
            $product->group_id = $request->group;
            $product->code = $request->code;
            $product->name = mb_strtoupper($request->name,"UTF-8");
            $product->costo = $request->costo;
            $product->profit = $request->profit;
            $product->price = $request->price;
            $product->reference = $request->reference;
            $product->bar_code = $request->bar_code;
            $state = ($request->state) ? Cstate::where('value', 'Activo')->first() : Cstate::where('value', 'Inactivo')->first();
            $product->cstate_id = $state->id;
            $now = new \DateTime();
            //echo $now->format('d-m-Y H:i:s');
            $product->date = Carbon::now()->format('Y-m-d');
            $product->save();
            return back()->with('success', 'Ingreso exitoso');

        }catch (Exception $e){
            return redirect()->back()->withErrors('No fue posible crearRegistro. '.$e);
        }
        //return redirect(route('admin/products/create'))->with('success', 'Ingreso exitoso');
        //Redirect->to('admin/');
    }

    public function create(){
        $lines = Line::all();
        $taxes = Tax::all();
        return view('admin.create_products',compact('lines', 'taxes'));
    }

    public function update(Product $product) {
        try {
            //$product = Product::find($product);
            if($product){
                $state = ($product->cstates->value == 'Activo') ? Cstate::where('value', 'Inactivo')->first() : Cstate::where('value', 'Activo')->first();
                //$state = $product->cstates;//Cstate::find($product->cstate_id);
                //$state = ($state->value == 'Activo') ? Cstate::where('value', 'Inactivo')->first() : Cstate::where('value', 'Activo')->first();
                $product->cstate_id = $state->id;
                $product->save();
                return response()->json(['msg' => 'Operacion exitosa', 'status' => 200], 200);
            }
        }catch(Exception $e){
            return response()->json(['msg' => 'Error en servidor contacte al administrador: '.$e ], 400);
        }
    }

    public function show (Product $product){
        return response()->json($product);
    }
}
