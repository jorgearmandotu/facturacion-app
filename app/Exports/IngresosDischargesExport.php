<?php

namespace App\Exports;

use App\Models\Discharge;
use App\Models\Invoice;
use App\Models\Remision;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class IngresosDischargesExport implements FromView, ShouldAutoSize
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
        //
    }

    public function view() : View {
        $invoices = Invoice::where('invoices.date_invoice', '>=', $this->initial)
                    ->where('invoices.date_invoice', '<=', $this->final)->get();
        $remisiones = Remision::where('date_remision', '<=', $this->final)
                    ->where('date_remision', '>=', $this->initial)->get();
        $discharges = Discharge::where('date', '>=', $this->initial)
                    ->where('date', '<=', $this->final)->get();
        $data = $invoices->concat($remisiones)->concat($discharges)->sortBy('created_at');
        return view('exports.ingresos-dischargesDateExport', ['movements' => $data]);
    }
}
