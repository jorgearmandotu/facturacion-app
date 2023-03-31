<div>
    <div class="form-group row">
        <label for="name">Codigo de Producto</label>
        <input type="number" class="form-control data-autofocus" placeholder="Código" name="code" id="inputCode" wire:model.defer="code" wire:change="searchCode">
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
</div>
