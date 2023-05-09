@extends('adminlte::page')

@section('title', 'Factura de compra')

@section('css')
    <link rel="stylesheet" href="../../css/main.css">
    {{-- @livewireStyles --}}
@stop

@section('content_header')
@stop

@section('content')

<div class="container col-md-10">
    <div class="d-print-none">
        <h1>Detalle de factura de compra</h1>
    </div>
    <div class="row justify-content-center container-fluid col-md-12">
        {{-- <div class="col-md-3">
            <h3 class="p-0 m-0"><img src="../../assets/aetius-logo-transparencia.png"  style="max-width: 70px" alt="">{{ $company->name_view }}</h3>
            <span>{{ $company->razon_social }}<br>
                Nit. {{ $company->dni }}<br>
                {{ $company->address }}<br>
                {{ $company->phone }}</span>
        </div>
        <div class="col col-md-5 ">
                <strong>Factura No. {{$invoice->number}}</strong>
                <p>Fecha factura: {{ $invoice->date_invoice }}<br>
                Fecha de cargue: {{ str_replace('-','/', $invoice->date_upload) }}<br>
                Proveedor: {{Str::substr($supplier->name, 0, 35) }}<br>
                Nit/CC : {{ $supplier->dni }}<br>
            </p>
        </div>
        <div class="col-md-4">
            <p>
                Dirección: {{ substr($supplier->address, 0, 35) }}<br>
                Télefono: {{ $supplier->phone }}<br>
                Córreo electronico: {{Str::substr($supplier->email, 0, 35) }}<br>
                Usuario: {{ $user->name }}
            </p>
        </div> --}}
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
            <strong>No. {{$invoice->number}}</strong>
        </div>
        <div class="col">
            <p>Fecha factura: {{ $invoice->date_invoice }}</p>
        </div>
        <div class="col text-center">
            <p>Fecha de cargue: {{ str_replace('-','/', $invoice->date_upload) }}</p>
        </div>
    </div>
    <div class="row col-md-12">
        <table width=100%>
            <tr>
                <td class="invoiceTitle">Proveedor:</td>
                <td class="invoiceText">{{Str::substr($supplier->name, 0, 35) }}</td>
                <td class="invoiceTitle">Identificación:</td>
                <td class="invoiceText">{{ $supplier->dni }}</td>
            </tr>
            <tr>
                <td>Dirección:</td>
                <td>{{ substr($supplier->address, 0, 35) }}</td>
                <td>Teléfono:</td>
                <td>{{ $supplier->phone }}</td>
            </tr>
            <tr>
                <td>e-mail:</td>
                <td>{{Str::substr($supplier->email, 0, 35) }}</td>
                <td>Usuario:</td>
                <td>{{ $user->name }}</td>
            </tr>
        </table>
    </div>
    <hr>
    <div class="row">
        <table width=100%>
            <thead class="border-bottom">
                <tr>
                    {{-- <td style="width: 5%;" class="text-center">#</td> --}}
                    <td style="width: 10%" class="text-center">CÓDIGO</td>
                    <td style="width: 30%" class="text-center">DESCRIPCIÓN</td>
                    <td style="width: 10%" class="text-center">CANT.</td>
                    <td style="width: 15%" class="text-center">Vr UNITARIO</td>
                    <td style="width: 10%" class="text-center">%IVA</td>
                    <td style="width: 10%" class="text-center">SUB. TOTAL</td>
                </tr>
            </thead>
            <tbody>
                @php
                $iva = 0;
                $subTotal = 0;
                @endphp
                @foreach ($invoice->products as $item)
                <tr>
                    {{-- <td class="text-center">{{ $item->position }}</td> --}}
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
                    <td class="text-right"><strong>Iva:</strong></td>
                    <td class="text-right">{{ number_format(($iva ), 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td class="text-right"><strong>Total:</strong></td>
                    <td class="text-right">{{ number_format(($invoice->total ), 2, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
    <hr>
    {{-- <div class="justify-content-center col-md-12 text-center">
        <span class="text-center">Favor revisar su mercancia andes de salir del establecimiento, una vez entregado no se aceptan Reclamaciones.<br></span>
    <span class="">Numero de resolucion: {{ $resolution->number }}<br>
    Aprovado en: {{ $resolution->date_resolution }} Vigencia: {{ $resolution->validity }}<br>
    Prefijo: {{$resolution->prefijo }} del {{$resolution->initial_number}} hasta {{$resolution->final_number}}</span>
    </div> --}}
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
