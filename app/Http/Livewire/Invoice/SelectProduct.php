<?php

namespace App\Http\Livewire\Invoice;

use App\Models\ListPrices;
use App\Models\LocationProduct;
use App\Models\Product;
use App\Models\ProductsTaxes;
use App\Models\Tax;
use Livewire\Component;

class SelectProduct extends Component
{
    public $stock = 0;
    public $vlrUnit = 0;
    public $vlrUnity = 0;
    public $tax = 0;
    public $quantity = 1;
    public $total = 0;
    public $vlrTotal = 0;
    public $product;
    public $classNegative = '';
    public $prices = [];
    public $price;
    public $btnStatus = 'disabled';

    protected $listeners = ['changeProduct' => 'changeProduct'];

    public function render()
    {
        $products = Product::join('cstates', 'cstate_id', 'cstates.id')->where('value', 'Activo')->select('products.id as id', 'code', 'name')->get();
        return view('livewire.invoice.select-product', compact('products'));
    }

    public function changeProduct($id){
        try{
            $this->product = Product::find($id);
            $stock = LocationProduct::where('product_id', $this->product->id)->select('stock')->first();
            $this->stock = $stock->stock;
            if($this->stock < 1){
                $this->classNegative = 'stock-negative';
            }else{
                $this->classNegative = '';
            }
            $taxes = ProductsTaxes::where('product_id', $this->product->id)->get();
            $this->tax = 0;
            $this->quantity = 1;
            foreach($taxes as $tax){
                $value = Tax::find($tax->tax_id);
                $this->tax += $value->value;
            }
            $this->price = 0;
            $this->prices = ListPrices::where('product_id', $this->product->id)->get();
            //$this->vlrUnity = $this->prices;
            $this->vlrUnity = $this->prices[0]->price;
            $this->vlrUnit = number_format($this->vlrUnity+($this->vlrUnity*$this->tax/100), 0,',', '.');
            //dd($this->vlrUnit);
            $this->vlrTotal = $this->quantity*$this->vlrUnity;
            $this->total = number_format(($this->quantity*$this->vlrUnity)+(($this->quantity*$this->vlrUnity*$this->tax)/100), 2, ',', '.');
            $this->btnStatus = '';
        }catch(\Exception $e){
            $this->stock = 0;
            $this->vlrUnit = 0;
            $this->vlrUnity = 0;
            $this->total = 0;
            $this->vlrTotal = 0;
            $this->quantity = 1;
            $this->price = 0;
            $this->btnStatus = 'disabled';
        }
    }

    public function changeQuanity(){
        $this->vlrTotal = $this->quantity*$this->vlrUnity;
        $this->total = number_format(($this->quantity*$this->vlrUnity)+(($this->quantity*$this->vlrUnity*$this->tax)/100), 2, ',', '.');
    }

    public function changePrice(){
        $this->vlrUnity = $this->price;
        $this->vlrUnit = number_format($this->vlrUnity+($this->vlrUnity*$this->tax/100), 0,',', '.');
        $this->vlrTotal = $this->quantity*$this->vlrUnity;
        $this->total = number_format(($this->quantity*$this->vlrUnity)+(($this->quantity*$this->vlrUnity*$this->tax)/100), 2, ',', '.');
    }


}
