@extends('adminlte::page')

@section('title', 'Inventario')

@section('css')
    <link rel="stylesheet" href="../../css/main.css">
    @livewireStyles
@stop

@section('content_header')
@stop

@section('content')
    <h1>Creacion de factura</h1>

    <x-messages_flash />

    <div class=" container-fuid col-md-10 containers">
        <form method="POST" action="{{ route('invoices') }}" id='formClient'>
            @csrf

            <livewire:invoice.search-clients />
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="type">Tipo de factura</label>
                    <select name="typeInvoice" class="form-control" id="selectTypeInvoice">
                        <option value="CONTADO">Contado</option>
                        <option value="CREDITO">Crédito</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="discount">Descuento $</label>
                    <input type="number" name="discount" class="form-control" min="0" value="0">
                </div>
                <div class="form-group col-md-3">
                    <label for="payment">Cuota inicial $</label>
                    <input type="number" name="payment" class="form-control" min="0" value="0" id="payment" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label for="paymentMethod">Forma de pago</label>
                    <select name="paymentMethod" id="" class="form-control">
                        <option value="EFECTIVO">Efectivo</option>
                        <option value="TARJETA">Tarjeta</option>
                        <option value="TRANSFERENCIA">Transferencia</option>
                    </select>
                </div>
            </div>
        </form>
        <form method="POST" id="formProduct">
            <div class="container-fluid bg-white">
                <label for="">Agregar productos</label>
                <form id="formProducts">
                    <livewire:invoice.select-product />

                    <div class="form-row justify-content-center pb-4 mb-4">
                        <button class="btn btn-info" type="button" onclick="add()">Agregar</button>
                    </div>
                </form>
            </div>
        </form>

        <div class=" p-1 pl-2">
            {{-- border border-primary --}}
            <div class="form-row">
                <div class="col-md-1 border border-dark">
                    <label for="">No.</label>
                </div>
                <div class="col-md-4 border border-dark">
                    <label for="">Producto</label>
                </div>
                <div class="col-md-1 border border-dark">
                    <label for="">Cant</label>
                </div>
                <div class="col-md-2 border border-dark">
                    <label for="">Vlr.Unit</label>
                </div>
                <div class="col-md-1 border border-dark">
                    <label for="">IVA</label>
                </div>
                <div class="col-md-2 border border-dark">
                    <label for="">Total</label>
                </div>
            </div>
            <div id="rowForm">
            </div>
            <div class="form-row justify-content-end">
                <div class="col-md-2 border border-dark p-0">
                    <label for="">Total:</label>
                </div>
                <div class="col-md-2 border border-dark p-0">
                    <input type="text" class="form-control col-md-12" id="inputValueTotal" disabled>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
        <div class="form-row justify-content-center m-3">
            <button class="btn btn-success" onclick="send()">Generar factura</button>
        </div>
    </div>
@stop

@section('footer')
@stop


@section('plugins.Datatables', true)
@section('js')
    <script src="../../js/tools.js"></script>
    <script src="../../js/invoice.js"></script>
    {{-- <script src="../../js/clients.js"></script> --}}
    @livewireScripts
@stop
