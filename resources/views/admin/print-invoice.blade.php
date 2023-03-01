@extends('adminlte::page')

@section('title', 'Inventario')

@section('css')
    <link rel="stylesheet" href="../../css/main.css">
    @livewireStyles
@stop

@section('content_header')
@stop

@section('content')

<div class="container">
    <h1>Detalle de factura</h1>
    <div class="row justify-content-center container-fluid col-md-8">
        <div class="col col-md-12 text-center">
            <h3 class="p-0 m-0">Aetius</h3>
            <p class="p-0 m-0">La casa del estampado</p>
            <p class="p-0 m-0">Nit. 1.xx.xx.xx.xx.</p>
            <p class="p-0 m-0">calle 16 Pasto</p>
            <p class="p-0 m-0">Telefono: </p>
        </div>
    </div>
    <div class="row container-fluid col-md-8">
        <div class="col">
            <strong>No. {{$invoice->number}}</strong>
        </div>
        <div class="col">
            <p> Pago: {{ $invoice->type }}</p>
        </div>
        <div class="col text-right">
            <p>Fecha: {{ str_replace('-','/', $invoice->date_invoice) }}</p>
        </div>
    </div>
    <div class="row com-md-8">
        <table>
            <tr>
                <td class="invoiceTitle">Nombre:</td>
                <td class="invoiceText">{{Str::substr($client->name, 0, 25) }}</td>
                <td class="invoiceTitle">Identificación:</td>
                <td class="invoiceText">{{ $client->dni }}</td>
            </tr>
            <tr>
                <td>Dirección:</td>
                <td>{{ substr($client->address, 0, 25) }}</td>
                <td>Teléfono:</td>
                <td>{{ $client->phone }}</td>
            </tr>
            <tr>
                <td>e-mail:</td>
                <td>{{Str::substr($client->email, 0, 25) }}</td>
                <td>Vendedor:</td>
                <td>{{ $seller->name }}</td>
            </tr>
        </table>
    </div>
    <hr>
    <div class="row">
        <table>
            <thead>
                <tr>
                    <td style="width: 1rem" class="text-center">#</td>
                    <td style="width: 5rem" class="text-center">Referencia</td>
                    <td style="width: 12rem" class="text-center">DESCRIPCIÓN</td>
                    <td style="width: 2rem" class="text-center">CANT.</td>
                    <td style="width: 6rem" class="text-center">Vr UNITARIO</td>
                    <td style="width: 3rem" class="text-center">%IVA</td>
                    <td style="width: 6rem" class="text-center">SUB. TOTAL</td>
                </tr>
            </thead>
            <tbody>
                @php
                $iva = 0;
                $subTotal = 0;
                @endphp
                @foreach ($invoice->dataInvoices as $item)
                <tr>
                    <td>{{ $item->position }}</td>
                    <td>{{ $item->product->code }}</td>
                    <td>{{ $item->product->name }}</td>
                    <td class="text-right">{{ $item->quantity }}</td>
                    <td class="text-right">{{ number_format($item->vlr_unit, 2, ',','.') }}</td>
                    <td class="text-right">{{ $item->vlr_tax }}</td>
                    @php
                    $value = $item->quantity*$item->vlr_unit;
                    $subTotal += $value;
                    $iva += ($value)*$item->vlr_tax/100;
                    @endphp
                    <td class="text-right">{{ number_format($item->vlr_unit*$item->quantity, 2, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4"></td>
                    <td colspan="2" class="text-right"><strong>Sub. Total</strong></td>
                    <td class="text-right">{{ number_format($subTotal, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="5"></td>
                    <td class="text-right"><strong>IVA:</strong></td>
                    <td class="text-right">{{ number_format($iva,2 ,',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="5"></td>
                    <td class="text-right"><strong>Total:</strong></td>
                    <td class="text-right">{{ number_format($invoice->vlr_total, 2, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
    <hr>
    <div class="justify-content-center col-md-8">
        <p class="text-center">Favor revisar su mercancia andes de salir del establecimiento, una vez entregado no se aceptan Reclamaciones.</p>
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
