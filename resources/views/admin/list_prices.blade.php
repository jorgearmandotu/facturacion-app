@extends('adminlte::page')

@section('title', 'Inventario')

@section('css')
<link rel="stylesheet" href="../../css/main.css">
@livewireStyles
@stop

@section('content_header')
@stop

@section('content')
<h1>listado de precios</h1>
@stop

@section('footer')
@stop

@section('plugins.Datatables', true)
@section('js')
    <script src="../../js/tools.js"></script>
    <script src="../../js/products.js"></script>
    @livewireScripts
@stop
