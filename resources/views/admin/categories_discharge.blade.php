@extends('adminlte::page')

@section('title', 'Categorias de egresos')

@section('css')
    <link rel="stylesheet" href="../../css/main.css">
    @livewireStyles
@stop

@section('content_header')
@stop

@section('content')
    <h1>Categorias de egreso</h1>
    <div class="content-fluid">
        <div class="row">
            <button class="btn btn-light border" data-toggle="modal" data-target="#modalCategory"><i class="fas fa-solid fa-plus"></i>Crear categoria</button>
        </div>

        <div class="modal fade" id="modalCategory" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Crear categoria</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form id="formCategory">
                <div class="modal-body">
                    @csrf
                    <div class="form-group row">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control data-autofocus" placeholder="Nombre categoria" name="name" id="inputName" >
                    </div>
                    {{-- <div class="form-check">
                        <input class="form-check-input" type="checkbox" checked name="state">
                        <label class="form-check-label" for="activo">
                          Activo
                        </label>
                      </div>
                    </div> --}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success"  onclick="crearCategory(event)">Guardar</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="container tables">
            <table id="categoriesTable" class="table table-striped table-bordered bg-light" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Categoria</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

@stop

@section('footer')
@stop

@section('plugins.Datatables', true)
@section('js')
    <script src="../../js/tools.js"></script>
    <script src="../../js/category_discharge.js"></script>
    {{-- @livewireScripts --}}
 @stop
