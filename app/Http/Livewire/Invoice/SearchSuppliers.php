<?php

namespace App\Http\Livewire\Invoice;

use App\Models\Document_type;
use App\Models\ShoppingInvoice;
use App\Models\Tercero;
use Livewire\Component;

class SearchSuppliers extends Component
{

    public $type = 1;
    public $dni;
    public $client;
    public $name;
    public $phone;
    public $address;
    public $email;
    public $invoice;

    public $invoices = [];



    public function render()
    {
        $types = Document_type::all();
        if($this->invoice){
            $this->invoice = ShoppingInvoice::find($this->invoice->id);
            $this->name = $this->invoice->suppliers->name;
            $this->dni = $this->invoice->suppliers->dni;
            $this->type = $this->invoice->suppliers->document_type;
            $this->phone = $this->invoice->suppliers->phone;
            $this->email = $this->invoice->suppliers->email;
            $this->address = $this->invoice->suppliers->address;
        }
        return view('livewire.invoice.search-suppliers', compact('types'));
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
            //  $this->invoices = ShoppingInvoice::where('supplier_id', $client->id)->whereHas('state', function ($query) {
            //     $query->where('value', 'Pendiente');
            // })->get();
         }else{
            $this->name = '';
             $this->phone = '';
             $this->address = '';
             $this->email = '';
         }
        }
    }
}
