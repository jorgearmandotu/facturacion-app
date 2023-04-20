<?php

namespace App\Exports;

use App\Models\Discharge;
use App\Models\Cstate;
use App\Models\ShoppingInvoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;

class EgresosExport implements FromView, ShouldAutoSize
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
        $state = Cstate::where('value', 'Pagado')->first();
        $data = Discharge::where('discharges.date', '>=', $this->initial)
                            ->where('discharges.date', '<=', $this->final)->get();
        $shoppingInvoices = ShoppingInvoice::where('type', 'CONTADO')
                                ->where('date_invoice', '>=', $this->initial)
                                ->where('date_invoice', '<=', $this->final)->get();
        $discharges = $data->concat($shoppingInvoices)->sortBy('created_at');
        return view('exports.dischargesDateExport', ['discharges' => $discharges]);
    }
}
