<div>
    <div class="row">
        <button class="btn btn-light border" data-toggle="modal" data-target="#{{$id}}"><i class="fas fa-solid fa-plus"></i> {{ $buttonText }}</button>
    </div>

    <div class="modal fade" id="{{$id}}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{ $title }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="{{$formId}}">
            <div class="modal-body">
                @csrf
                <div class="form-group row">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control data-autofocus" placeholder="{{ $placeholder }}" name="name" id="inputName" >
                </div>
                @if($formId == 'formGroup')
                    <livewire:select-line />
                @endif
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" checked name="state">
                    <label class="form-check-label" for="activo">
                      Activo
                    </label>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="{{ $event }}">Guardar</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
