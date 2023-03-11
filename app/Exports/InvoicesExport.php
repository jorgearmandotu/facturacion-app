<?php

namespace App\Exports;

use App\Models\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class InvoicesExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public $initial;
    public $final;

    public  function __construct($dateInital, $dateFinal){
        $this->initial = $dateInital;
        $this->final = $dateFinal;
    }

    public function collection()
    {

        return Invoice::join('cstates', 'cstates.id', 'invoices.cstate_id')
                    ->where('invoices.date_invoice', '>=', $this->initial)
                    ->where('invoices.date_invoice', '<=', $this->final)
                    ->select('date_invoice','prefijo', 'number', 'vlr_total', 'type', 'payment_method', 'value')->get();
    }

    public function view() : View {
        // $invoices = Invoice::join('cstates', 'cstates.id', 'invoices.cstate_id')
        // ->select('date_invoice','prefijo', 'number', 'vlr_total', 'type', 'payment_method', 'value')->get();
        return view('exports.invoicesExport', [
            'invoices' => Invoice::join('cstates', 'cstates.id', 'invoices.cstate_id')
            ->select('date_invoice','prefijo', 'number', 'vlr_total', 'type', 'payment_method', 'value')->get()
        ]);
    }
}
