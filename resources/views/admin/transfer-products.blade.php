@extends('adminlte::page')

@section('title', 'Traslados')

@section('css')
    <link rel="stylesheet" href="../../css/main.css">
    @livewireStyles
 @stop

@section('content_header')
@stop

@section('content')
    <h1>Traslados de Bodega</h1>
    <x-messages_flash />
    <div class="container-fluid containers">
        <livewire:products.transfer-locations />
        <button type="button" class="btn btn-warning"  onclick="addInput()">Agregar</button>
        <table style="min-width: 80%">
            <thead>
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
        <form id="form-products" method="POST" action="transfer-products">
            @csrf
            <button type="submit" class="btn btn-success"  onclick="generarTraslado(event)">Generar Traslado</button>
        </form>
    </div>
    @if(session('transfer'))
    <script>
        let num = {{session('transfer')}};
        let print = window.open(`print-transfer/${num}`, '_blank');
    </script>
    @endif
@stop()

@section('footer')
@stop

@section('plugins.Datatables', true)
@section('js')
    <script src="../../js/tools.js"></script>
    <script src="../../js/transfer-products.js"></script>
    @livewireScripts
@stop
