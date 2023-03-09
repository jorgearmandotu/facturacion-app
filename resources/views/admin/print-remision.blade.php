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
        <div class="col justify-start">
            <strong>Remision No. {{$remision->id}}</strong>
        </div>
        <div class="col">
            <p> Pago: {{ $remision->payment_method }}</p>
        </div>
        <div class="col text-center">
            <p>Fecha: {{ str_replace('-','/', $remision->date_remision) }}</p>
        </div>
    </div>
    </div>
    <div class="row col-md-12">
        <table width=20%>
            {{-- <tr>
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
            </tr> --}}
            <tr>
                {{-- <td>e-mail:</td>
                <td>{{Str::substr($invoice->clients->email, 0, 35) }}</td> --}}
                <td>Quien recibe: {{ $seller->name }}</td>
                <td></td>
            </tr>
        </table>
        <hr>
        <table width=90%>
            <thead class="border">
                <tr>
                    <th class="border" style="width: 3%;" class="text-rigth">#</th>
                    <th class="border" style="width: 8%" class="text-rigth">Concepto</th>
                    <th class="border" style="width: 14%" class="text-rigth">cliente</th>
                    <th class="border" style="width: 10%" class="text-rigth">identificación</th>
                    <th class="border" style="width: 15%" class="text-rigth">Valor pagado</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    {{-- <td class="border">1</td>
                    <td class="border">{{ $invoice->prefijo}} - {{ $invoice->number }}</td>
                    <td class="border">{{ $invoice->clients->name }}</td>
                    <td class="border">{{ $invoice->clients->dni }}</td>
                    <td class="border">{{ number_format($receipt->vlr_payment,2, ',', '.') }}</td> --}}
                </tr>
            </tbody>
            <tfoot></tfoot>
        </table>
    </div>
    <hr>
    <div class="justify-content-center col-md-12 text-center">
        <span class="text-center">Favor revisar que los datos sean correctos, una vez salga del establecimiento no se aceptan reclamaciones.<br></span>
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
