@extends('adminlte::page')

@section('title', 'documentos')

@section('css')
<link rel="stylesheet" href="../../css/main.css">
{{-- @livewireStyles --}}
@stop

@section('content_header')
@stop

@section('content')
<div class="container-fluid containers">
        <h1>Gestion de documentos</h1>
        <div class="container">
            <div class="row">
                <label for="">Facturas de venta</label>
            </div>
            <form action="invoices-share" method="post">
                @csrf
                <div class="form-row form">
                    <div class="form-group col-md-3">
                        <label for="dateInitial">Fecha inical</label>
                        <input type="date" class="form-control" name="dateInitial" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="dateFinal">Fecha Final</label>
                        <input type="date" class="form-control" name="dateFinal">
                    </div>
                    <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-info mt-4" >Buscar</button>
                    </div>
                </div>
            </form>
            @if(isset($invoices))
            <table id="invoiceTable" class="table table-striped table-bordered bg-light" style="width:100%">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Prefijo</th>
                        <th>Número</th>
                        <th>Cliente</th>
                        <th>Identificación</th>
                        <th>Vlr. total</th>
                        <th>Estado</th>
                        <th>usuario</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->date_invoice }}</td>
                            <td>{{ $invoice->prefijo }}</td>
                            <td>{{ $invoice->number }}</td>
                            <td>{{ $invoice->clients->name }}</td>
                            <td>{{ $invoice->clients->dni }}</td>
                            <td>{{ number_format($invoice->vlr_total, 2, ',', '.') }}</td>
                            <td>{{ $invoice->state->value }}</td>
                            <td>{{ $invoice->user->name }}</td>
                            <td><button class="btn btn-danger" onclick="invoice({{$invoice->id}})">Anular</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
@stop

@section('footer')
@stop

@section('plugins.Datatables', true)
@section('js')
    {{-- <script src="../js/gestion-inventarios.js"></script> --}}
    {{-- @livewireScripts --}}
@stop
