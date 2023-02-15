<?php

namespace App\View\Components\admin;

use App\Models\Tax;
use Illuminate\View\Component;

class FormModalEditProductCoponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $taxes;
    public function __construct()
    {
        $this->taxes = Tax::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.form-modal-edit-product-coponent');
    }
}
