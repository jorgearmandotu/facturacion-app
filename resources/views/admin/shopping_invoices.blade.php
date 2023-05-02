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
        <div class="col-md-10">
            <form id="formSupplier" >
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="costo">Fecha factura</label>
                        <input type="date" class="form-control" name="date" id="inputDate" />
                    </div>
                    {{-- <div class="col-md-4"></div> --}}
                    <div class="form-group col-md-4">
                        <label for="impuesto">Número</label>
                        <input type="number" class="form-control" name="numberInvoice" id="inputNumber" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="proveedor">Proveedor</label>
                        <select name="supplier_id" id="selectSupplier" class="form-control col-md-12">
                            {{-- <option value="-1">Seleccione Proveedor</option> --}}
                            <option value=""></option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->dni }} - {{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="col-md-4"></div> --}}
                    <div class="form-group col-md-4">
                        <label for="location">Ubicación</label>
                        <select name="location" id="location" class="form-control">
                            @foreach($locations as $location)
                            <option value="{{$location->id}}">{{$location->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="typeInvoice">Tipo de factura</label>
                        <select name="typeInvoice" class="form-control" id="selectTypeInvoice">
                            <option value="CONTADO">Contado</option>
                            <option value="CREDITO">Crédito</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="paymentMethod">Forma de pago</label>
                        <select name="paymentMethod" id="" class="form-control">
                        @foreach($paymentMethods as $method)
                            <option value="{{$method->value}}">{{$method->value}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <button class="d-none" id="submit" type="submit">Generar</button>
            </form>

            <div class="form-row pb-4 align-items-start">
                <div class="container bg-white">
                    <label for="">Agregar Productos</label>
                    <form id="formProducts">
                    <livewire:shopping-invoice.search-products/>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="vlr-Unitario">Costo Unitario</label>
                            <input type="number" class="form-control" id="inputVlrUnitario" placeholder="$ 0"
                                onchange="changeVlrUnit()">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="tax">IVA</label>
                            <select name="tax" class="form-control" id="selectTax" >
                                @foreach($taxes as $tax)
                                    @if(old('tax'))
                                        @if(old('tax') == $tax->id)
                                            <option value="{{$tax->value}}" selected>{{$tax->name}}</option>
                                        @else
                                            <option value="{{$tax->value}}">{{$tax->name}}</option>
                                        @endif
                                    @else
                                        <option value="{{$tax->value}}">{{$tax->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="vlr-Total">Costo Total</label>
                            <span class="form-control" id="inputVlrTotal"></span>
                            {{-- <input type="number" class="form-control" id="inputVlrTotal" placeholder="$ 0" tabindex="-1" disabled> --}}
                        </div>
                    </div>
                    <div class="form-row justify-content-center pb-4 mb-4">
                        <button class="btn btn-info" type="button" onclick="add()">Agregar</button>
                    </div>
                    </form>
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
                    <div class="col-md-1 border border-dark">
                        <label for="">Cant</label>
                    </div>
                    <div class="col-md-2 border border-dark">
                        <label for="">Costo.Unit</label>
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
                        <label for="">Total Iva:</label>
                    </div>
                    <div class="col-md-2 border border-dark p-0">
                        <input type="text" class="form-control col-md-12 text-right" id="inputIvaTotal" disabled>
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <div class="form-row justify-content-end">
                    <div class="col-md-2 border border-dark p-0">
                        <label for="">Total:</label>
                    </div>
                    <div class="col-md-2 border border-dark p-0">
                        <input type="text" class="form-control col-md-12 text-right" id="inputValueTotal" disabled>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
            <div class="form-row justify-content-center m-3">
                <button class="btn btn-success" onclick="send()">Guardar Compra</button>
            </div>
        </div>
    </div>
@stop
@section('footer')

@stop

@section('plugins.Select2', true)
@section('js')
    <script src="../../js/shopping-invoices.js"></script>
    <script src="../../js/tools.js"></script>

    @livewireScripts
@stop
