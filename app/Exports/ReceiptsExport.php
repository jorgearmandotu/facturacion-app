<?php

namespace App\Exports;

use App\Models\Receipt;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class ReceiptsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Receipt::all();
    }

    public function view() : View {
        // $invoices = Invoice::join('cstates', 'cstates.id', 'invoices.cstate_id')
        // ->select('date_invoice','prefijo', 'number', 'vlr_total', 'type', 'payment_method', 'value')->get();
        return view('exports.receipts', [
            'invoices' => Invoice::join('cstates', 'cstates.id', 'invoices.cstate_id')
            ->select('date_invoice','prefijo', 'number', 'vlr_total', 'type', 'payment_method', 'value')->get()
        ]);
    }
}
