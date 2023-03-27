<div>
    <div class="form-row col-md-12">
        <div class="col-md-5" wire:ignore>
            <label for="product">Producto</label>
            <select name="product" id="selectProducts" class="form-control" style="width: 100%" onfocus="7">
                {{-- <option value="-1">Seleccione Producto</option> --}}
                <option></option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->code }} - {{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-1">
        </div>
        <div class="form-group col-md-2">
                <label for="stock">Stock</label>
                <input type="number" class="form-control inputDisabled {{$classNegative}}" id="inputQuantityStock" wire:model.defer='stock' disabled >
        </div>
        <div class="form-group col-md-2">
                <label for="tax">IVA</label>
                <input type="number" class="form-control inputDisabled" id="inputTax" wire:model.defer='tax' disabled >
                <input type="hidden" name="tax" wire:model.defer='tax' >
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-2">
            <label for="quantity">Cantidad</label>
            <input type="number" name="quantity" min="1" class="form-control" id="inputQuantity" onfocus="8" wire:model='quantity' wire:change.defer='changeQuanity'>
        </div>
        <div class="form-group col-md-2">
            <label for="price">Precio:</label>
            <select name="price" class="form-control" wire:model.defer='price' wire:change='changePrice' id="selectPrice" >
                @foreach($prices as $price)
                <option value="{{$price->price}}">{{$price->name}} - {{$price->price}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="vlr-Unitario">Vlr. Unitario</label>
            <input type="text"  class="form-control inputDisabled" id="inputVlrUnitario" placeholder="$ 0" wire:model='vlrUnit'  disabled>
            <input type="hidden" name="vlrUnit"  wire:model='vlrUnity'>
        </div>
        <div class="form-group col-md-3">
            <label for="vlr-Total">Vlr. Total</label>
            <input type="text"  class="form-control inputDisabled" id="inputVlrTotal" placeholder="$ 0" tabindex="-1" wire:model='total' disabled>
            <input type="hidden" name="total"   wire:model='vlrTotal' >
        </div>
    </div>
    @section('plugins.Select2', true)
    <div class="form-row justify-content-center pb-4 mb-4">
        <button class="btn btn-info" type="button" onclick="add()" {{$btnStatus}} id="btnStatus">Agregar</button>
    </div>
</div>
