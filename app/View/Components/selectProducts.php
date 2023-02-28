<?php

namespace App\View\Components;

use App\Models\Product;
use Illuminate\View\Component;

class selectProducts extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $products = Product::join('cstates', 'cstate_id', 'cstates.id')->where('value', 'Activo')->get();
        //$products = Product::all();
        return view('components.select-products', compact('products'));
    }
}
