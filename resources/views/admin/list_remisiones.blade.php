@extends('adminlte::page')

@section('title', 'Remisiones')

@section('css')
<link rel="stylesheet" href="../../css/main.css">
{{-- @livewireStyles --}}
@stop

@section('content_header')
@stop

@section('content')
<h1>Remisiones pendientes</h1>
<div class="container">
    <div class="container tables">
        <table id="remisonesTable" class="table table-striped table-bordered bg-light" style="width:100%">
            <thead>
                <tr>
                    {{-- <th>Tipo De Documento</th> --}}
                    <th>Identificación</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>valor total</th>
                    <th>opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($remisiones as $remision)
                <tr>
                    <td>{{ $remision->clients->dni }}</td>
                    <td>{{ $remision->clients->name }}</td>
                    <td>{{ $remision->clients->phone }}</td>
                    <td>{{ number_format($remision->vlr_total, 2, ',', '.') }}</td>
                    <td><a href="printRemision/{{ $remision->id}}">Ver</a> </td>
                </tr>
                @endforeach
            </tbody>
        </table>
</div>
@stop

@section('footer')
@stop

@section('plugins.Datatables', true)
@section('js')
    <script src="../../js/tools.js"></script>
    {{-- <script src="../../js/products.js"></script> --}}
    {{-- @livewireScripts --}}
@stop
