@extends('adminlte::page')

@section('title', 'Cuentas por pagar')

@section('css')
    <link rel="stylesheet" href="../../css/main.css">
    @livewireStyles
@stop

@section('content_header')
@stop

@section('content')
    <h1>Cuentas por pagar</h1>
    <div class="container-fluid align-items-rigth">
        <div class="container col-md-10 tables">
            <table id="pendingInvoicesTable" class="table table-striped table-bordered bg-light" style="width:100%">
                <thead>
                    <tr>
                        <th>Fecha Factura</th>
                        <th>Fecha de cargue</th>
                        <th>Numero</th>
                        <th>Identificación</th>
                        <th>Tercero</th>
                        <th>vlr total</th>
                        <th>Saldo pendiente</th>
                        <th>Usuario</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoices as $invoice)
                    <tr>
                        <td>{{$invoice->date_invoice}}</td>
                        <td>{{$invoice->date_upload}}</td>
                        <td>{{$invoice->number}}</td>
                        <td>{{$invoice->suppliers->dni}}</td>
                        <td>{{$invoice->suppliers->name}}</td>
                        <td>{{ number_format($invoice->total, 2, ',', '.') }}</td>
                        @php
                        $saldo = $invoice->total;
                        foreach ($invoice->discharges as $discharge) {
                            $saldo -= $discharge->mount;
                        }
                        @endphp
                        <td>{{ number_format($saldo, 2, ',', '.') }}</td>
                        {{-- @php
                            $receipts = App\Models\Discharge::where('invoice_id', $invoice->id)->get();
                            $saldo = $invoice->vlr_total;
                            foreach ($receipts as $receipt) {
                                $saldo -= $receipt->vlr_payment;
                                if($receipt->remision){
                                    $saldo -= $receipt->remision->vlr_payment;
                                }
                            }
                        @endphp --}}
                        {{-- <td>{{ number_format($saldo, 2, ',', '.') }}</td>
                        <td><a href="printInvoice/{{$invoice->id}}">Ver</a></td> --}}
                        <td>{{ $invoice->user->name }}</td>
                        <td> <a href="payInvoice/{{$invoice->id}}"><button type="button" class="btn btn-success">Pagar</button></a> <a href="printShoppingInvoice/{{$invoice->id}}" target="blank"><button class="btn btn-info" type="button"><i class="far fa-eye"></i></button></a></td>
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
    <script src="../../js/acountsPayables.js"></script>
    {{-- @livewireScripts --}}
 @stop
