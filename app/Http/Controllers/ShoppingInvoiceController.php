<?php

namespace App\Http\Controllers;

use App\Models\CategoriesDischarge;
use App\Models\CompanyData;
use App\Models\CpaymentMethods;
use App\Models\Cstate;
use App\Models\CtypesNotes;
use App\Models\DataInvoices;
use App\Models\Discharge;
use App\Models\ListPrices;
use App\Models\Location;
use App\Models\LocationProduct;
use App\Models\Product;
use App\Models\ProductsMovements;
use App\Models\ProductsShoppingInvoice;
use App\Models\ShoppingInvoice;
use App\Models\Tax;
use App\Models\Tercero;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ShoppingInvoiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:shopping-invoices.index')->only(['index']);
        $this->middleware('can:shopping-invoices.store', ['only' => ['create', 'store']]);
        $this->middleware('can:shopping-invoices.update', ['only' => ['update']]);
        $this->middleware('can:shopping-invoices.show', ['only' => ['show']]);
    }
    // public function main(){
    //     return View()
    // }

    public function index(){
        // $suppliers = Supplier::all();
        // $products = Product::all();
        // return view('admin.shopping_invoices', compact('suppliers', 'products'));
    }

    public function create(){
        $paymentMethods = CpaymentMethods::join('cstates', 'cstates.id', 'cpayment_methods.cstate_id')
                                ->where('cstates.value', 'Activo')
                                ->select('cpayment_methods.id as id', 'cpayment_methods.value as value')->get();
        $taxes = Tax::all();
        $suppliers = Tercero::where('supplier', true)->get();
        $locations = Location::join('cstates', 'locations.cstate_id', 'cstates.id')
                    ->where('value', 'Activo')->select('name', 'locations.id')->get();
        return view('admin.shopping_invoices', compact('suppliers', 'locations', 'taxes', 'paymentMethods'));
    }

    public function store(Request $request){
        if(!$request->date || !$request->numberInvoice || !$request->supplier_id || !$request->location){
            return response()->json(['msg' => 'Verifique Datos de Factura', 'status' => 400], 200);
        }
        if(!$request->totalItems || $request->totalItems < 1 || !$request->totalView) {
            return response()->json(['msg' => 'Verifique Productos de Factura', 'status' => 400], 200);
        }
        //validar que factura de proveedor no exista
        try{
            $request->validate([
                'supplier_id' => [
                    'required',
                    Rule::unique('shopping_invoices')->where(function ($query) use ($request) {
                        $state = Cstate::where('value', 'Anulado')->first();
                        return $query->where('number', $request->numberInvoice)->where('cstate_id', '!=', $state->id);
                    }),
                ],
                'numberInvoice' => 'required',
            ]);
        }catch (\Exception $e){
            return response()->json(['msg' => 'Ya se encuentra registrado este numero de factura a este proveedor', 'status' => 400], 200);
        }
        //crear factura
        DB::beginTransaction();
        try{
            $invoice = new ShoppingInvoice();
            $invoice->supplier_id = $request->supplier_id;
            $invoice->number = $request->numberInvoice;
            $invoice->date_invoice = $request->date;
            $dateUpload = Carbon::now()->format('Y-m-d');
            $invoice->date_upload = $dateUpload;
            $invoice->type = $request->typeInvoice;
            $invoice->user_id = Auth::id();
            if($invoice->type == 'CREDITO'){
                $state = Cstate::where('value', 'Pendiente')->first();
                $invoice->cstate_id = $state->id;
            }else{
                $state = Cstate::where('value', 'Pagado')->first();
                $invoice->cstate_id = $state->id;
            }
            $invoice->payment_method = $request->paymentMethod;
            $invoice->save();
            //recorrer listado de productos
            $total = 0;
            for($i=0; $i<$request->totalView; $i++){
                $position = $i+1;
                $val = 'product'.$position;
                $product = $request->$val;
                $val = 'cant'.$position;
                $quantity = $request->$val;
                // $val = 'location'.$request->$val;
                // $location = $request->$val;
                $val = 'vlrUnit'.$position;
                $vlrUnit = $request->$val;
                $val = 'tax'.$position;
                $vlrTax = $request->$val;
                // $tax = Tax::find($vlrTax);
                // $vlrTax = ($tax) ? $tax->value : 0;
                if($product && $quantity && $vlrUnit){
                    //agregar producto
                    $product_select = Product::find($product);
                    if(!$product_select){
                        DB::rollBack();
                        return response()->json(['msg' => 'Verifique Datos de productos Ingresados. '
                        , 'status' => 400], 200);
                    }
                    $product_select->costo = $vlrUnit;
                    // $price = ListPrices::where('name', "precio 1")
                                        // ->where('product_id', $product_select->id)->first();
                    //actualizo lista de precios de acuerdo a utilidad
                    // $product_select->profit = ($price->price - $vlrUnit)/$vlrUnit*100;//(price-costo)/costo*100
                    $product_select->save();
                    // $product_shopping_invoice = new ProductsShoppingInvoice();
                    // $product_shopping_invoice->product_id = $product_select->id;
                    // $product_shopping_invoice->invoice_id = $invoice->id;
                    // $product_shopping_invoice->quantity = $quantity;
                    // $product_shopping_invoice->price = $vlrUnit;
                    // $product_shopping_invoice->save();
                    $dataInvoice = new DataInvoices();
                    $dataInvoice->product_id = $product_select->id;
                    $dataInvoice->quantity = $quantity;
                    $dataInvoice->vlr_unit = $vlrUnit;
                    $dataInvoice->shopping_invoice_id = $invoice->id;
                    $dataInvoice->vlr_tax = $vlrTax;
                    $dataInvoice->save();
                    $total += ($quantity * ($vlrUnit+$vlrUnit*$vlrTax/100));

                    //actualizo costo promedio
                    if($product_select->quantity_costos == 0 && $product_select->costo > 0) {
                        $product_select->costo_promedio = DB::select('select AVG(vlr_unit) AS promedio FROM data_invoices di
                        where shopping_invoice_id is not null and product_id = '.$product_select->id.'
                        GROUP BY product_id
                        limit 100;')[0]->promedio;
                        $product_select->quantity_costos = DB::select('select count(vlr_unit) AS quantity_costos FROM data_invoices di
                        where shopping_invoice_id is not null and product_id = '.$product_select->id.'
                        GROUP BY product_id
                        limit 100;')[0]->quantity_costos;
                        $product_select->save();
                    }else{
                        $product_select->costo_promedio = (($product_select->costo_promedio * $product_select->quantity_costos)+$dataInvoice->vlr_unit)/($product_select->quantity_costos+1);
                        $product_select->quantity_costos += 1;
                        $product_select->save();
                    }

                    //incrementar cantidad a stock
                    $locationProducts = LocationProduct::where('product_id', $product_select->id)
                                                    ->where('location_id', $request->location)->first();
                    if(!$locationProducts){
                        $locationProducts = new LocationProduct();
                        $locationProducts->location_id = $request->location;
                        $locationProducts->product_id = $product_select->id;
                        $locationProducts->stock = $quantity;
                    }else{
                        $locationProducts->stock = $locationProducts->stock + $quantity;
                    }
                    $locationProducts->save();
                    $productMovement = new ProductsMovements();
                    $productMovement->type = 'Entrada';
                    $productMovement->quantity = $quantity;
                    $locations = LocationProduct::where('product_id', $product_select->id)->get();
                    $totalProduct = 0;
                    foreach($locations as $location){
                        $totalProduct += $location->stock;
                    }
                    $productMovement->saldo = $totalProduct;
                    $productMovement->location_id = $request->location;
                    $productMovement->product_id = $product_select->id;
                    $typeDocument = CtypesNotes::where('name', 'Factura de compra')->first();
                    $productMovement->document_type = $typeDocument->id;
                    // $productMovement->document_type = 'shopping_invoice';
                    $productMovement->document_id = $invoice->id;
                    $productMovement->save();


                    //actualizo listado de precio
                    $listprices =  ListPrices::where('product_id',$product_select->id)->get();
                    foreach($listprices as $price){
                        $price->price = $product_select->costo+($product_select->costo*$price->utilidad/100);
                        $price->save();
                    }
                    // $priceBeforeIva = $product_select->costo+($product_select->costo*$listprice->utilidad/100);
                    $taxes = 0;
                    foreach($product_select->taxes as $tax){
                        $taxes += $tax->value;
                    }
                    // $listprice->price = $priceBeforeIva+($priceBeforeIva*$taxes/100);
                    // $listprice->save();
                }
                //return response()->json(['msg' => $vlrUnit, 'status' => 200], 200);
            }
            $invoice->total = $total;
            $invoice->save();
            //generar egreso si es de contado  o cuenta por pagar si es credito

            DB::commit();
            return response()->json(['msg' => 'Ingreso Exitoso', 'invoice' => $invoice->id, 'status' => 200], 200);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json(['msg' => 'Verifique Datos Ingresados. '.$e, 'status' => 400], 200);
        }
    }

    public function print(ShoppingInvoice $invoice){
        if(!$invoice){
            return 'Factura no encontrada';
        }
        $supplier = Tercero::find($invoice->supplier_id);
        $user = User::select('name')->find($invoice->user_id);
        $company = CompanyData::latest('id')->first();

        return view('admin.print.print-shopping-invoice', compact('invoice', 'supplier', 'user', 'company'));
    }
}
