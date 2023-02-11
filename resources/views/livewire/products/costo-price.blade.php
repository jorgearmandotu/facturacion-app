<div class="form-row">
    <div class="form-group col-md-3">
        <label for="costo">Costo</label>
        <input type="number" class="form-control" name="costo" min="0" required wire:model.defer = 'costo' />
    </div>
    <div class="form-group col-md-3">
        <label for="impuesto">Impuesto</label>
        <select name="impuesto" class="form-control" id="impuesto" >
            <option value="0">0%</option>
            <option value="5">5%</option>
            <option value="19">19%</option>
        </select>
    </div>
    <div class="form-group col-md-3">
        <label for="percent">% utilidad</label>
        <input type="number" class="form-control" name="percent" placeholder="%" min="0" wire:model.defer = 'percent' wire:change='changePercent'/>
    </div>
    <div class="form-group col-md-3">
        <label for="price">Precio</label>
        <input type="number" class="form-control" name="price" placeholder="$" min="0" required wire:model.defer='price' />
    </div>
</div>
