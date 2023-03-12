@extends('adminlte::page')

@section('title', 'Proveedores')

@section('css')
    <link rel="stylesheet" href="../../css/main.css">
    @livewireStyles
@stop

@section('content_header')
@stop

@section('content')
    <h1>Proveedores</h1>
    {{-- <div class="row containers">
        <button class="btn btn-light border" data-toggle="modal" data-target="#modalSuppliers"><i
                class="fas fa-solid fa-plus"></i>Agregar Proveedores</button>
    </div> --}}

    {{-- <div class="modal fade" id="modalSuppliers" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crear Proveedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formSupplier" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group row">
                            <label for="name">Identificación (NIT)</label>
                            <input type="number" class="form-control data-autofocus" placeholder="Identificación Proveedor"
                                name="dni" id="inputDni" required>
                        </div>
                        <div class="form-group row">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control data-autofocus" placeholder="Nombre Proveedor"
                                name="name" id="inputName" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success" data-dismiss="modal" onclick="save(event)">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}

    <div class="container col-md-8 tables">
        <table id="suppliersTable" class="table table-striped table-bordered bg-light" style="width:100%">
            <thead>
                <tr>
                    <th>NIT</th>
                    <th>NOMBRE</th>
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
    <script src="../../js/suppliers.js"></script>
    {{-- @livewireScripts --}}
@stop
