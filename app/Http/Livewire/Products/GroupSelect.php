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
        $this->lines = Line::join('cstates', 'cstates.id', '=', 'cstate_id')
                        ->where('value', 'Activo')
                        ->select('lines.id as id', 'name')->get();
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
                        ->where('value', 'Activo')
                        ->select('groups.id as id', 'name')->get();
                        $this->group = -1;
    }
}
