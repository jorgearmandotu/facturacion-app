<?php

namespace App\Http\Controllers;

use App\Models\Cstate;
use App\Models\DataInvoices;
use App\Models\Invoice;
use App\Models\LocationProduct;
use App\Models\ProductsMovements;
use App\Models\Receipt;
use App\Models\Remision;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GestionDocumentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:gestion-documents')->only(['index', 'shareInvoices', 'anularInvoice', 'receiptShare', 'anularReceipt', 'remisionShare', 'anularRemision']);
    }

    public function index(){
        return view('admin.gestion-documents');
    }

    public function shareInvoices(Request $request){
        $prefijo = $request->prefijo;
        $number = $request->numberInvoice;
        if($prefijo == ''){
            return back()->withInput()->with('fatal', 'Prefijo de factura es requerida');
        }
        if($number == ''){
            return back()->withInput()->with('fatal', 'Número de factura es requerido');
        }
        $invoice = Invoice::where('prefijo', $prefijo)
                    ->where('number', $number)->first();
        return back()->withInput()->with('invoice', $invoice);
    }

    public function anularInvoice(Request  $request){
        $invoice = Invoice::find($request->invoice);
        if(!$invoice){
            return back()->with('fatal', 'factura no encontrada');
        }
        //cambiar estado de factura a nulada, devolver articulos a inventario
        DB::beginTransaction();
        try{
            $state = Cstate::where('value', 'Anulado')->first();
            $invoice->cstate_id = $state->id;
            $dataInvoice = $invoice->dataInvoices;
            foreach($dataInvoice as $data){
                $stocks = LocationProduct::where('product_id', $data->product_id)->first();
                $stocks->stock = $stocks->stock + $data->quantity;//como se anula factra se devuelve producto al inventario
                $stocks->save();
                $productMovement = ProductsMovements::where('document_type', 'Invoice')
                                                    ->where('document_id', $invoice->id)
                                                    ->where('product_id', $data->product_id)->first();
                if(!$productMovement){
                    DB::rollBack();
                    return back()->with('fatal', 'La factura no pudo ser anulada')->withInput();
                }
                $productMovement = new ProductsMovements();
                $productMovement->type = 'Entrada';
                $productMovement->quantity = $data->quantity;
                $locations = LocationProduct::where('product_id', $data->product_id)->get();
                $totalProduct = 0;
                foreach($locations as $location){
                    $totalProduct += $location->stock;
                }
                $productMovement->saldo = $totalProduct;
                $productMovement->location_id = $stocks->location_id;
                $productMovement->product_id = $data->product_id;
                $productMovement->document_type = 'Anulacion';
                $productMovement->document_id = $invoice->id;
                $productMovement->save();
            }
            $invoice->save();
            DB::commit();
            return back()->with('success', 'La factura fue anulada')->withInput();
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('fatal', 'La factura no pudo ser anulada'.$e)->withInput();
        }
    }

    public function receiptShare(Request $request) {
        if($request->numberReceipt == ''){
            return back()->with('fatal', 'Número de recibo es requerido');
        }
        $receipt = Receipt::find($request->numberReceipt);
        if(!$receipt){
            return back()->withInput()->with('fatal', 'Recibo de caja no encontrado');
        }
        return back()->withInput()->with('receipt', $receipt);
    }

    public function anularReceipt(Request $request){
        $receipt = Receipt::find($request->receipt);
        if(!$receipt){
            return back()->with('fatal', 'Recibo de caja no encontrado');
        }
        //cambiar estado de recibo a anulado y liberar remision del recibo si esta existe
        DB::beginTransaction();
        try{
            $state = Cstate::where('value', 'Anulado')->first();
            $receipt->cstate_id = $state->id;
            if($receipt->remision_id){
                $state = Cstate::where('value', 'Pendiente')->first();
                $remision = Remision::find($receipt->remision_id);
                if($remision->state->value == 'Finalizado'){
                    $remision->cstate_id = $state->id;
                    $remision->save();
                };
            }
            $receipt->save();
            DB::commit();
            return back()->with('success', 'El recibo fue anulado');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('fatal', 'El recibo no pudo ser anulado');
        }
    }

    public function remisionShare(Request $request){
        if($request->numberRemision == ''){
            return back()->with('fatal', 'Número de remisión es requerido');
        }
        $remision = Remision::find($request->numberRemision);
        if(!$remision){
            return back()->withInput()->with('fatal', 'Remisión no encontrada');
        }
        return back()->withInput()->with('remision', $remision);
    }

    public function anularRemision(Request $request){
        $remision = Remision::find($request->remision);
        if(!$remision){
            return back()->with('fatal', 'Remisión no encontrada');
        }
        //cambiar estado de remision a anulado y quitar de receipt si esta ligado a alguno
        DB::beginTransaction();
        try{
            $state = Cstate::where('value', 'Anulado')->first();
            $remision->cstate_id = $state->id;
            $receipt = Receipt::where('remision_id', $remision->id)->where('cstate_id', '!=', $state->id)->first();;
            if($receipt){
                $receipt->remision_id = null;
                $receipt->save();
            }
            $remision->save();
            DB::commit();
            return back()->with('success', 'La remisión fue anulada');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('fatal', 'La remisión no pudo ser anulada').$e;

        }
    }
}
