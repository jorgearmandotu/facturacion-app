@extends('adminlte::page')

@section('title', 'Compras')

@section('css')
    <link rel="stylesheet" href="../../css/main.css">
    @livewireStyles
@stop

@section('content_header')
@stop
@section('content')
    <div class="container-fluid containers">
        <h1>Compras</h1>
        <form >
            <div class="col-md-8">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="costo">Fecha factura</label>
                        <input type="date" class="form-control" name="date" id="inputDate"/>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="form-group col-md-4">
                        <label for="impuesto">Número</label>
                        <input type="number" class="form-control" name="numberInvoice" id="inputNumber" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="proveedor">Proveedor</label>
                        <select name="supplier" id="selectSupplier" class="form-control" >
                            <option value="-1">Seleccione Proveedor</option>
                            @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{$supplier->dni}} - {{$supplier->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="container bg-white">
                    <label for="">Agregar Productos</label>
                    <div class="form-row">
                        <div class="form-group col-md-7">
                            <label for="proveedor">Producto</label>
                            <select name="product" id="selectProducts" class="js-example-theme-single form-control" >
                                <option value="-1">Seleccione Producto</option>
                                @foreach($products as $product)
                                <option value="{{ $product->id }}">{{$product->code}} - {{$product->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="form-group col-md-2">
                            <label for="quantity">Cantidad</label>
                            <input type="number" class="form-control" id="inputQuanity" >
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="vlr-Unitario" >Vlr. Unitario</label>
                            <input type="number" class="form-control" id="inputVlrUnitario" placeholder="$ 0">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="vlr-Total" >Vlr. Total</label>
                            <input type="number" class="form-control" id="inputVlrTotal" placeholder="$ 0">
                        </div>
                    </div>
                    <div class="form-row justify-content-center pb-4 mb-4">
                        <button class="btn btn-success">Agregar</button>
                    </div>
                </div>

                <div class="border border-primary p-1 pl-2">
                    <div class="form-row">
                        <div class="col-md-1 border border-dark">
                            <label for="">No.</label>
                        </div>
                        <div class="col-md-4 border border-dark">
                            <label for="">Producto</label>
                        </div>
                        <div class="col-md-2 border border-dark">
                            <label for="">Cant</label>
                        </div>
                        <div class="col-md-2 border border-dark">
                            <label for="">Vlr.Unit</label>
                        </div>
                        <div class="col-md-2 border border-dark">
                            <label for="">Total</label>
                        </div>
                    </div>
                    <div id="rowForm">
                        {{-- <div class="form-row">
                            <div class="col-md-1 border border-dark p-0">
                                <input type="text" value="10"  class="form-control col-md-12">
                            </div>
                            <div class="col-md-4 border border-dark p-0">
                                <input type="text" value="pruduct"  class="form-control col-md-12">
                            </div>
                            <div class="col-md-1 border border-dark p-0">
                                <input type="text" value="20"  class="form-control col-md-12">
                            </div>
                            <div class="col-md-2 border border-dark p-0">
                                <input type="text" value="0"  class="form-control col-md-12">
                            </div>
                            <div class="col-md-2 border border-dark p-0">
                                <input type="text" value="20000"  class="form-control col-md-12">
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop
@section('footer')
@stop

@section('plugins.Select2', true)
@section('js')
    <script src="../../js/shopping-invoices.js"></script>

    {{-- @livewireScripts --}}
@stop
