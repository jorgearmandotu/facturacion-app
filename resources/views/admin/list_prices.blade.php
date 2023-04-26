@extends('adminlte::page')

@section('title', 'lisatados')

@section('css')
<link rel="stylesheet" href="../../css/main.css">
@livewireStyles
@stop

@section('content_header')
@stop

@section('content')
<h1>listado de precios</h1>
<div class="container-fluid">
    <div class="container tables">
        <table id="pricesTable" class="table table-striped table-bordered bg-light" style="width:100%">
            <thead>
                <tr>
                    {{-- <th>Tipo De Documento</th> --}}
                    <th>Producto</th>
                    <th>Ultimo costo</th>
                    <th>precios/ %utilidad</th>
                    <th>options</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{$product->name}}</td>
                    <td>{{$product->costo}}</td>
                    <td>
                        @foreach($product->prices as $price)
                        <li><strong>{{$price->name}}: </strong>{{ number_format($price->price, 2, ',', '.').' / '.$price->utilidad.' %' }}</li>
                        @endforeach
                    </td>
                    <td>Editar Precios</td>
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
    <script src="../../js/products.js"></script>
    @livewireScripts
@stop
