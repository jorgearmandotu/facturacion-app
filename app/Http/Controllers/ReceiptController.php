<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReceiptRequest;
use App\Models\Cstate;
use App\Models\Invoice;
use App\Models\Receipt;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReceiptController extends Controller
{
    public function index() {
        return view('admin.receipt');
    }

    public function store(StoreReceiptRequest $request) {
        DB::beginTransaction();
        try{
            $invoice = Invoice::where('prefijo', $request->prefijo)
                        ->where('number', $request->invoice_number)->first();
            $receipt = new Receipt();
            $receipt->type = $request->paymentMethod;
            $receipt->vlr_payment = $request->vlr_payment;
            $receipt->tercero_id = $invoice->client_id;
            $receipt->invoice_id = $invoice->id;
            $receipt->vlr_invoice = $invoice->vlr_total;
            $receipt->user_id = Auth::id(); //agregar usuario que realizo recibo
            $receipt->date = Carbon::now()->format('Y-m-d');
            $receipt->save();

            $receipts = Receipt::where('invoice_id', $invoice->id)->get();
            $total = $invoice->vlr_total;
            foreach($receipts as $receipt){
                $total -= $receipt->vlr_payment;
            }
            if($total < 1){
                $state = Cstate::where('value', 'Finalizado')->first();
                $invoice->cstate_id = $state->id;
                $invoice->save();
            }
            DB::commit();
            //dd('operacion exitosa');
            return redirect('admin/printReceipt/'.$receipt->id);
        }catch(\Exception $e){
            //dd('error '.$e);
            DB::rollBack();
            return back()->with('msg', 'No fue posible generar el recibo, verifique la información.');
        }
    }
}
