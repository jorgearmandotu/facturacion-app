<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Cstate;
use App\Models\DataInvoices;
use App\Models\Invoice as ModelsInvoice;
use App\Models\LocationProduct;
use App\Models\Product;
use App\Models\ProductsTaxes;
use App\Models\Tax;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index(){
        $products = Product::join('cstates', 'cstate_id', 'cstates.id')->where('value', '==', 'Activo')->get();
        return view('admin.invoices', compact('products'));
    }

    public function store(Request $request) {
        $documentType = $request->document_type;
        $dni = $request->dni;
        $nameClient = $request->nameClient;
        if(!$documentType || !$dni || !$request->nameClient){
            return response()->json(['msg' => 'Verifique datos de cliente.', 'status' => 400], 200);
        }

        if(!$request->totalView || $request->totalView < 1 ){
            return response()->json(['msg' => 'Verifique información de productos.', 'status' => 400], 200);
        }
        // crear factura
        DB::beginTransaction();
        try{
            //si no existe cliente se crea
            $client = Clients::where('document_type', $documentType)
            ->where('dni', $dni)->first();
            if(!$client){
                $client = new Clients();
                $client->document_type = $documentType;
                $client->dni = $dni;
            }
            $client->name = strtoupper($nameClient);
            $client->phone = $request->phone;
            $client->address = strtoupper($request->address);
            $client->email = strtoupper($request->email);
            $client->save();

            $vlrTotal = 0;
            //se crea factura con estado cancelado ya  q es de contado
            $invoice = new ModelsInvoice();
            $invoice->number = 'FP-'.$invoice->id;//resolucion dian
            $invoice->client_id = $client->id;
            $invoice->vlr_total = $vlrTotal;
            $invoice->date_invoice = Carbon::now()->format('Y-m-d');
            $state = Cstate::where('value', 'Finalizado')->first();
            $invoice->cstate_id = $state->id;
            $invoice->discount = $request->discount;
            $invoice->payment_method = $request->paymentMethod;
            $invoice->user_id = Auth::id();
            $invoice->type = $request->typeInvoice;
            $invoice->save();

            //si hay cuota inical se crea nota para cruzar solo con facturas credito
            if($invoice->type == 'CREDITO'){
                
            }

            //se crea invoice_products
            for($i=0; $i<$request->totalView; $i++){
                $position = $i+1;
                $val = 'product'.$position;
                $product_id =$request->$val;
                $val = 'quantity'.$position;
                $quantity = $request->$val;
                $product = Product::find($product_id);
                if(!$product){
                    return response()->json(['msg' => 'Verifique información de productos.', 'status' => 400], 200);
                }

                $dataInvoice = new DataInvoices();
                $dataInvoice->product_id = $product->id;
                $dataInvoice->invoice_id = $invoice->id;
                $dataInvoice->quantity = $quantity;
                $dataInvoice->vlr_unit = $product->price;
                $dataInvoice->position = $position;
                $taxes = ProductsTaxes::where('product_id', $product->id)->get();
                $valueTax = 0;
                foreach($taxes as $tax_id){
                    $tax = Tax::find($tax_id->tax_id);
                    $valueTax += $tax->value;
                }
                $dataInvoice->vlr_tax = $valueTax;
                $dataInvoice->save();
                $vlrTotal += $quantity*$product->price + $quantity*$product->price*$valueTax/100;
                //disminuir inventario
                $stocks = LocationProduct::where('product_id', $product->id)->first();
                $stocks->stock = $stocks->stock - $quantity;
                $stocks->save();
            }
            $invoice->vlr_total = $vlrTotal;
            $invoice->save();
            DB::commit();
            //enviar apagina para imprimir factura
            //return redirect()->route('print-invoice')->withInput(['id' => $invoice->id]);
            return response()->json(['msg' => $invoice->id, 'status' => 200], 200);
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['msg' => 'Error al generar factura. ', 'status' => 400], 200);
        }
    }
}
