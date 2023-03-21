<?php

namespace App\Exports;

use App\Models\Invoice;
use App\Models\Receipt;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;

class IngresosExport implements FromView, ShouldAutoSize
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
        return Invoice::all();
    }

    public function view() : View {
        $data = Invoice::where('invoices.date_invoice', '>=', $this->initial)
                            ->where('invoices.date_invoice', '<=', $this->final)->get();
        return view('exports.ingresosFechaExport', ['invoices' => $data]);
    }
}
