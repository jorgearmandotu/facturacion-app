@extends('adminlte::page')

@section('title', 'Inventario')

@section('css')
    <link rel="stylesheet" href="../../css/main.css">
    @livewireStyles
@stop

@section('content_header')
@stop

@section('content')
    <h1>Clientes</h1>

    <div class="row">
        <button class="btn btn-light border" data-toggle="modal" data-target="#clientsModal" onclick="newClient(event)"><i
                class="fas fa-solid fa-plus"></i>Agregar Cliente</button>
    </div>

    <div class="modal fade" id="clientsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Creación de clientes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formClients">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group row">
                            <label for="name">tipo de Documento</label>
                            <select name="document_type" id="selectType" class="form-control">
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="from group row">
                            <label for="dni">Identificación</label>
                            <input type="number" name="dni" class="form-control" id="inputDni">
                        </div>
                        <div class="from group row">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" class="form-control" id="inputName">
                        </div>
                        <div class="from group row">
                            <label for="phone">Teléfono</label>
                            <input type="number" name="phone" class="form-control" id="inputPhone">
                        </div>
                        <div class="from group row">
                            <label for="address">Dirección</label>
                            <input type="text" name="address" class="form-control" id="inputAddress">
                        </div>
                        <div class="from group row">
                            <label for="email">Correo electronico</label>
                            <input type="email" name="email" class="form-control" id="inputEmail">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-success" data-dismiss="modal"
                                onclick="save(event)">Guardar</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <div class="container tables">
        <table id="clientsTable" class="table table-striped table-bordered bg-light" style="width:100%">
            <thead>
                <tr>
                    <th>Tipo De Documento</th>
                    <th>Identificación</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Correo Electronico</th>
                </tr>
            </thead>
        </table>
    </div>
@stop

@section('footer')
@stop

@section('plugins.Datatables', true)
@section('js')
    <script src="../../js/tools.js"></script>
    <script src="../../js/clients.js"></script>
    {{-- @livewireScripts --}}
@stop
