<?php

namespace App\Http\Livewire\Products;

use App\Models\Group;
use App\Models\Line;
use Livewire\Component;

class GroupSelect extends Component
{
    public $lines;
    public $line;
    public $groups;
    public $group;

    public function mount(){
        $this->lines = Line::all();
        $this->groups = [];
        //$this->line = -1;
        // $this->groups = Group::join('cstates', 'cstate_id', '=', 'cstates.id')
        //                 ->where('line_id', $this->line)
        //                 ->where('value', 'Activo')->get();
    }
    public function render()
    {
        return view('livewire.products.group-select');
    }

    public function reloadGroup(){
        $this->groups = Group::join('cstates', 'cstate_id', '=', 'cstates.id')
                        ->where('line_id', $this->line)
                        ->where('value', 'Activo')->get();
                        $this->group = -1;
    }
}
