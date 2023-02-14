<?php

namespace App\View\Components;

use App\Models\Tax;
use Database\Seeders\TaxesSeeder;
use Illuminate\View\Component;

class admin.form-modal-edit-product extends Component
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
        $taxes = Tax::all();
        return view('components.admin.form-modal-edit-product', compact('taxes'));
    }
}
