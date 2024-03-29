<?php

namespace App\Exports;

use App\Models\DataInvoices;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\ProductsMovements;
use App\Models\ProductsShoppingInvoice;
use App\Models\ShoppingInvoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;

class MovimientoProductExport implements FromView, ShouldAutoSize
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
        $this->dateFinal = $dateFinal.' 23:59:59';
    }

    public function collection()
    {
        return Product::all();
    }

    public function view() : View {
        // $data = ShoppingInvoice::join('products_shopping_invoices', 'products_shopping_invoices.invoice_id', 'shopping_invoices.id')
        //                     ->where('date_upload', '>=', $this->dateInitial)->get();
        $data = ProductsMovements::where('product_id', $this->product->id)
                                    ->where('created_at', '<=', $this->dateFinal)
                                    ->where('created_at', '>=', $this->dateInitial)->get();
        return view('exports.movimientoProducto', ['movements' => $data]);
    }
}
