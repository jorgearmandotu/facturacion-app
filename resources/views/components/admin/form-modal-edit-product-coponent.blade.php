<div>
    <div class="modal fade" id="editProduct" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formProduct" action="" method="POST">
                    <div class="modal-body">
                        @csrf
                        {{-- <livewire:select-line /> --}}
                        <livewire:products.group-select />
                        <div class="form-row">
                            @method('PUT')
                            <input type="hidden" value="" id="inputId" name="id" />
                            <div class="form-group col-md-6">
                                <label for="code">Codigo</label>
                                <input type="text" class="form-control" name="code" id="inputCode" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" name="name" id="inputName" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="costo">Costo</label>
                                <input type="number" class="form-control" name="costo" id="inputCosto"
                                    onchange="changeCosto()" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="impuesto">Iva</label>
                                <select name="tax" class="form-control" id="selectTax">
                                    @foreach ($taxes as $tax)
                                        <option value="{{ $tax->id }}">{{ $tax->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="profit">% utilidad</label>
                                <input type="number" class="form-control" name="profit" id="inputProfit"
                                    placeholder="%" onchange="changePercent()" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="price">Precio</label>
                                <input type="number" class="form-control" name="price" id="inputPrice"
                                    placeholder="$" onchange="changePrice()" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="reference">Referencia</label>
                                <input type="text" name="reference" class="form-control" id="inputReference">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="state">Estado</label>
                                <div class="form-check">
                                    <input class="form-check-input" id="checkState" type="checkbox" name="state">
                                    <label class="form-check-label" for="activo">
                                        Activo
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="bar_code">Cod Barras</label>
                                <input type="text" name="bar_code" class="form-control" id="inputBarCode">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="location_main">Ubicación Principal</label>
                                <select name="location_main" class="form-control" id="locationMain">
                                    @foreach($locations as $location)
                                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submmit" class="btn btn-success" data-dismiss="modal"
                            onclick="updateProduct(event)">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
