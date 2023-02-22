<div>
    <div class="form-row">
        <div class="from-group col-md-6">
            <label for="document_type">Tipo de Documento </label>
            <select class="form-control" name="document_type" wire:model.defer = 'type' wire:change = 'searchClient'>
                @foreach($types as $documentType)
                    <option value="{{$documentType->id}}">{{$documentType->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="from-group col-md-6">
            <label for="dni">Identificacion </label>
            <input type="number"  class="form-control" name="dni" wire:model.defer = 'dni' wire:change = 'searchClient'>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" name="name" wire:model.defer = 'name' />
        </div>
        <div class="form-group col-md-6">
            <label for="phone">Teléfono</label>
            <input type="number" class="form-control" name="phone"  />
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="address">Dirección</label>
            <input type="text" class="form-control" name="address"  />
        </div>
        <div class="form-group col-md-6">
            <label for="email">Correo eléctronico</label>
            <input type="email" class="form-control" name="email"  />
        </div>
    </div>
</div>
