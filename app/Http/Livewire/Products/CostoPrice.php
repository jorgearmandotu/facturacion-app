<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;

class CostoPrice extends Component
{

    //no se uso
    public $percent = 10;
    public $price = 100;
    public $costo = 150;

    public function render()
    {
        return view('livewire.products.costo-price');
    }

    public function changePercent(){
        if($this->costo > 0){
            $this->price = $this->costo+($this->costo*$this->percent/100);
        }
    }
}
