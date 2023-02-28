<?php

namespace App\Http\Livewire\Invoice;

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
            if($this->stock < 0){
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
            $this->vlrUnity = $this->product->price;
            $this->vlrUnit = number_format($this->product->price+($this->product->price*$this->tax/100), 0,',', '.');
            $this->vlrTotal = $this->quantity*$this->product->price;
            $this->total = number_format(($this->quantity*$this->product->price)+(($this->quantity*$this->product->price*$this->tax)/100), 2, ',', '.');
        }catch(\Exception $e){
            $this->stock = 0;
            $this->vlrUnit = 0;
            $this->vlrUnity = 0;
            $this->total = 0;
            $this->vlrTotal = 0;
            $this->quantity = 1;
        }
    }

    public function changeQuanity(){
        $this->vlrTotal = $this->quantity*$this->product->price;
        $this->total = number_format(($this->quantity*$this->product->price)+(($this->quantity*$this->product->price*$this->tax)/100), 2, ',', '.');
    }
}
