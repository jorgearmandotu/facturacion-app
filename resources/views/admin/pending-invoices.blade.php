@extends('adminlte::page')

@section('title', 'facturas-pendientes')

@section('css')
<link rel="stylesheet" href="../../css/main.css">
@livewireStyles
@stop

@section('content_header')
@stop

@section('content')
<h1>Facturas credito pendientes</h1>

<div class="container">
    <div class="container col-md-11 tables">
        <table id="pendingInvoicesTable" class="table table-striped table-bordered bg-light" style="width:100%">
            <thead>
                <tr>
                    <th>Prefijo</th>
                    <th>Numero</th>
                    <th>Cliente</th>
                    <th>Identificación</th>
                    <th>vlr total</th>
                    <th>Saldo pendiente</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoices as $invoice)
                <tr>
                    <td>{{$invoice->prefijo}}</td>
                    <td>{{$invoice->number}}</td>
                    <td>{{$invoice->clients->name}}</td>
                    <td>{{$invoice->clients->dni}}</td>
                    <td>{{ number_format($invoice->vlr_total, 2, ',', '.') }}</td>
                    @php
                        $receipts = App\Models\Receipt::where('invoice_id', $invoice->id)->get();
                        $saldo = $invoice->vlr_total;
                        foreach ($receipts as $receipt) {
                            $saldo -= $receipt->vlr_payment;
                        }
                    @endphp
                    <td>{{ number_format($saldo, 2, ',', '.') }}</td>
                    <td><a href="printInvoice/{{$invoice->id}}">Ver</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop

@section('footer')
@stop

@section('plugins.Datatables', true)
@section('js')
    <script src="../../js/tools.js"></script>
    <script src="../../js/pending-invoices.js"></script>
    @livewireScripts
@stop
