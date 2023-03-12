<?php

namespace App\Http\Livewire\Invoice;

use App\Models\Document_type;
use App\Models\Tercero;
use Livewire\Component;

class SearchClients extends Component
{
    //public $types;
    public $type = 1;
    public $dni;
    public $client;
    public $name;
    public $phone;
    public $address;
    public $email;

    // public function mount(){
    //     $this->types;
    // }

    public function render()
    {
        $types = Document_type::all();
        //$this->type = $types[0]->id;
        return view('livewire.invoice.search-clients', compact('types'));
    }

    public function searchClient(){
        if($this->type && $this->dni){
        $client = Tercero::where('dni', $this->dni)->first();
                        //->where('document_type', $this->type);
        if($client){
            $this->type = $client->document_type;
             $this->name = $client->name;
             $this->phone = $client->phone;
             $this->address = $client->address;
             $this->email = $client->email;
         }else{
            $this->name = '';
             $this->phone = '';
             $this->address = '';
             $this->email = '';
         }
        }
    }
}
