<?php

namespace App\Http\Livewire\ShoppingInvoice;

use App\Models\Product;
use Livewire\Component;

class SearchProducts extends Component
{

    public $product = null;
    //public $productId = 0;
    public function mount(){

    }

    public function render()
    {
        $products = Product::all();
        return view('livewire.shopping-invoice.search-products', compact('products'));
    }

    public function changeProduct($id){
        $this->product = Product::find($id);
    }
}
