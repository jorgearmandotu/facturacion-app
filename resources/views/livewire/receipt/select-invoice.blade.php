<div>
    @if ($msg != '')
        <div class="alert alert-danger" role="alert">
            {{$msg}}
        </div>
    @endif
    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="">Factura</label>
            {{-- <input type="number" class="form-control" name="invoice" wire:model.defer="invoice" wire:change.defer = "searchInvoice" > --}}
        </div>
        <div class="form-group col-md-3">
            <label for="prefijo">prefijo</label>
            <input type="text" class="form-control" name="prefijo" wire:model.defer="prefijo" wire:change.defer = "searchInvoice" >
        </div>
        <div class="form-group col-md-3">
            <label for="invoice">Numero</label>
            <input type="number" class="form-control" name="invoice" wire:model.defer="invoiceNumber" wire:change.defer = "searchInvoice" >
        </div>
        <div class="form-group col-md-3">
            <label for="vlr">Saldo</label>
            <input type="number" class="form-control" name="invoiceVlr" wire:model.defer="invoiceVlr" >
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="type">Tipo de Documento</label>
            <select class="form-control" name="document_type" wire:model.defer='typeDoc' disabled>
                @foreach($types as $documentType)
                    <option value="{{$documentType->id}}">{{$documentType->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="identification">Identificación</label>
            <input type="number" class="form-control" name="identification" wire:model.defer='identification' disabled>
        </div>
        <div class="form-group col-md-3">
            <label for="name">Nombres</label>
            <input type="text" class="form-control" name="name" wire:model ='name' disabled >
        </div>
    </div>
</div>
