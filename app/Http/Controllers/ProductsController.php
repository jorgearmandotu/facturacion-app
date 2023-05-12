<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Cstate;
use App\Models\Line;
use App\Models\ListPrices;
use App\Models\Location;
use App\Models\LocationProduct;
use App\Models\Product;
use App\Models\ProductsMovements;
use App\Models\ProductsTaxes;
use App\Models\Tax;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:products.index')->only(['index']);
        $this->middleware('can:products.store', ['only' => ['create', 'store']]);
        $this->middleware('can:products.update', ['only' => ['update']]);
        $this->middleware('can:list-prices', ['only' => ['listPrices']]);
        $this->middleware('can:products-list', ['only' => ['viewProducts']]);
    }

    public function index() {
        // $products = Product::all();
        // $list = [];
        // foreach($products as $product){
        //     $list[] = $product->groups->lines;
        // }
        // return $list;
        // $products = DB::select('select p.id as id, p.name as name, l.name as line, g.name as "group", p.code as code, c.value as state, reference , costo, price, profit from products p join `groups` g ON p.group_id = g.id join `lines` l on l.id = g.line_id join cstates c on p.cstate_id = c.id ');
        // $products = DB::unprepared('SELECT p.id AS id, p.name AS name, l.name AS line, g.name AS "group", p.code AS code, c.value AS state, reference , costo, price, profit, sum(lp.stock) as total
        // from products p join `groups` g ON p.group_id = g.id join `lines` l on l.id = g.line_id join cstates c on p.cstate_id = c.id join locations_products lp
        // on lp.product_id = p.id group by p.id');

         $products = DB::select('select * from products_list_view');
         return DataTables()->collection($products)->toJson();
        //
    }

    public function viewProducts(){
        // $taxes = Tax::all();
        // $locations = Location::all();
        return view('admin.products');
    }

    public function listPrices(){
        $products = Product::orderBy('id', 'desc')->get();
        return view('admin.list_prices', compact('products'));
    }

    public function store(StoreProductRequest $request) {
        DB::beginTransaction();
        try{
            $product = Product::where('group_id', $request->group)
                                ->where('code', $request->code)->first();
            if($product){
                DB::rollBack();
                return redirect()->back()->withErrors('No fue posible crearRegistro. Código de producto ya existe en este grupo')->withInputs();
            }
            //guardar producto
            $product = new Product();
            //$product->line = $request->line;
            $product->group_id = $request->group;
            $product->code = $request->code;
            $product->name = mb_strtoupper($request->name,"UTF-8");
            $product->costo = $request->costo;
            // $product->profit = $request->profit;
            //$product->price = $request->price;
            $product->reference = $request->reference;
            $product->bar_code = $request->bar_code;
            $state = ($request->state) ? Cstate::where('value', 'Activo')->first() : Cstate::where('value', 'Inactivo')->first();
            $product->cstate_id = $state->id;
            //$now = new \DateTime();
            //echo $now->format('d-m-Y H:i:s');
            $product->date = Carbon::now()->format('Y-m-d');
            $product->location_main = $request->location;
            $product->save();
            //crear listado de precios
            $listPrice = new ListPrices();
            $listPrice->product_id = $product->id;
            $listPrice->price = $request->price;
            $listPrice->name = 'precio 1';
            $listPrice->utilidad = $request->profit;
            $listPrice->save();

            $product_taxes = new ProductsTaxes();
            $product_taxes->product_id = $product->id;
            $product_taxes->tax_id = $request->tax;
            $product_taxes->save();
            $locationProduct = new LocationProduct();
            $locationProduct->product_id = $product->id;
            $locationProduct->location_id = $request->location;
            $locationProduct->stock = $request->stock;
            $locationProduct->save();
            $productMovement = new ProductsMovements();
            $productMovement->type = 'Creacion';
            $productMovement->quantity = $request->stock;
            $productMovement->saldo = $request->stock;
            $productMovement->location_id = $locationProduct->location_id;
            $productMovement->product_id = $product->id;
            $productMovement->save();
            DB::commit();
            return back()->with('success', 'Ingreso exitoso');

        }catch (Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors('No fue posible crearRegistro. '.$e);
        }
        //return redirect(route('admin/products/create'))->with('success', 'Ingreso exitoso');
        //Redirect->to('admin/');
    }

    public function create(){
        $lines = Line::all();
        $taxes = Tax::all();
        $locations = Location::join('cstates', 'locations.cstate_id' , 'cstates.id')
                    ->where('value', 'Activo')
                    ->select('locations.id as id', 'name')->get();
        return view('admin.create_products',compact('lines', 'taxes', 'locations'));
    }

    public function update(Product $product, Request $request) {
        //return response()->json(['msg' => $request->changeState, 'status' => 200], 200);
        DB::beginTransaction();
        try {
            if(!$product){
                return response()->json(['msg' => 'Producto no encontrado o no existe: '], 400);
            }
            //se valida si solo es un cambio de estado
            if($product && $request->changeState == 'true'){
                $state = ($product->cstates->value == 'Activo') ? Cstate::where('value', 'Inactivo')->first() : Cstate::where('value', 'Activo')->first();
                //$state = $product->cstates;//Cstate::find($product->cstate_id);
                //$state = ($state->value == 'Activo') ? Cstate::where('value', 'Inactivo')->first() : Cstate::where('value', 'Activo')->first();
                $product->cstate_id = $state->id;
                $product->save();
                DB::commit();

                return response()->json(['msg' => 'Operacion exitosa', 'status' => 200], 200);
            }

            //$product->line = $request->line;
            $product->group_id = $request->group;
            $product->code = $request->code;
            $product->name = mb_strtoupper($request->name, 'UTF-8');
            $product->bar_code = $request->bar_code;
            $product->reference = $request->reference;
            $product->costo = $request->costo;
            //$product->profit = $request->profit;
            //$product->price = $request->price;
            $state = (!$request->state) ? Cstate::where('value', 'Inactivo')->first() : Cstate::where('value', 'Activo')->first();
            $product->cstate_id = $state->id;
            $product->location_main = $request->location_main;
            //creo location_product si no existia ubicacion de producto
            $product->save();
            $locationProduct = LocationProduct::where('product_id', $product->id)->where('location_id', $product->location_main)->first();
            if(!$locationProduct){
                $locationProduct = new LocationProduct();
                $locationProduct->location_id = $product->location_main;
                $locationProduct->product_id = $product->id;
                $locationProduct->stock = 0;
                $locationProduct->save();
            }
            $listPrice = ListPrices::where('product_id', $product->id)->where('name', 'precio 1')->first();
            $listPrice->price = $request->price;
            $listPrice->utilidad = $request->profit;
            $listPrice->save();
            $product_taxes = ProductsTaxes::where('product_id', $product->id)->first();
            $product_taxes->product_id = $product->id;
            $product_taxes->tax_id = $request->tax;
            $product_taxes->save();
            DB::commit();
            return response()->json(['msg' => 'Operacion exitosa', 'status' => 200], 200);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json(['msg' => 'Error en servidor contacte al administrador: '.$e ], 400);
        }
    }

    public function show ($product){
        $product = Product::join('products_taxes', 'product_id', 'products.id')
                    ->join('taxes', 'tax_id', 'taxes.id')
                    ->join('cstates', 'products.cstate_id', 'cstates.id')
                    ->join('list_prices', 'products.id', 'list_prices.product_id')
                    ->where('products.id', $product)
                    ->where('list_prices.name', 'precio 1')
                    ->select('products.id as id', 'products.name as name', 'list_prices.price as price', 'code', 'costo',  'reference', 'bar_code', 'taxes.id as tax', 'cstates.value as state', 'group_id as group', 'location_main', 'utilidad')->first();
        return response()->json($product);
    }

    public function showProductPrices($product){
        $product = Product::find($product);
        $prices = ListPrices::where('product_id', $product->id)->get();
        return view('admin.edit_prices_product', compact('prices', 'product'));
        return response()->json($prices);
    }
    public function updatePrices(Product $product, Request $request){
        // return $request;
        try{
            if($product){
                for($i=0; $i<count($request->utilidad); $i++){
                    if(!is_numeric($request->value_price[$i]) || !is_numeric($request->utilidad[$i])){
                        return back()->withInput()->with('fatal', 'Los campos utilidad y precio deben ser numericos');
                    }
                    if($request->price_id[$i] != 'newPrecio'){
                        $price = ListPrices::find($request->price_id[$i]);
                        if($price->product_id == $product->id)
                        $price->name = (!$price->name == 'precio 1') ? $request->name_precio[$i-1] : $price->name;
                        $price->price = $request->value_price[$i];
                        $price->utilidad = $request->utilidad[$i];
                        $price->save();
                    }else{
                        if($request->name_precio[$i-1] != '' && $request->value_price[$i] != '' && $request->utilidad[$i] != ''){
                            $price = new ListPrices();
                            $price->name = $request->name_precio[$i-1];
                            $price->price = $request->value_price[$i];
                            $price->utilidad = $request->utilidad[$i];
                            $price->product_id = $product->id;
                            $price->save();
                        }
                    }
                }
                return redirect()->to('admin/list-prices')->with('success', 'Cambios realizados');
            }
            return back()->with('fatal', 'No se encontro producto')->withInput();
        }catch(\Exception $e){
            return back()->with('fatal', 'No fue posible realizar los cambios')->withInput();
        }

    }
}
