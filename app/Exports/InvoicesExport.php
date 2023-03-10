<?php

namespace App\Exports;

use App\Models\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class InvoicesExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        return Invoice::join('cstates', 'cstates.id', 'invoices.cstate_id')
                    ->select('date_invoice','prefijo', 'number', 'vlr_total', 'type', 'payment_method', 'value')->get();
    }

    public function view() : View {
        // $invoices = Invoice::join('cstates', 'cstates.id', 'invoices.cstate_id')
        // ->select('date_invoice','prefijo', 'number', 'vlr_total', 'type', 'payment_method', 'value')->get();
        return view('exports.invoices', [
            'invoices' => Invoice::join('cstates', 'cstates.id', 'invoices.cstate_id')
            ->select('date_invoice','prefijo', 'number', 'vlr_total', 'type', 'payment_method', 'value')->get()
        ]);
    }
}
