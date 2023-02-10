<?php

namespace App\Http\Livewire;

use App\Models\Line;
use Livewire\Component;

class SelectLine extends Component
{
    public $lines;

    protected $listeners = ['lineAdded' => 'refreshLines'];

    public function mount(){
        $this->lines = Line::all();
    }

    public function render()
    {
        return view('livewire.select-line');
    }

    public function refreshLines(){
        $this->lines = Line::all();
    }
}
