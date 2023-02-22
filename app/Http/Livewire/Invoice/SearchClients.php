<?php

namespace App\Http\Livewire\Invoice;

use App\Models\Clients;
use App\Models\Document_type;
use Livewire\Component;

class SearchClients extends Component
{
    //public $types;
    public $type;
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
        return view('livewire.invoice.search-clients', compact('types'));
    }

    public function searchClient(){

        dd('search');
        if($this->type && $this->dni){
        $client = Clients::where('document_type', $this->type)
                        ->where('dni', $this->dni)->first();
        if($client){
            $this->name = $client->name;
        }
        }
    }
}
