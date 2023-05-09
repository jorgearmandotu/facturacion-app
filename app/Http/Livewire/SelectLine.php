<?php

namespace App\Http\Livewire;

use App\Models\Line;
use Livewire\Component;

class SelectLine extends Component
{
    public $lines;

    protected $listeners = ['lineAdded' => 'refreshLines'];

    public function mount(){
        $this->lines = Line::join('cstates', 'cstate_id', '=', 'cstates.id')
                ->select('lines.id as id', 'name')
                ->where('value', 'Activo')->get();
                //dd($this->lines);
    }

    public function render()
    {
        return view('livewire.select-line');
    }

    public function refreshLines(){
        $this->lines = Line::join('cstates', 'cstate_id', '=', 'cstates.id')
        ->select('lines.id as id', 'name')
        ->where('value', 'Activo')->get();
    }
}
