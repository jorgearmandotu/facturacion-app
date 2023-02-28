<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Cstate;
use App\Models\Invoice as ModelsInvoice;
use App\Models\Invoice_Product;
use App\Models\Product;
use App\Models\ProductsTaxes;
use App\Models\Tax;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Invoice extends Controller
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
            $invoice->number = 'FP-'.$invoice->id;
            $invoice->client_id = $client->id;
            $invoice->vlr_total = $vlrTotal;
            $invoice->date_invoice = Carbon::now()->format('Y-m-d');
            $invoice->cstate_id = Cstate::where('value', 'Cancelado');
            $invoice->discount = 0;
            //$invoice->save();

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

                $invoiceProducts = new Invoice_Product();
                $invoiceProducts->product_id = $product->id;
                $invoiceProducts->invoice_id = $invoice->id;
                $invoiceProducts->quantity = $quantity;
                $invoiceProducts->vlr_unit = $product->price;
                $taxes = ProductsTaxes::where('product_id', $product->id)->get();
                $valueTax = 0;
                foreach($taxes as $tax_id){
                    $tax = Tax::find($tax_id->tax_id);
                    $valueTax += $tax->value;
                }
                $invoiceProducts->vlr_tax = $valueTax;
                $invoiceProducts->save();
                $vlrTotal += $quantity*$product->price + $quantity*$product->price*$valueTax/100;
            }
            $invoice->vlr_total = $vlrTotal;
            $invoice->save();
            DB::commit();
            return response()->json(['msg' => 'Factura Generada.', 'status' => 200], 200);
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['msg' => 'Error al generar factura. '.$e, 'status' => 400], 200);
        }
    }
}
