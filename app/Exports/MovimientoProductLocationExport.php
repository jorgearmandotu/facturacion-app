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

class MovimientoProductLocationExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public $product;
    public $dateInitial;
    public $dateFinal;
    public $location;

    public  function __construct(Product $product, $dateInitial, $dateFinal, $location){
        $this->product = $product;
        $this->dateInitial = $dateInitial;
        $this->dateFinal = $dateFinal.' 23:59:59';
        $this->location = $location;
    }

    public function collection()
    {
        $data = ProductsMovements::join('locations_products', function($join){
            $join->on('locations_products.product_id', '=', 'products_movements.product_id')->on('locations_products.location_id', '=','products_movements.location_id');
            })->where('products_movements.product_id', '7')
                ->where('products_movements.created_at', '<=', $this->dateFinal)
                ->where('products_movements.created_at', '>=', $this->dateInitial)
                ->where('products_movements.location_id', '1')
                ->select('type', 'products_movements.product_id', 'quantity', 'document_type', 'document_id', 'products_movements.location_id', 'products_movements.created_at')->get();


        return view('exports.movimientoProductLocation', ['movements' => $data]);
    }

    public function view() : View {

        $data = ProductsMovements::join('locations_products', function($join){
            $join->on('locations_products.product_id', '=', 'products_movements.product_id')->on('locations_products.location_id', '=','products_movements.location_id');
            })->where('products_movements.product_id', '7')
                ->where('products_movements.created_at', '<=', $this->dateFinal)
                ->where('products_movements.created_at', '>=', $this->dateInitial)
                ->where('products_movements.location_id', '1')
                ->select('type', 'products_movements.product_id as product', 'quantity', 'document_type', 'document_id', 'products_movements.location_id', 'products_movements.created_at', 'stock')->get();

                $data = ProductsMovements::where('products_movements.product_id', $this->product->id)
                ->where('products_movements.created_at', '<=', $this->dateFinal)
                ->where('products_movements.created_at', '>=', $this->dateInitial)
                ->where('products_movements.location_id', $this->location->id)
                ->get();

        return view('exports.movimientoProductLocation', ['movements' => $data]);
    }
}
