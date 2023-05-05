<?php

namespace App\Http\Livewire\Products;

use App\Models\Location;
use App\Models\LocationProduct;
use App\Models\Product;
use Livewire\Component;

class TransferLocations extends Component
{
    public $code;
    public $product;
    public $locations = [];
    public $locationsTo = [];
    public $from;
    public $to;
    public $quantity;
    public $existenciaFrom;
    public $existenciaTo;
    public $products;

    protected $listeners = ['resetForm'];

    public function mount(){
        $this->locationsTo = [];
        $this->products = [];
    }
    public function render()
    {
        $products = Product::all();
        return view('livewire.products.transfer-locations', compact('products'));
    }


    public function updatedCode()
    {
        $this->product = false;

        $this->validate([
            "code" => "required|min:1"
        ],
        [
            'code' => 'Numero de código ol nombre es requerido'
        ]);

        $this->products = Product::where('code', 'like', trim($this->code) . '%')
                                ->orwhere('name', 'like', '%'.trim($this->code). '%')
            ->take(5)
            ->get();

    }
    public function asignarProduct($code)
    {
        $this->code = $code;
        $this->product = Product::where('code', $this->code)->first();

        if($this->product){
            $this->locations = $this->product->locations;
            $this->locationsTo = Location::all();
            $this->from = $this->locations[0]->location->id;
            $this->existenciaFrom = $this->locations[0]->stock;
            $this->to = $this->locationsTo[0]->id;
            $locationSelect = LocationProduct::where('product_id', $this->product->id)->where('location_id', $this->to)->first();
            $this->existenciaTo = ($locationSelect) ? $locationSelect->stock : 0;
            $this->quantity = '';
        }else{
            $this->locations = [];
            $this->locationsTo = [];
            $this->from = null;
            $this->existenciaFrom = 0;
            // $this->locationsTo = Location::all();
            $this->to = null;
            $this->quantity = '';
        }
    }

    public function asignarFirst(){
        $producto = Product::where("code", "like", trim($this->code) . "%")->orwhere('name', 'like', '%'.trim($this->code). '%')->first();
        if($producto)
        {
            $this->code = $producto->code;
        }
        else
        {
            $this->code = "...";
        }
        $this->product = $producto;

        if($this->product){
            $this->locations = $this->product->locations;
            $this->locationsTo = Location::all();
            $this->from = $this->locations[0]->location->id;
            $this->existenciaFrom = $this->locations[0]->stock;
            $this->to = $this->locationsTo[0]->id;
            $locationSelect = LocationProduct::where('product_id', $this->product->id)->where('location_id', $this->to)->first();
            $this->existenciaTo = ($locationSelect) ? $locationSelect->stock : 0;
            $this->quantity = '';
        }else{
            $this->locations = [];
            $this->locationsTo = [];
            $this->from = null;
            $this->existenciaFrom = 0;
            // $this->locationsTo = Location::all();
            $this->to = null;
            $this->quantity = '';
        }
    }

    public function searchCode(){
        $this->product = Product::where('code', $this->code)->first();
        if($this->product){
            $this->locations = $this->product->locations;
            $this->from = $this->locations[0]->location->id;
            $this->existenciaFrom = $this->locations[0]->stock;
            $this->to = $this->locationsTo[0]->id;
            $locationSelect = LocationProduct::where('product_id', $this->product->id)->where('location_id', $this->to)->first();
            $this->existenciaTo = ($locationSelect) ? $locationSelect->stock : 0;
            $this->quantity = '';
        }else{
            $this->locations = [];
            $this->from = null;
            $this->existenciaFrom = 0;
            // $this->locationsTo = Location::all();
            $this->to = $this->locationsTo[0]->id;
            $this->quantity = '';
        }
    }

    public function changeFrom(){
        $locationSelect = LocationProduct::where('product_id', $this->product->id)->where('location_id', $this->from)->first();;
        if($locationSelect){
            $this->existenciaFrom = $locationSelect->stock;
        }else{
            $this->existenciaFrom = 0;
        }
    }

    public function changeTo(){
        $locationSelect = LocationProduct::where('product_id', $this->product->id)->where('location_id', $this->to)->first();
        $this->existenciaTo = ($locationSelect) ? $locationSelect->stock : 0;
    }

    public function resetForm(){
        $this->locations = [];
        $this->locationsTo = [];
        $this->existenciaFrom = 0;
        $this->existenciaTo = 0;
        $this->code = null;
        $this->quantity = '';
        $this->product = null;
        $this->products = [];
    }

}
