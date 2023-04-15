<?php

namespace App\Exports;

use App\Models\Cstate;
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

    public $dateInitial;
    public $dateFinal;

    public  function __construct($dateInital, $dateFinal){
        $this->dateInitial = $dateInital;
        $this->dateFinal = $dateFinal;
    }

    public function collection()
    {
        return Invoice::all();
    }

    public function view() : View {
        $state = Cstate::where('value', 'Anulado')->first();
        $invoices = Invoice::where('invoices.date_invoice', '>=', $this->dateInitial)
                            ->where('invoices.date_invoice', '<=', $this->dateFinal)->where('cstate_id', '!=', $state->id)->get();
        $remisiones = Remision::where('date_remision', '<=', $this->dateFinal)
                            ->where('date_remision', '>=', $this->dateInitial)->where('cstate_id', '!=', $state->id)->get();
        // $receipts = Receipt::where('date', '>=', $this->dateInitial)
        //                     ->where('date', '<=', $this->dateFinal)->where('cstate_id', '!=', $state->id)->get();
        $data = $remisiones->concat($invoices)->sortBy('created_at');
        return view('exports.ingresosFechaExport', ['invoices' => $data]);
    }
}
