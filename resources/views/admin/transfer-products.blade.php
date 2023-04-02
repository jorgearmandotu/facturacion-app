@extends('adminlte::page')

@section('title', 'Translados')

@section('css')
    <link rel="stylesheet" href="../../css/main.css">
    @livewireStyles
 @stop

@section('content_header')
@stop

@section('content')
    <h1>Translados de Bodega</h1>
    <div class="container-fluid containers">
        <livewire:products.transfer-locations />
        <button type="button" class="btn btn-warning"  onclick="addInput()">Agregar</button>
        <table style="min-width: 80%">
            <thead>
                <form id="form-products" method="POST" action="transfer-products">
                @csrf
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Desde</th>
                    <th>Hacia</th>
                    {{-- <th>Options</th> --}}
                </tr>
            </thead>
            <tbody id="tbody">
            </tbody>
        </table>
        <button type="submit" class="btn btn-success"  onclick="generarTranslado(event)">Generar Translado</button>
    </form>
    </div>

@stop()

@section('footer')
@stop

@section('plugins.Datatables', true)
@section('js')
    <script src="../../js/tools.js"></script>
    <script src="../../js/transfer-products.js"></script>
    @livewireScripts
@stop
