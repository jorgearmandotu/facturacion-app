<?php

namespace App\Http\Livewire\Receipt;

use App\Models\Clients;
use App\Models\Cstate;
use App\Models\Document_type;
use App\Models\Invoice;
use App\Models\Receipt;
use Livewire\Component;

class SelectInvoice extends Component
{
    public $typeDoc = 1;
    public $identification;
    public $prefijo;
    public $invoiceNumber;
    public $invoiceVlr;
    public $name = '';
    public $msg;
    //public $types;

    public function render()
    {
        $types = Document_type::all();
        return view('livewire..receipt.select-invoice', compact('types'));
    }

    public function searchClient()
    {
        if ($this->identification != "" && $this->typeDoc > 0) {
            $client = Clients::where('document_type', $this->typeDoc)
                ->where('dni', $this->identification)->first();
            if ($client) {
                $this->name = $client->name;
            } else {
                $this->name = '';
            }
        }
    }

    public function searchInvoice()
    {
        if ($this->prefijo != '' && $this->invoiceNumber != '') {
            $invoice = Invoice::join('cstates', 'cstates.id', 'cstate_id')
                ->where('prefijo', $this->prefijo)
                ->where('number', $this->invoiceNumber)->first();
            //->where('cstates.value', 'Pendiente')
            if ($invoice) {
                $client = Clients::find($invoice->client_id);
                if ($client) {
                    //$stateInvoice = Cstate::find($invoice->cstate_id);
                    if($invoice->type == 'CONTADO' ){
                        $saldo = 0;
                    }else{
                        $receipts = Receipt::where('invoice_id', $invoice->id)->get();
                        $saldo = $invoice->vlr_total;
                        foreach($receipts as $receipt){
                            $saldo -= $receipt->vlr_payment;
                        }
                    }
                    $this->invoiceVlr = $saldo;//calcular valor adeudado de factura
                    $this->name = $client->name;
                    $this->typeDoc = $client->document_type;
                    $this->identification = $client->dni;
                    $this->msg = '';
                }
            }else {
                $this->name = '';
                $this->identification = '';
                $this->typeDoc = 1;
                $this->invoiceVlr = 0;
                $this->msg = 'Factura '.$this->prefijo.'-'.$this->invoiceNumber.' No existe';
            }
        }
    }
}
