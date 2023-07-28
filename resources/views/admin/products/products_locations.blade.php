@extends('adminlte::page')

@section('title', 'Productos por ubicacion')

@section('css')
<link rel="stylesheet" href="../../css/main.css">
@livewireStyles
@stop
@section('content_header')
@stop

@section('content')
<h1>Productos por ubicación</h1>
<div class="container col-md-11 tables">
    <table id="productsTableLocations" class="table table-striped table-bordered bg-light" style="width:100%">
        <thead>
            <tr>
                <th>Código</th>
                <th>Linea</th>
                <th>grupo</th>
                <th>Nombre</th>
                <th>Existencias</th>
                <th>Ubicación</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{$product->codigo}}</td>
                <td>{{$product->line}}</td>
                <td>{{$product->grupo}}</td>
                <td>{{$product->product}}</td>
                <td>{{$product->stock}}</td>
                <td>{{$product->ubicacion}}</td>
                <td>{{$product->estado}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{-- <x-admin.form-modal-edit-product-coponent /> --}}

@stop

@section('footer')
@stop

@section('plugins.Datatables', true)
@section('js')
    <script>

    </script>
    {{-- <script src="../../js/tools.js"></script> --}}
    <script src="../../js/products.js"></script>
    {{-- <script src="../../js/datatables-buttons/dataTables.buttons.min.js"></script>
    <script src="../../js/datatables-buttons/jszip.min.js"></script>
    <script src="../../js/datatables-buttons/pdfmake.min.js"></script>
    <script src="../../js/datatables-buttons/vfs_fonts.js"></script>
    <script src="../../js/datatables-buttons/buttons.html5.min.js"></script>
    <script src="../../js/datatables-buttons/buttons.print.min.js"></script> --}}
    @livewireScripts
@stop
