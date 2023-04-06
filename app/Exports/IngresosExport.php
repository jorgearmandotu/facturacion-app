<?php

namespace App\Exports;

use App\Models\Invoice;
use App\Models\Receipt;
use App\Models\Remision;
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
        $invoices = Invoice::where('invoices.date_invoice', '>=', '2023-04-01')
                            ->where('invoices.date_invoice', '<=', '2023-04-05')->get();
        $remisiones = Remision::where('date_remision', '<=', '2023-04-05')
                            ->where('date_remision', '>=', '2023-04-01')->get();
        $data = $remisiones->concat($invoices)->sortBy('created_at');
        return view('exports.ingresosFechaExport', ['invoices' => $data]);
    }
}
