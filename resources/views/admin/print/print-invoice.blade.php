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
        <h1>Detalle de factura</h1>
    </div>
    <div class="row justify-content-center container-fluid col-md-12">
        <div class="col col-md-12 text-center">
            <h3 class="p-0 m-0">{{ $company->name_view }}</h3>
            <span>{{ $company->razon_social }}<br>
                Nit. {{ $company->dni }}<br>
                {{ $company->address }}<br>
                {{ $company->phone }}</span>
            {{-- <p class="p-0 m-0">{{ $company->razon_social }}</p>
            <p class="p-0 m-0">Nit. {{ $company->dni }}</p>
            <p class="p-0 m-0">{{ $company->address }}</p>
            <p class="p-0 m-0">{{ $company->phone }} </p> --}}
        </div>
    </div>
    <hr>
    <div class="row container-fluid col-md-12">
        <div class="col">
            <strong>No. {{$invoice->prefijo}}-{{$invoice->number}}</strong>
        </div>
        <div class="col">
            <p> Pago: {{ $invoice->type }}</p>
        </div>
        <div class="col text-center">
            <p>Fecha: {{ str_replace('-','/', $invoice->date_invoice) }}</p>
        </div>
    </div>
    <div class="row col-md-12">
        <table width=100%>
            <tr>
                <td class="invoiceTitle">Nombre:</td>
                <td class="invoiceText">{{Str::substr($client->name, 0, 35) }}</td>
                <td class="invoiceTitle">Identificación:</td>
                <td class="invoiceText">{{ $client->dni }}</td>
            </tr>
            <tr>
                <td>Dirección:</td>
                <td>{{ substr($client->address, 0, 35) }}</td>
                <td>Teléfono:</td>
                <td>{{ $client->phone }}</td>
            </tr>
            <tr>
                <td>e-mail:</td>
                <td>{{Str::substr($client->email, 0, 35) }}</td>
                <td>Vendedor:</td>
                <td>{{ $seller->name }}</td>
            </tr>
        </table>
    </div>
    <hr>
    <div class="row">
        <table width=100%>
            <thead class="border-bottom">
                <tr>
                    <td style="width: 5%;" class="text-center">#</td>
                    <td style="width: 10%" class="text-center">CÓDIGO</td>
                    <td style="width: 40%" class="text-center">DESCRIPCIÓN</td>
                    <td style="width: 10%" class="text-center">CANT.</td>
                    <td style="width: 15%" class="text-center">Vr UNITARIO</td>
                    <td style="width: 10%" class="text-center">%IVA</td>
                    <td style="width: 20%" class="text-center">SUB. TOTAL</td>
                </tr>
            </thead>
            <tbody>
                @php
                $iva = 0;
                $subTotal = 0;
                @endphp
                @foreach ($invoice->dataInvoices as $item)
                <tr>
                    <td class="text-center">{{ $item->position }}</td>
                    <td class="text-center">{{ $item->product->code }}</td>
                    <td>{{ $item->product->name }}</td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right">{{ number_format($item->vlr_unit, 2, ',','.') }}</td>
                    <td class="text-center">{{ $item->vlr_tax }}</td>
                    @php
                    $value = $item->quantity*$item->vlr_unit;
                    $subTotal += $value;
                    $iva += ($value)*$item->vlr_tax/100;
                    @endphp
                    <td class="text-right">{{ number_format($item->vlr_unit*$item->quantity, 2, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="border-top">
                <tr>
                    <td colspan="4"></td>
                    <td colspan="2" class="text-right"><strong>Sub. Total</strong></td>
                    <td class="text-right">{{ number_format($subTotal, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td colspan="2" class="text-right"><strong>Descuento</strong></td>
                    <td class="text-right">{{ number_format($invoice->discount, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="5"></td>
                    <td class="text-right"><strong>IVA:</strong></td>
                    <td class="text-right">{{ number_format($iva,2 ,',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="5"></td>
                    <td class="text-right"><strong>Total:</strong></td>
                    <td class="text-right">{{ number_format(($invoice->vlr_total - $invoice->discount), 2, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
    <hr>
    <div class="col-md-12">
        <strong>Observaciones:</strong>
        <p>{!! nl2br(e($invoice->observation)) !!}</p>
        {{-- <textarea name="" id="" cols="30" rows="3" class="form-control" disabled>{{$invoice->observation}}</textarea> --}}
    </div>
    <hr>
    <div class="justify-content-center col-md-12 text-center">
        <span class="text-center">Favor revisar su mercancia andes de salir del establecimiento, una vez entregado no se aceptan Reclamaciones.<br></span>
    @if($company->usa_resolucion_factura)
        <span class="">Numero de resolucion: {{ $resolution->number }}<br>
        Aprovado en: {{ $resolution->date_resolution }} Vigencia: {{ $resolution->validity }}<br>
        Prefijo: {{$resolution->prefijo }} del {{$resolution->initial_number}} hasta {{$resolution->final_number}}</span>
    @endif
    </div>
    <div class="justify-content-center col-md-12 text-center">
        <button type="button" class="btn btn-primary d-print-none mt-2" onclick="window.print()"><i class="fas fa-print"></i> Imprimir</button>
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
    @livewireScripts
@stop
