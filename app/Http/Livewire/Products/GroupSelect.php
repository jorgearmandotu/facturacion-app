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

    protected $listeners = ['loadGroup'];


    public function mount($group = 0){
        $this->lines = Line::join('cstates', 'cstates.id', '=', 'cstate_id')
                        ->where('value', 'Activo')
                        ->select('lines.id as id', 'name')->get();
        $this->groups = [];
        if($group > 0){
            $gr = Group::find($group);
            $this->line = $gr->lines->id;
            $this->groups = Group::join('cstates', 'cstate_id', '=', 'cstates.id')
                        ->where('line_id', $this->line)
                        ->where('value', 'Activo')
                        ->select('groups.id as id', 'name')->get();
            $this->group = $group;
        }
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

    public function loadGroup($id){
        $this->lines = Line::join('cstates', 'cstates.id', '=', 'cstate_id')
                        ->where('value', 'Activo')
                        ->select('lines.id as id', 'name')->get();
                        $this->groups = [];
        if($id > 0){
        $group = Group::find($id);
        $this->line = $group->lines->id;
        $this->groups = Group::join('cstates', 'cstate_id', '=', 'cstates.id')
                        ->where('line_id', $this->line)
                        ->where('value', 'Activo')
                        ->select('groups.id as id', 'name')->get();
        $this->group = $group->id;
        }

    }
}
