<?php

namespace App\Http\Controllers;

use App\Models\ListPrices;
use App\Models\Location;
use App\Models\LocationProduct;
use App\Models\Product;
use App\Models\ProductsShoppingInvoice;
use App\Models\ShoppingInvoice;
use App\Models\Tercero;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShoppingInvoiceController extends Controller
{
    // public function main(){
    //     return View()
    // }

    public function index(){
        // $suppliers = Supplier::all();
        // $products = Product::all();
        // return view('admin.shopping_invoices', compact('suppliers', 'products'));
    }

    public function create(){
        $suppliers = Tercero::where('supplier', true)->get();
        $products = Product::all();
        $locations = Location::join('cstates', 'locations.cstate_id', 'cstates.id')
                    ->where('value', 'Activo')->select('name', 'locations.id')->get();
        return view('admin.shopping_invoices', compact('suppliers', 'products', 'locations'));
    }

    public function store(Request $request){
        if(!$request->date || !$request->numberInvoice || !$request->supplier || !$request->location){
            return response()->json(['msg' => 'Verifique Datos de Factura', 'status' => 400], 200);
        }
        if(!$request->totalItems || $request->totalItems < 1 || !$request->totalView) {
            return response()->json(['msg' => 'Verifique Productos de Factura', 'status' => 400], 200);
        }
        //crear factura
        DB::beginTransaction();
        try{
            $invoice = new ShoppingInvoice();
            $invoice->supplier_id = $request->supplier;
            $invoice->number = $request->numberInvoice;
            $invoice->date_invoice = $request->date;
            $dateUpload = Carbon::now()->format('Y-m-d');
            $invoice->date_upload = $dateUpload;
            $invoice->save();
            //recorrer listado de productos
            $total = 0;
            for($i=0; $i<$request->totalView; $i++){
                $position = $i+1;
                $val = 'product'.$position;
                $product = $request->$val;
                $val = 'cant'.$position;
                $quantity = $request->$val;
                $val = 'vlrUnit'.$position;
                $vlrUnit = $request->$val;
                if($product && $quantity && $vlrUnit){
                    //agregar producto
                    $product_select = Product::find($product);
                    if(!$product_select){
                        DB::rollBack();
                        return response()->json(['msg' => 'Verifique Datos de productos Ingresados. '
                        , 'status' => 400], 200);
                    }
                    $product_select->costo = $vlrUnit;
                    $price = ListPrices::where('name', "precio 1")
                                        ->where('product_id', $product_select->id)->first();
                    $product_select->profit = ($price->price - $vlrUnit)/$vlrUnit*100;//(price-costo)/costo*100
                    $product_select->save();
                    $product_shopping_invoice = new ProductsShoppingInvoice();
                    $product_shopping_invoice->product_id = $product_select->id;
                    $product_shopping_invoice->invoice_id = $invoice->id;
                    $product_shopping_invoice->quantity = $quantity;
                    $product_shopping_invoice->price = $vlrUnit;
                    $product_shopping_invoice->save();
                    $total += ($quantity * $vlrUnit);
                    //incrementar cantidad a stock
                    $locationProducts = new LocationProduct();
                    $locationProducts->location_id = $request->location;
                    $locationProducts->product_id = $product_select->id;
                    $locationProducts->stock = $quantity;
                    $locationProducts->save();
                }
                //return response()->json(['msg' => $vlrUnit, 'status' => 200], 200);
            }
            $invoice->total = $total;
            $invoice->save();
            DB::commit();
            return response()->json(['msg' => 'Ingreso Exitoso', 'status' => 200], 200);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json(['msg' => 'Verifique Datos Ingresados. '.$e, 'status' => 400], 200);
        }
    }
}
