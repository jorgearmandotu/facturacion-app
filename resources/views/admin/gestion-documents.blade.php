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
        <div class="container-fluid ">
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

            <hr>

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

            <hr>

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
            @if(session('remision'))
            <div class="row">
                <p><a href="printRemision/{{ session('remision')->id }}" target="_blank" class="btn btn-warning mr-2">Ver remision</a></p>
                @if(session('remision')->state->value != 'Anulado')
                <form action="anularRemision" method="post">
                    @csrf
                    <input type="hidden" name="remision" value="{{ session('remision')->id }}">
                    <button type="submit" class="btn btn-danger">Anular</button>
                </form>
                @else
                    <strong>Recibo se encuentra anulado</strong>
                @endif
            </div>
            @endif

            <hr>

            <div class="row">
                <label for="">Facturas de compra</label>
            </div>
            <form action="invoicesShopping-share" method="post">
                @csrf
                <div class="form-row form">
                    <div class="form-group col-md-3">
                        <label for="number">Número</label>
                        <input type="number" class="form-control" name="numberShoppingInvoice" value="{{old('numberShoppingInvoice')}}" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="number">proveedor</label>
                        <select name="supplierInvoice" id="selectSupplier" class="form-control selectHeigth" style="width:100%" required>
                            {{-- <option value="-1">Seleccione proveedor</option> --}}
                            <option value=""></option>
                            @foreach($suppliers as $supplier)
                                @if($supplier->id == old('supplierInvoice'))
                                    <option value="{{$supplier->id}}" selected >{{$supplier->name}} - {{$supplier->dni}}</option>
                                @else
                                    <option value="{{$supplier->id}}" >{{$supplier->name}} - {{$supplier->dni}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-info mt-4" >Buscar</button>
                    </div>
                </div>
            </form>
            @if(session('invoiceShopping'))
            <div class="row">
                <p><a href="printShoppingInvoice/{{ session('invoiceShopping')->id }}" target="_blank" class="btn btn-warning mr-2">Ver factura</a></p>
                <form action="anularShoppingInvoice" method="post">
                    @csrf
                    <input type="hidden" name="invoice" value="{{ session('invoiceShopping')->id }}">
                    @if(session('invoiceShopping')->state->value != 'Anulado')
                        <button type="submit" class="btn btn-danger">Anular</button>
                    @else
                        <strong>Factura se encuentra anulada</strong>
                    @endif
                </form>
            </div>
            @endif

            <hr>

            <div class="row">
                <label for="">Egresos</label>
            </div>
            <form action="discharge-share" method="post">
                @csrf
                <div class="form-row form">
                    <div class="form-group col-md-3">
                        <label for="number">Número</label>
                        <input type="number" class="form-control" name="numberDischarge" value="{{old('numberDischarge')}}" required>
                    </div>
                    <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-info mt-4" >Buscar</button>
                    </div>
                </div>
            </form>
            @if(session('discharge'))
            <div class="row">
                <p><a href="printDischarge/{{ session('discharge')->id }}" target="_blank" class="btn btn-warning mr-2">Ver egreso</a></p>
                <form action="anularDischarge" method="post">
                    @csrf
                    <input type="hidden" name="discharge" value="{{ session('discharge')->id }}">
                    @if(session('discharge')->state->value != 'Anulado')
                        <button type="submit" class="btn btn-danger">Anular</button>
                    @else
                        <strong>Factura se encuentra anulada</strong>
                    @endif
                </form>
            </div>
            @endif
        </div>
        @section('plugins.Select2', true)
@stop

@section('footer')
@stop

@section('plugins.Datatables', true)
@section('js')
    <script src="../js/gestion-documents.js"></script>
    {{-- @livewireScripts --}}
@stop
