@extends('adminlte::page')

@section('title', 'Editar precios')

@section('css')
<link rel="stylesheet" href="../../css/main.css">
@livewireStyles
@stop

@section('content_header')
@stop

@section('content')
<h1><strong>Editar precios</strong></h1>
<h2>{{$product->name}}</h2>
<ul>
    <li>
        <span>Ultimo costo: {{number_format($product->costo, 2, ',', '.')}}</span>
    </li>
    <li>
        <span>Costo promedio: {{number_format($product->costo_promedio, 2, ',', '.')}}</span>
    </li>
    <li>
        <span>Costo fijo: {{number_format($product->costo_fijo, 2, ',', '.')}}</span>
    </li>
    @foreach ($product->taxes as $tax)
    <li>
        <p>{{$tax->name}} IVA</p>
    </li>
    @endforeach
</ul>
<x-messages_flash />
<div class="row">
    <div class="col-md-3">Precio</div>
    <div class="col-md-3">% utilidad</div>
    <div class="col-md-3">Valor</div>
</div>
        <form action="../updatePrices/{{$product->id}}" method="post">
        @csrf
        @method('PUT')
        @php
            $list = 0
        @endphp
        @foreach($prices as $price)
        @php
        $list++;
        @endphp
        <input type="hidden" name="product" value="{{$product->id}}">
        <div class="row">
            @if($price->name == 'precio 1')
            <div class="col-md-3"><label class="form-control">{{$price->name}}</label></div>
            {{-- <div class="col-md-3"><input type="text" class="form-control" name="name_precio[]" value="{{$price->name}}"></div> --}}
            @else
            <div class="col-md-3"><input type="text" class="form-control" name="name_precio[]" value="{{$price->name}}"></div>
            @endif
            <div class="col-md-3"><input type="number"  class="form-control utilidad" name="utilidad[]" id="utilidad{{$list}}" value="{{$price->utilidad}}" step='0.01'></div>
            <div class="col-md-3"><input type="number"  class="form-control price" id="price{{$list}}" step="0.01" name="value_price[]" value="{{$price->price}}"></div>
            <input type="hidden" name="price_id[]" value="{{$price->id}}">
        </div>
        @endforeach
        <div id="newRow">

        </div>


<input type="hidden" id="count" value="{{$list}}">
<input type="hidden" id="costo" value="{{$product->costo}}">

<div class="form-group mt-2">
    <button class="btn btn-warning" type="button" onclick="addPriceRow()">Agregar precio</button>
    <button class="btn btn-success" type="submit">Guardar cambios</button>
</form>
</div>
@stop

@section('footer')
@stop

@section('plugins.Datatables', true)
@section('js')
    <script src="../../js/tools.js"></script>
    <script src="../../js/edit_prices.js"></script>
    @livewireScripts
@stop
