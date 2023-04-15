<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReceiptRequest;
use App\Models\CpaymentMethods;
use App\Models\Cstate;
use App\Models\Invoice;
use App\Models\Receipt;
use App\Models\Remision;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReceiptController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:receipt.index')->only(['index']);
        $this->middleware('can:receipt.store', ['only' => ['create', 'store']]);
    }

    public function index() {
        $paymentMethods = CpaymentMethods::all();
        return view('admin.receipt', compact('paymentMethods'));
    }

    public function store(StoreReceiptRequest $request) {
        DB::beginTransaction();
        try{
            $invoice = Invoice::where('prefijo', $request->prefijo)
                        ->where('number', $request->invoice_number)->first();
            $receipt = new Receipt();
            $receipt->type = $request->paymentMethod;
            $receipt->vlr_payment = $request->vlr_payment;
            $receipt->observation = $request->observation;
            $receipt->tercero_id = $invoice->client_id;
            $receipt->invoice_id = $invoice->id;
            $receipt->vlr_invoice = $invoice->vlr_total;
            $receipt->user_id = Auth::id(); //agregar usuario que realizo recibo
            $receipt->date = Carbon::now()->format('Y-m-d');
            $state = Cstate::where('value', 'Pendiente')->first();
            $remision = Remision::where('id', $request->remision)
                            ->where('cstate_id', $state->id)->first();
            //$remision = Remision::find($request->remision);
            $state = Cstate::where('value', 'Finalizado')->first();
            if($remision){
                $receipt->remision_id = $remision->id;
                $remision->cstate_id = $state->id;
                $remision->save();
            }else{
                $receipt->remision_id = null;
            }
            $state = Cstate::where('value', 'Pagado')->first();
            $receipt->cstate_id = $state->id;
            $receipt->save();

            $receipts = Receipt::where('invoice_id', $invoice->id)->get();
            $total = $invoice->vlr_total;
            foreach($receipts as $receipt){
                $total -= $receipt->vlr_payment;
                if($receipt->remision){
                    $total -= $receipt->remision->vlr_payment;
                }
            }
            if($total < 1){
                $invoice->cstate_id = $state->id;
                $invoice->save();
            }
            DB::commit();
            //dd('operacion exitosa');
            return redirect('admin/printReceipt/'.$receipt->id);
        }catch(\Exception $e){
            //dd('error '.$e);
            DB::rollBack();
            return back()->with('fatal', 'No fue posible generar el recibo, verifique la información.'.$e);
        }
    }
}
