<div class="form-group col-md-9">
    <div class="col-md-5">
        <label for="product">Producto</label>
        <select name="product" id="selectProducts" class="js-example-theme-single form-control">
            <option value="-1">Seleccione Producto</option>
            @foreach ($products as $product)
                <option value="{{ $product->id }}">{{ $product->code }} - {{ $product->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-1"></div>
        <div class="form-group col-md-2">
            <label for="quantity">Cantidad disponible</label>
            <input type="number" class="form-control" id="inputQuantityStock" >
    </div>
    @section('plugins.Select2', true)
</div>
