<?php

namespace App\Exports;

use App\Models\Receipt;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReceiptsExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public $initial;
    public $final;

    public function __construct($dateInitial, $dateFinal)
    {
        $this->initial = $dateInitial;
        $this->final = $dateFinal;
    }
    public function collection()
    {
        return Receipt::all();
    }

    public function view() : View {
        return view('exports.receiptsExport', [
            'receipts' => Receipt::where('date', '>=', $this->initial)
                                ->where('date', '<=', $this->final)->get()

            // 'invoices' => Invoice::join('cstates', 'cstates.id', 'invoices.cstate_id')
            // ->select('date_invoice','prefijo', 'number', 'vlr_total', 'type', 'payment_method', 'value')->get()
        ]);
    }
}
