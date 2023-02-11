<div class="form-row">
    <div class="form-group col-md-6">
        <label for="line">Linea</label>
        <select name="line" class="form-control" wire:model.defer='line' wire:change.defer='reloadGroup' required>
            <option value="-1">Selecione una opcion</option>
            @foreach ($lines as $line)
                <option value="{{ $line->id }}">{{ $line->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-6">
        <label for="group">Grupo</label>
        <select name="group" class="form-control" wire:model.defer='group' required>
            <option value="-1">Selecione una opcion</option>
            @foreach ($groups as $group)
                <option value="{{ $group->id }}">{{ $group->name }}</option>
            @endforeach
        </select>
    </div>

</div>
