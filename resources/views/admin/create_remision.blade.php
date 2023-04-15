@extends('adminlte::page')

@section('title', 'Remision')

@section('css')
    <link rel="stylesheet" href="../../css/main.css">
    @livewireStyles
@stop

@section('content_header')
@stop

@section('content')
    <h1>Orden de pedido</h1>
    <x-messages_flash />
    <div class=" container-fuid col-md-10 containers">
        <form method="POST" action="{{ route('remision.store') }}" id='formRemision'>
            @csrf
            <livewire:invoice.search-clients />
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="vlr_total">Valor del servicio</label>
                    <input type="number" class="form-control" name="vlr_total">
                </div>
                <div class="form-group col-md-3">
                    <label for="payment">Anticipo</label>
                    <input type="number" class="form-control" name="payment">
                </div>
                <div class="form-group col-md-3">
                    <label for="paymentMethod">Forma de pago</label>
                    <select name="paymentMethod" id="" class="form-control">
                        @foreach($paymentMethods as $method)
                        <option value="{{$method->value}}">{{$method->value}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-9">
                    <label for="description">Descricion de pedido</label>
                    <textarea name="description" id="" cols="20" rows="10" class="form-control" maxlength="400"></textarea>
                    {{-- <textarea type="text" name="description" class="" rows="5"> --}}
                </div>
            </div>
            <div class="form-row justify-content-center m-3">
                <button class="btn btn-success" type="submit" >Generar Remision</button>
            </div>
        </form>
    </div>
@stop

@section('footer')
@stop

@section('plugins.Datatables', true)
@section('js')
    <script src="../../js/tools.js"></script>
    <script src="../../js/products.js"></script>
    @livewireScripts
@stop
