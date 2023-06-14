<?php

namespace App\Exports;

use App\Models\ShoppingInvoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ShoppingInvoicesExport implements FromView, ShouldAutoSize
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

        return ShoppingInvoice::all();
    }

    public function view() : View {
        return view('exports.shoppingInvoiceExport', ['invoices' => ShoppingInvoice::where('shopping_invoices.date_invoice', '>=', $this->initial)->where('shopping_invoices.date_invoice', '<=', $this->final)->get()]);
    }
}
