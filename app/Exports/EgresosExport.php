<?php

namespace App\Exports;

use App\Models\Discharge;
use App\Models\Cstate;
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
        $state = Cstate::where('value', 'Activo')->first();
        $data = Discharge::where('discharges.date', '>=', $this->initial)
                            ->where('discharges.date', '<=', $this->final)->get();
        return view('exports.dischargesDateExport', ['discharges' => $data]);
    }
}
