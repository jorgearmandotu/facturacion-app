@extends('adminlte::page')

@section('title', 'Inventario')

@section('css')
    <link rel="stylesheet" href="../../css/main.css">
    @livewireStyles
@stop

@section('content_header')
@stop

@section('content')
    <h1>Creacion de Factura</h1>

    <x-messages_flash />

    <div class=" container-fuid col-md-8 containers">
        <form method="POST" action="{{route('invoices')}}" >
            @csrf

            <livewire:invoice.search-clients />

        </form>
    </div>
@stop

@section('footer')
@stop

@section('plugins.Datatables', true)
@section('js')
    <script src="../../js/tools.js"></script>
    {{-- <script src="../../js/clients.js"></script> --}}
    @livewireScripts
@stop
