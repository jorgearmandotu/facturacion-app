@extends('adminlte::page')

@section('title', 'Inventario')

@section('css')
<link rel="stylesheet" href="../../css/main.css">
@livewireStyles
@stop

@section('content_header')
@stop

@section('content')
<h1>Productos</h1>
<div class="container tables">
    <table id="productsTable" class="table table-striped table-bordered bg-light" style="width:100%">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Referencia</th>
                <th>Costo</th>
                <th>Precio</th>
                <th>% utilidad</th>
                <th>Linea</th>
                <th>grupo</th>
                <th>Código</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
        </thead>
    </table>
</div>

<x-admin.form-modal-edit-product />

@stop

@section('footer')
@stop

@section('plugins.Datatables', true)
@section('js')
    <script src="../../js/products.js"></script>
@livewireScripts
@stop