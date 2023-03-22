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
        <x-messages_flash />
        <div class="container-fluid">
            <div class="row">
                <label for="">Facturas de venta</label>
            </div>
            <form action="invoices-share" method="post">
                @csrf
                <div class="form-row form">
                    <div class="form-group col-md-3">
                        <label for="prefijo">Prefijo</label>
                        <input type="text" class="form-control" name="prefijo" value="{{old('prefijo')}}" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="numberInvoice">Número</label>
                        <input type="number" class="form-control" name="numberInvoice" value="{{old('numberInvoice')}}" required>
                    </div>
                    <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-info mt-4" >Buscar</button>
                    </div>
                </div>
            </form>
            @if(session('invoice'))
            <div class="row">
                <p><a href="printInvoice/{{ session('invoice')->id }}" target="_blank" class="btn btn-warning mr-2">Ver factura</a></p>
                <form action="anularInvoice" method="post">
                    @csrf
                    <input type="hidden" name="invoice" value="{{ session('invoice')->id }}">
                    @if(session('invoice')->state->value != 'Anulado')
                        <button type="submit" class="btn btn-danger">Anular</button>
                    @else
                        <strong>Factura se encuentra anulada</strong>
                    @endif
                </form>
            </div>
            @endif

            <div class="row">
                <label for="">Recibos de caja</label>
            </div>
            <form action="receipt-share" method="post">
                @csrf
                <div class="form-row form">
                    <div class="form-group col-md-3">
                        <label for="numberReceipt">Número</label>
                        <input type="number" class="form-control" name="numberReceipt" value="{{ old('numberReceipt') }}" required>
                    </div>
                    <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-info mt-4" >Buscar</button>
                    </div>
                </div>
            </form>
            @if(session('receipt'))
            <div class="row">
                <p><a href="printReceipt/{{ session('receipt')->id }}" target="_blank" class="btn btn-warning mr-2">Ver recibo de caja</a></p>
                @if(session('receipt')->state->value != 'Anulado')
                <form action="anularReceipt" method="post">
                    @csrf
                    <input type="hidden" name="receipt" value="{{ session('receipt')->id }}">
                    <button type="submit" class="btn btn-danger">Anular</button>
                </form>
                @else
                    <strong>Recibo se encuentra anulado</strong>
                @endif
            </div>
            @endif

            <div class="row">
                <label for="">Remisiones</label>
            </div>
            <form action="remision-share" method="post">
                @csrf
                <div class="form-row form">
                    <div class="form-group col-md-3">
                        <label for="numberRemision">Número</label>
                        <input type="number" class="form-control" name="numberRemision" value="{{old('numberRemision')}}">
                    </div>
                    <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-info mt-4" >Buscar</button>
                    </div>
                </div>
            </form>

            <div class="row">
                <label for="">Facturas de compra</label>
            </div>
            <form action="invoices-share" method="post">
                @csrf
                <div class="form-row form">
                    <div class="form-group col-md-3">
                        <label for="number">Número</label>
                        <input type="number" class="form-control" name="number">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="number">proveedor</label>
                        <input type="number" class="form-control" name="number">
                    </div>
                    <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-info mt-4" >Buscar</button>
                    </div>
                </div>
            </form>
        </div>
@stop

@section('footer')
@stop

@section('plugins.Datatables', true)
@section('js')
    {{-- <script src="../js/gestion-inventarios.js"></script> --}}
    {{-- @livewireScripts --}}
@stop
