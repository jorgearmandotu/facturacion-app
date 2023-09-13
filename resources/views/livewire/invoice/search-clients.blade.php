<div>
    <div class="form-row">
        <div class="from-group col-md-6">
            <label for="dni">{{ __('Identification') }} </label>
            <input type="number"  class="form-control" name="dni" wire:model.defer = 'dni' wire:change='searchClient'>
        </div>
        <div class="from-group col-md-6">
            <label for="document_type">{{  __('Document Type') }}</label>
            <select class="form-control" name="document_type" wire:model.defer='type' wire:change = 'searchClient'>
                @foreach($types as $documentType)
                    <option value="{{$documentType->id}}">{{$documentType->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="name">{{  __('Name') }}</label>
            <input type="text" class="form-control" name="nameClient" wire:model.defer = 'name' />
        </div>
        <div class="form-group col-md-6">
            <label for="phone">{{ __('Number Phone') }}</label>
            <input type="number" class="form-control" name="phone" wire:model.defer = 'phone' />
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="address">{{  __('Address') }}</label>
            <input type="text" class="form-control" name="address" wire:model.defer = 'address' />
        </div>
        <div class="form-group col-md-6">
            <label for="email">{{ __('Email') }}</label>
            <input type="email" class="form-control" name="email" wire:model.defer = 'email' />
        </div>
    </div>
</div>
