<?php

namespace App\Http\Controllers;

use App\Models\Cstate;
use App\Models\DataInvoices;
use App\Models\Invoice;
use App\Models\LocationProduct;
use App\Models\Receipt;
use App\Models\Remision;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GestionDocumentsController extends Controller
{
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
                $stocks->stock = $stocks->stock + $data->quantity;
                $stocks->save();
            }
            $invoice->save();
            DB::commit();
            return back()->with('success', 'La factura fue anulada');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('fatal', 'La factura no pudo ser anulada');
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
            return back()->with('fatal', 'El recibo fue anulado');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('fatal', 'El recibo no pudo ser anulado');
        }
    }

    public function remisionShare(Request $request){

    }
}
