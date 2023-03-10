@extends('adminlte::page')

@section('title', 'Remision')

@section('css')
    <link rel="stylesheet" href="../../css/main.css">
    {{-- @livewireStyles --}}
@stop

@section('content_header')
@stop

@section('content')
    <h1>Exportaciones</h1>

    <div class="conatiner">
        <ul>
            <li><a href="exportInvoices">Exportar facturas</a></li>
        </ul>
    </div>

@stop

@section('footer')
@stop

@section('plugins.Datatables', true)
@section('js')
    {{-- <script src="../../js/tools.js"></script>
    <script src="../../js/products.js"></script>
    @livewireScripts --}}
@stop
