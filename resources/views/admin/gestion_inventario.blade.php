@extends('adminlte::page')

@section('title', 'Inventario')

@section('css')
<link rel="stylesheet" href="../../css/main.css">
@livewireStyles
@stop

@section('content_header')
@stop

@section('content')
<div class="container-fluid containers">
        <h1>Lineas</h1>
        <x-admin.form-modalproperties-inventario id="modalLine" formId="formLine" title="Crear Linea" buttonText="Crear Linea" placeholder="Nombre Linea" event="save('/admin/lines', 'formLine')" />
        {{-- <div class="row">
            @livewire('lineas-create')
        </div> --}}
        <div class="container col-md-8 tables">
            <table id="linesTable" class="table table-striped table-bordered bg-light" style="width:100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
            </table>
        </div>
</div>

<div class="container-fluid containers">
    <h1>Grupos</h1>
    <x-admin.form-modalproperties-inventario id="modalGroup" formId="formGroup" title="Crear Grupo" buttonText="Crear Grupo" placeholder="Nombre Grupo" event="save('/admin/groups', 'formGroup')" />
    <div class="container col-md-8 tables">
        <table id="groupsTable" class="table table-striped table-bordered bg-light" style="width:100%">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Linea</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="container-fluid containers">
    <h1>Ubicaciones</h1>
    <x-admin.form-modalproperties-inventario id="modalLocation" formId="formLocation" title="Crear Ubicación" buttonText="Crear Ubicación" placeholder="Nombre Ubicación" event="save('/admin/locations', 'formLocation')" />

    <div class="container col-md-8 tables">
        <table id="locationsTable" class="table table-striped table-bordered bg-light" style="width:100%">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Opciones</th>
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
<script src="../js/gestion-inventarios.js"></script>
@livewireScripts
@stop
