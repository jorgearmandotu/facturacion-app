<?php

namespace App\Exports;

use App\Models\ShoppingInvoice;
use Maatwebsite\Excel\Concerns\FromCollection;

class ShoppingInvoicesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ShoppingInvoice::all();
    }
}
