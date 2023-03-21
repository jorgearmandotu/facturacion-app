<?php

namespace App\Http\Controllers;

use App\Models\Invoice;

class PendingInvoicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:pending-invoices')->only(['index']);
    }

    public function index(){
        $invoices = Invoice::join('cstates', 'cstate_id', 'cstates.id')
                        ->where('value', 'Pendiente')
                        ->select('invoices.id as id', 'prefijo', 'number', 'client_id', 'vlr_total')->get();

        return view('admin.pending-invoices', compact('invoices'));
    }


}
