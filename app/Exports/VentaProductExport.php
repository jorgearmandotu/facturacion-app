<?php

namespace App\Exports;

use App\Models\Product;
use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;

class VentaProductExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public $product;
    public $dateInitial;
    public $dateFinal;

    public  function __construct(Product $product, $dateInitial, $dateFinal){
        $this->product = $product;
        $this->dateInitial = $dateInitial;
        $this->dateFinal = $dateFinal;
    }
    public function collection()
    {
        //
    }

    public function view() : View {
        // $data = ShoppingInvoice::join('products_shopping_invoices', 'products_shopping_invoices.invoice_id', 'shopping_invoices.id')
        //                     ->where('date_upload', '>=', $this->dateInitial)->get();
        $data = Invoice::join('cstates', 'cstates.id', 'invoices.cstate_id')
                ->join('data_invoices', 'invoices.id', 'data_invoices.invoice_id')
                ->join('products', 'products.id', 'data_invoices.product_id')
                ->where('products.id', $this->product->id)
                ->where('cstates.value','<>', 'Anulado')
                ->select('products.name as product', 'data_invoices.vlr_unit as vlr_unit', 'data_invoices.vlr_tax as tax', 'data_invoices.quantity as quantity', 'date_invoice', 'prefijo', 'invoices.number')->get();
        return view('exports.ventaProduct', ['movements' => $data]);
    }
}
