<div>
    <div class="form-row">
        <div class="form-group col-xs-6" wire:ignore>
            <label for="product">Producto</label><br>
            <select name="product" id="selectProducts" class="js-example-theme-single form-control">
                {{-- <option value="-1">Seleccione Producto</option> --}}
                <option value=""></option>
                @foreach ($products as $productItem)
                    <option value="{{ $productItem->id }}">{{ $productItem->code }} - {{ $productItem->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-xs-2">
            <label for="quantity">Cantidad</label>
            <input type="number" class="form-control" id="inputQuantity" onchange="changeVlrUnit()">
        </div>
        <div class="form-group col-xs-2">
            <label for="ult.costo">Ultimo Costo</label>
            <label for="" class="form-control" id="ult-costo" >@if($product){{number_format($product->costo, 0, ',', '.')}}@endif</label>
        </div>
        <div class="form-group col-xs-2">
            <label for="costo-promedio">Costo Promedio</label>
            <label for="" class="form-control" id="costo-promedio" >@if($product){{number_format($product->costo_promedio, 0, ',', '.')}}@endif</label>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:load', function(){
            $('#selectProducts').select2({
                placeholder: 'Seleccione un Producto',
            });
            $('#selectProducts').on('change', function(){
                //@this.set('productId', this.value);
                @this.changeProduct(this.value);
            });
            $('#selectProducts').on('select2:open', function () {
                document.querySelector('.select2-search__field').focus();
            });
            $('#selectProducts').on('select2:select', function () {
                document.querySelector('#inputQuantity').focus();
            });
        });
    </script>
</div>
