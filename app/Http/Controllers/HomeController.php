<?php

namespace App\Http\Controllers;

use App\Models\Cstate;
use App\Models\Invoice;
use App\Models\Receipt;
use App\Models\Remision;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index(){
        $today = Carbon::now()->format('d-m-Y');
        return view('admin.home', compact('today'));
    }

    public function dailySalesCash(){
        $today = Carbon::now()->format('Y-m-d');
        $statePagado = Cstate::where('value', 'Pagado')->first();
        $stateAnulado = Cstate::where('value', 'Anulado')->first();
        $invoices = Invoice::join('users', 'user_id', 'users.id')
                    ->where('type', 'contado')->where('payment_method', 'EFECTIVO')->where('cstate_id', $statePagado->id)
                    ->where('invoices.date_invoice', $today)
                    ->select('users.name as user', 'vlr_total as total', 'cstate_id')->get();

                    $remisiones = Remision::join('users', 'user_id', 'users.id')
                    ->where('payment_method', 'EFECTIVO')->where('cstate_id','<>', $stateAnulado->id)
                    ->where('date_remision', $today)
                    ->select('users.name as user', 'vlr_payment as total', 'cstate_id')->get();

                    $receipts = Receipt::join('users', 'user_id', 'users.id')
                    ->where('type', 'EFECTIVO')->where('cstate_id', $statePagado->id)
                    ->where('date', $today)
                    ->select('users.name as user', 'vlr_payment as total', 'cstate_id')->get();

        $sales = $invoices->concat($remisiones)->concat($receipts);
        return response()->json($sales);
    }
}
