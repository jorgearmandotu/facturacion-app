<div>
    @if ($msg != '')
        <div class="alert alert-danger" role="alert">
            {{$msg}}
        </div>
    @endif
    <label for="">{{ __("Data Invoice") }}</label>
    <div class="form-row">
        {{-- <div class="form-group col-md-3">
            <label for="">Factura</label>
            <input type="number" class="form-control" name="invoice" wire:model.defer="invoice" wire:change.defer = "searchInvoice" >
        </div> --}}
        <div class="form-group col-md-3">
            <label for="prefijo">{{ __('Prefix') }}</label>
            <input type="text" class="form-control" name="prefijo" wire:model.defer="prefijo" wire:change.defer = "searchInvoice" >
        </div>
        <div class="form-group col-md-3">
            <label for="invoice_number">{{ __('Number') }}</label>
            <input type="number" class="form-control" name="invoice_number" wire:model.defer="invoiceNumber" wire:change.defer = "searchInvoice" >
        </div>
        <div class="form-group col-md-3">
            <label for="vlr">{{ __('Outstanding Balance') }}</label>
            {{-- <input type="number" class="form-control"  wire:model.defer="invoiceVlr" > --}}
            <span class="form-control">{{ number_format($invoiceVlr, 2, ',', '.') }}</span>
        </div>
        {{-- @if(count($remisiones) > 0) --}}
        <div class="form-group col-md-3">
            <label for="remision">{{ __('Load Referral') }}</label><br>
            <input type="number" name= "remision" wire:model.defer = "numberRemision" class="form-control" wire:change="searchRemision" >
            {{-- <select name="remision" id="" class="form-control" wire:model.defer = 'remision' wire:change='loadRemision'>
                <option value="0">Seleccione remision</option>
                @foreach($remisiones as $remision)
                <option value="{{$remision->id}}">No.{{$remision->id}} - {{ number_format($remision->vlr_payment, 0, ',', '.')}}</option>
                @endforeach
            </select> --}}
        </div>
        {{-- @endif --}}
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="type">{{ __('Document Type' )}}</label>
            <select class="form-control"  wire:model.defer='typeDoc' disabled>
                @foreach($types as $documentType)
                    <option value="{{$documentType->id}}">{{$documentType->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="identification">{{ __('Identification') }}</label>
            <input type="number" class="form-control" wire:model.defer='identification' disabled>
        </div>
        <div class="form-group col-md-3">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" class="form-control" wire:model ='name' disabled >
        </div>
        <div class="form-group col-md-3">
            <label for="">{{ __('Referral Value')}}</label>
            <span class="form-control">{{ number_format($valueRemision, 2, ',', '.') }}</span>
        </div>
        {{-- @if(count($remisiones) > 0)
        <div class="form-group col-md-3">
            <label for="">Nuevo saldo</label>
            <span class="form-control">{{ number_format($newSaldo,2, ',', '.') }}</span>
        </div>
        @endif --}}
    </div>

</div>
