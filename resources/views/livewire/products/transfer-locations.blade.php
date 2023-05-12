<div>
    <div class="form-group row">
        <label for="name">Producto</label>
        <input wire:model="code" name="code" id="inputCode" wire:keydown.enter="asignarFirst()" class="form-control" placeholder="Código de producto">
        @error("code")
        <small class="form-text text-danger">{{ $message}}</small>
        @else
            @if(count($products)>0)
                @if(!$product)
                    <div class="shadow rounded px-3 pt-3 pb-0">
                    @foreach($products as $productItem)
                        <div style="cursor: pointer;">
                            <a wire:click="asignarProduct('{{ $productItem->code }}')">
                                {{ $productItem->code.' - '.$productItem->name }}
                            </a>
                        </div>
                            <hr>
                    @endforeach
                    </div>
                @endif
            @else
                <small class="form-text text-muted">Buscar próducto</small>
            @endif
        @enderror
        {{-- <select name="product" id="selectProducts" class="form-control" style="width: 100%" onfocus="7"> --}}
                {{-- <option></option>
            @foreach ($products as $product)
                <option value="{{ $product->code }}">{{ $product->code }} - {{ $product->name }}</option>
            @endforeach
        </select> --}}
        {{-- <input type="number" class="form-control data-autofocus" placeholder="Código" name="code" id="inputCode" wire:model.defer="code" wire:change="searchCode"> --}}
    </div>
    <div class="row">
        <label id="nameProduct" for="">@if($product) {{$product->name}} @endif</label>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="from">Desde</label>
            <select name="from" class="form-control" wire:model="from" wire:change="changeFrom" id="selectFrom">
                @foreach($locations as $location)
                    <option value="{{ $location->location->id }}">{{ $location->location->name }}</option>
                @endforeach
            </select>
            <span>Existencia: {{ $existenciaFrom }} </span>
            <input type="hidden" id="existenciaFrom" value="{{ $existenciaFrom }}">
        </div>
        <div class="form-group col-md-6">
            <label for="to">Hacia</label>
            <select name="to" class="form-control" wire:model="to" wire:change="changeTo" id="selectTo">
                @foreach($locationsTo as $location)
                <option value="{{ $location->id }}">{{ $location->name }}</option>
                @endforeach
            </select>
            <span>Existencia: {{ $existenciaTo }} </span>
        </div>
    </div>
    <div class="form-group row">
        <label for="quantity">Cantidad</label>
        <input type="number" min="1" name="quantity" class="form-control" wire:model.defer="quantity" id="quantity">
    </div>

    @section('plugins.Select2', true)
</div>
