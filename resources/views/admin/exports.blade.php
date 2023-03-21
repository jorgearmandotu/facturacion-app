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

        <x-messages_flash />
        <label for="">Exportar facturas de venta</label>
        {{-- <ul>
            <li><a href="exportInvoices">Exportar facturas</a></li>
        </ul> --}}
        <form action="exportInvoices" method="post">
            @csrf
            <div class="form-row form">
                <div class="form-group col-md-3">
                    <label for="dateInitial">Fecha inical</label>
                    <input type="date" class="form-control" name="dateInitial">
                </div>
                <div class="form-group col-md-3">
                    <label for="dateFinal">Fecha Final</label>
                    <input type="date" class="form-control" name="dateFinal">
                </div>
                <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-info mt-4" >Generar</button>
                </div>
            </div>
        </form>
        <label for="">Exportar recibos de caja</label>
        <form action="exportReceipts" method="post">
            @csrf
            <div class="form-row form">
                <div class="form-group col-md-3">
                    <label for="dateInitial">Fecha inical</label>
                    <input type="date" class="form-control" name="dateInitial">
                </div>
                <div class="form-group col-md-3">
                    <label for="dateFinal">Fecha Final</label>
                    <input type="date" class="form-control" name="dateFinal">
                </div>
                <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-info mt-4" >Generar</button>
                </div>
            </div>
        </form>
        <label for="">Exportar facturas de compra</label>
        <form action="exportShoppingInvoices" method="post">
            @csrf
            <div class="form-row form">
                <div class="form-group col-md-3">
                    <label for="dateInitial">Fecha inical</label>
                    <input type="date" class="form-control" name="dateInitial">
                </div>
                <div class="form-group col-md-3">
                    <label for="dateFinal">Fecha Final</label>
                    <input type="date" class="form-control" name="dateFinal">
                </div>
                <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-info mt-4" >Generar</button>
                </div>
            </div>
        </form>
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
