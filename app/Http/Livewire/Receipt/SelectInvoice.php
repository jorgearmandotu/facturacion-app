<?php

namespace App\Http\Livewire\Receipt;

use App\Models\Cstate;
use App\Models\Document_type;
use App\Models\Invoice;
use App\Models\Receipt;
use App\Models\Remision;
use App\Models\Tercero;
use Livewire\Component;

class SelectInvoice extends Component
{
    public $typeDoc = 1;
    public $identification;
    public $prefijo;
    public $invoiceNumber;
    public $invoiceVlr;
    public $saldoTotal;
    public $name = '';
    public $msg;
    //public $remisiones = [];
    // public $remision;
    public $numberRemision = '';
    public $valueRemision = 0;
    //public $types;

    public function mount(){
        //$this->remisiones = Remision::all();
        $this->prefijo = '';
    }
    public function render()
    {
        $types = Document_type::all();
        return view('livewire..receipt.select-invoice', compact('types'));
    }

    public function searchClient()
    {
        if ($this->identification != "" && $this->typeDoc > 0) {
            $client = Tercero::where('dni', $this->identification)->first();
                //->where('document_type', $this->typeDoc)
            if ($client) {
                //$this->remisiones = Remision::all();
                $this->name = $client->name;
            } else {
                $this->name = '';
                //$this->remisiones = [];
                // $this->remision = '';
            }
        }
    }

    public function searchInvoice()
    {
        try{
            if ( $this->invoiceNumber != '') {
                $invoice = Invoice::join('cstates', 'cstates.id', 'cstate_id')
                ->select('invoices.id as id', 'type', 'vlr_total', 'client_id')
                    ->where('prefijo', $this->prefijo)
                    ->where('number', $this->invoiceNumber)->first();
                //->where('cstates.value', 'Pendiente')
                if ($invoice) {
                    $client = Tercero::find($invoice->client_id);
                    if ($client) {
                        //$stateInvoice = Cstate::find($invoice->cstate_id);
                        if($invoice->type == 'CONTADO' ){
                            $this->saldoTotal = 0;
                        }else{
                            $receipts = Receipt::where('invoice_id', $invoice->id)->get();
                            $this->saldoTotal = $invoice->vlr_total;
                            foreach($receipts as $receipt){
                                $this->saldoTotal -= $receipt->vlr_payment;
                                if($receipt->remision){
                                    $this->saldoTotal -= $receipt->remision->vlr_payment;
                                }
                            }
                        }
                        $state = Cstate::where('value', 'Finalizado')->first();
                        // $this->remisiones = Remision::where('client_id', $client->id)
                        //                     ->where('cstate_id', '!=', $state->id)->get();
                        // $this->remision = '';
                        $this->invoiceVlr = $this->saldoTotal;//calcular valor adeudado de factura
                        //$this->newSaldo = $this->saldoTotal;
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
                    //$this->newSaldo = 0;
                    // $this->remisiones = [];
                    // $this->remision = '';
                    $this->msg = 'Factura '.$this->prefijo.'-'.$this->invoiceNumber.' No existe';
                }
            }
        }catch(\Exception $e){
            $this->name = $e;
        }
    }

    public function loadRemision(){
        $remision_select = Remision::find($this->remision);
        if($remision_select){
            //$this->newSaldo -= $remision_select->vlr_payment;
        }else{
           // $this->newSaldo = $this->invoiceVlr;
        }
    }

    public function searchRemision(){
        $state = Cstate::where('value', 'Pendiente')->first();
        $remision = Remision::where('id', $this->numberRemision)
                            ->where('cstate_id', $state->id)->first();
        if($remision){
            $this->valueRemision = $remision->vlr_payment;
            $this->invoiceVlr -= $remision->vlr_payment;
        }else{
            $this->valueRemision = 0;
            $this->invoiceVlr = $this->saldoTotal;
        }
    }
}
