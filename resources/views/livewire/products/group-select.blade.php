<div class="form-row">
    @php

    @endphp
    <div class="form-group col-md-6">
        <label for="line">Linea</label>
        <select name="line" class="form-control" wire:model.defer='line' wire:change.defer='reloadGroup' required>
            <option value="-1">Selecione una opcion</option>
            @foreach ($lines as $line)
                @if($oldData)
                    @if($line->id == $oldData['line'])
                        <option value="{{ $line->id }}" selected>{{ $line->name }}</option>
                    @else
                        <option value="{{ $line->id }}">{{ $line->name }}</option>
                    @endif
                @else
                        <option value="{{ $line->id }}">{{ $line->name }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-6">
        <label for="group">Grupo</label>
        <select name="group" class="form-control" wire:model.defer='group' required>
            <option value="-1">Selecione una opcion</option>
            @foreach ($groups as $group)
                @if($group->id == old('group'))
                <option value="{{ $group->id }}" selected>{{ $group->name }}</option>
                @else
                <option value="{{ $group->id }}">{{ $group->name }}</option>
                @endif
            @endforeach
        </select>
    </div>

</div>
