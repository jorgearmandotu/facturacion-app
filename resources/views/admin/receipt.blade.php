@extends('adminlte::page')

@section('title', 'Receipt')

@section('css')
<link rel="stylesheet" href="../../css/main.css">
@livewireStyles
@stop

@section('content_header')
@stop

@section('content')
<h1>Recibo de caja</h1>
<div class="container border p-2">
    <form>
        <livewire:receipt.select-invoice />
        <div class="form-row">
            {{-- <div class="form-group col-md-3">
                <label>Tipo de recibo:</label>
                <select name="type" id="" class="form-control">
                    <option value="Ingreso">Ingreso</option>
                    <option value="Egreso">Egreso</option>
                </select>
            </div> --}}
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="vlr_pay">Valor a pagar</label>
                <input type="number" class="form-control" name="vlr_pay">
            </div>
            <div class="form-group col-md-3">
                <label for="paymentMethod">Metodo de pago</label>
                <select name="paymentMethod" id="" class="form-control">
                    <option value="EFECTIVO">Efectivo</option>
                    <option value="TARJETA">Tarjeta</option>
                    <option value="TRANSFERENCIA">Transferencia</option>
                </select>
            </div>
        </div>
        <div class="form-row justify-content-center">
            <button class="btn btn-success" type="button">Generar</button>
        </div>
    </form>
</div>
@stop

@section('footer')
@stop

@section('plugins.Datatables', true)
@section('js')
    <script src="../../js/tools.js"></script>
    {{-- <script src="../../js/products.js"></script> --}}
    @livewireScripts
@stop
