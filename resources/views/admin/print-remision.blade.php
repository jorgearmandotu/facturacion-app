@extends('adminlte::page')

@section('title', 'Remision')

@section('css')
    <link rel="stylesheet" href="../../css/main.css">
    {{-- @livewireStyles --}}
@stop

@section('content_header')
@stop

@section('content')

    <div class="container col-md-10">
        <div class="d-print-none">
            <h1>Detalle de Remision</h1>
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
            <div class="col justify-start col-md-5">
                <strong>Remision No. {{ $remision->id }}</strong>
            </div>
            <div class="col col-md-3">
                <p> Pago: {{ $remision->payment_method }}</p>
            </div>
            <div class="col text-center">
                <p>Fecha: {{ str_replace('-', '/', $remision->date_remision) }}</p>
            </div>
        </div>
        <div class="row container-fluid">
            {{-- <div class="col col-md-3">
                <p> Documento: {{ $remision->tercero->documentType->name }}</p>
            </div> --}}
            <div class="col col-md-5">
                <p>Cliente: {{ $remision->tercero->documentType->name }} - {{ $remision->tercero->dni }}</p>
            </div>
            <div class="col justify-start col-md-5">
                <p> {{ $remision->tercero->name }}</p>
            </div>
        </div>
        <div class="row container-fluid">
            <div class="col justify-start col-md-5">
                <p>Quien recibe: {{ $seller->name }}</p>
            </div>
            <div class="col col-md-3">
                <p> Valor: {{ number_format($remision->vlr_payment, 2, ',', '.') }}</p>
            </div>
            <div class="col col-md-3">
                <p> Valor del servicio: {{ number_format($remision->vlr_total, 2, ',', '.') }}</p>
            </div>
        </div>
        <div class="row col-md-12 justify-start">
            <hr>
            <table width=100%>
                <thead class="border">
                    <tr>
                        <th class="border" style="width: 8%" class="text-rigth">Concepto</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            @php
                                echo str_replace(["\r\n", "\n\r", "\r", "\n"], '<br>', $remision->description);
                            @endphp
                        </td>
                </tbody>
                <tfoot></tfoot>
            </table>
        </div>
    </div>
    <hr>
    <div class="justify-content-center col-md-12 text-center">
        <span class="text-center">Favor revisar que los datos sean correctos, una vez salga del establecimiento no se
            aceptan reclamaciones.<br></span>
    </div>
    </div>
@stop

@section('footer')
@stop

@section('plugins.Datatables', true)
@section('js')
    {{-- <script src="../../js/tools.js"></script>
        <script src="../../js/invoice.js"></script> --}}
    {{-- <script src="../../js/clients.js"></script> --}}
    {{-- @livewireScripts --}}
@stop
