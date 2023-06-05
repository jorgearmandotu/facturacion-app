@extends('adminlte::page')

@section('title', 'Configuración')

@section('css')
    <link rel="stylesheet" href="../../css/main.css">
    @livewireStyles
@stop

@section('content_header')
@stop

@section('content')
<h1>Configuraciones</h1>

<h3>Metodos de pago autorizados</h3>
<x-messages_flash />
        <form action="paymentMethodsStore" method="post">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="value">Metodo de pago</label>
                    <input type="text" class="form-control" name="value" value="" required />
                </div>
                <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-success mt-4">Agregar</button>
                </div>
            </div>
        </form>
        <div class="col-md-8">
            <table id="methodsTable" class="table table-striped table-bordered bg-light" >
                <thead>
                    <tr>
                        <th>Metodos de pago</th>
                        <th>Estado</th>
                        {{-- <th>Opciones</th> --}}
                    </tr>
                </thead>
            </table>
        </div>
        <hr>
        <h3>Impuestos</h3>
        <div class="col-md-8">
            <div class="p-2">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#taxModal">
                    Crear Nuevo
                </button>
            </div>
            <table id="taxesTable" class="table table-striped table-bordered bg-light" >
                <thead>
                    <tr>
                        <th>Impuesto</th>
                        <th>Valor en %</th>
                        <th>Descripción</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
        <hr>

        <!-- Modal -->
        <div class="modal fade" id="taxModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="taxModalLabel">Nuevo Impúesto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="formTax">
                            @csrf
                            <div class="form-row">
                                {{-- @method('PUT') --}}
                                <div class="form-group col-md-8">
                                    <label for="nameTax">Nombre</label>
                                    <input type="text" name="nameTax" id="nameTax" class="form-control">
                                    <input type="hidden" name="tax" id="tax" value="">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="valueTax">valor %</label>
                                    <input type="number" name="valueTax" id="valueTax" class="form-control">
                                </div>
                            </div>
                            <div class="form-row">
                                <label for="description">Descripción</label>
                                <input type="text" name="descriptionTax" id="descriptionTax" class="form-control">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="state">Estado</label>
                                    <div class="custom-control custom-checkbox mr-sm-2">
                                        <input type="checkbox" class="custom-control-input" id="customControlAutosizing" name="stateTax"
                                        checked>
                                    <label class="custom-control-label" for="customControlAutosizing">Activo</label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="saveTax()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
@stop

@section('footer')
@stop

@section('plugins.Datatables', true)
@section('js')
    <script src="../../js/tools.js"></script>
    <script src="../../js/configuration.js"></script>
    {{-- @livewireScripts --}}
@stop
