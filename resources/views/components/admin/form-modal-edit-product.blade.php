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
            <form id="formProduct">
            <div class="modal-body">
                @csrf
                <livewire:select-line />
                <livewire:products.group-select />

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="code">Codigo</label>
                        <input type="text" class="form-control" name="code" id="inputCode" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" name="name" id="inputName"  />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="costo">Costo</label>
                        <input type="number" class="form-control" name="costo"  id="inputCosto" onchange="changeCosto()" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="impuesto">Iva</label>
                        <select name="impuesto" class="form-control" id="impuesto" >
                            {{-- @foreach($taxes as $tax)
                            <option value="{{$tax->id}}">{{$tax->name}}</option>
                            @endforeach --}}
                            <option value="0}">EXENTO</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="profit">% utilidad</label>
                        <input type="number" class="form-control" name="profit" id="inputProfit" placeholder="%" onchange="changePercent()" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="price">Precio</label>
                        <input type="number" class="form-control" name="price" id="inputPrice" placeholder="$" onchange="changePrice()" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="reference">Referencia</label>
                        <input type="text" name="reference" class="form-control" id="inputReference">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="state">Estado</label>
                        <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" id="customControlAutosizing" name="state"
                                checked>
                            <label class="custom-control-label" for="customControlAutosizing">Activo</label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="bar_code">Cod Barras</label>
                        <input type="text" name="bar_code" class="form-control" id="inputCodeBar">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control data-autofocus" placeholder="Nombre Producto" name="name" id="inputName" >
                </div>


                <div class="form-check">
                    <input class="form-check-input" type="checkbox" checked name="state">
                    <label class="form-check-label" for="activo">
                      Activo
                    </label>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="">Guardar</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
