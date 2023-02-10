<?php

namespace App\View\Components\Admin;

use App\Models\Line;
use Illuminate\View\Component;

class FormModalpropertiesInventario extends Component
{

    public $buttonText;
    public $id;
    public $formId;
    public $title;
    public $placeholder;
    public $event;
    //public $lines;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( String $buttonText,String $id, String $formId, String $title, String $placeholder, String $event )
    {
        $this->buttonText = $buttonText;
        $this->id = $id;
        $this->formId = $formId;
        $this->title = $title;
        $this->placeholder = $placeholder;
        $this->event = $event;
        //$this->lines = ($formId == 'formGroup')? Line::all(): [];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.form-modalproperties-inventario');
    }
}
