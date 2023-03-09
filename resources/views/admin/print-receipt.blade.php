@extends('adminlte::page')

@section('title', 'Factura')

@section('css')
    <link rel="stylesheet" href="../../css/main.css">
    @livewireStyles
@stop

@section('content_header')
@stop

@section('content')

    <div class="container col-md-10">
        <div class="d-print-none">
            <h1>Detalle de Recibo</h1>
        </div>
        <div class="row justify-content-center container-fluid col-md-12">
            <div class="col col-md-12 text-center">
                <h3 class="p-0 m-0">{{ $company->name_view }}</h3>
                <span>{{ $company->razon_social }}<br>
                    Nit. {{ $company->dni }}<br>
                    {{ $company->address }}<br>
                    {{ $company->phone }}</span>
            </div>
        </div>
        <hr>
    <div class="row container-fluid col-md-12">
        <div class="col">
            <strong>No. {{$receipt->id}}</strong>
        </div>
        <div class="col">
            <p> Pago: {{ $receipt->type }}</p>
        </div>
        <div class="col text-center">
            <p>Fecha: {{ str_replace('-','/', $receipt->date) }}</p>
        </div>
    </div>
    </div>
    <div class="row col-md-12">
        <table width=100%>
            <tr>
                <td class="invoiceTitle">Nombre:</td>
                <td class="invoiceText">{{Str::substr($invoice->clients->name, 0, 35) }}</td>
                <td class="invoiceTitle">Identificación:</td>
                <td class="invoiceText">{{ $invoice->clients->dni }}</td>
            </tr>
            <tr>
                <td>Dirección:</td>
                <td>{{ substr($invoice->clients->address, 0, 35) }}</td>
                <td>Teléfono:</td>
                <td>{{ $invoice->clients->phone }}</td>
            </tr>
            <tr>
                <td>e-mail:</td>
                <td>{{Str::substr($invoice->clients->email, 0, 35) }}</td>
                <td>Vendedor:</td>
                <td>{{ $seller->name }}</td>
            </tr>
        </table>
    </div>
@stop

@section('footer')
@stop

@section('plugins.Datatables', true)
@section('js')
    {{-- <script src="../../js/tools.js"></script>
        <script src="../../js/invoice.js"></script> --}}
    {{-- <script src="../../js/clients.js"></script> --}}
    @livewireScripts
@stop
