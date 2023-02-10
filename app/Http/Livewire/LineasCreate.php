<?php

namespace App\Http\Livewire;

use App\Models\Line;
use Exception;
use Livewire\Component;

use function PHPUnit\Framework\isEmpty;

class LineasCreate extends Component
{
    public $name;
    public $state = true;

    public function render()
    {
        return view('livewire.lineas-create');
    }

    public function save()
    {
        try{
            if(!empty($name)){
                Line::created([
                    'name' => $this->name,
                    'cstate_id' => ($this->state) ? '1' : '2',
                ]);
            }

        }catch(Exception $e){
            dd($e);
        }
    }
}
