<div>
    <button class="btn btn-light border" data-toggle="modal" data-target="#formModal"><i class="fas fa-solid fa-plus"></i> Crear Linea</button>
    <!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Crear Linea</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group row">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" placeholder="Nombre Linea" wire:model.defer='name'>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" checked wire:model.defer='state'>
                <label class="form-check-label" for="activo">
                  Activa
                </label>
              </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" wire:click="save" data-dismiss="modal">Guardar</button>
        </div>
      </div>
    </div>
  </div>
</div>
