@extends('adminlte::page')

@section('title', 'Notas')

@section('css')
    <link rel="stylesheet" href="../../css/main.css">
    @livewireStyles
@stop

@section('content_header')
@stop

@section('content')
<h1>Notas de inventario</h1>

<div class=" container-fuid col-md-10 containers">
    <form method="POST" id="formProduct">
        <div class="container-fluid bg-white p-2 ">
            <label for="">Agregar productos</label>
            <div class="row col-md-6">
                <label for="typeNote">Tipo de nota</label>
                <select name="typeNote" id="typeNote" class="form-control">
                    @foreach($types as $type)
                    <option value="{{$type->id}}">{{$type->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="row col-md-6">
                <label for="location">Ubicación</label>
                <select name="location" id="locationNote" class="form-control">
                    @foreach($locations as $location)
                    <option value="{{$location->id}}">{{$location->name}}</option>
                    @endforeach
                </select>
            </div>

            <form id="formProducts">
                <div class="form-row col-md-12">
                    <div class="col-md-5">
                        <label for="product">Producto</label>
                        <select name="product" id="selectProducts" class="form-control" style="width: 100%" onfocus="7">
                            <option></option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->code }} - {{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="quantity">Cantidad</label>
                        <input type="number" class="form-control" name="quantity" id="quantity" min="0">
                    </div>
                </div>

                <div class="form-row justify-content-center p-4 mb-4 col-md-8">
                    <button class="btn btn-info" type="button" onclick="add()">Agregar</button>
                </div>
            </form>

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
                    {{-- <div class="col-md-2 border border-dark">
                        <label for="">Costo.Unit</label>
                    </div>
                    <div class="col-md-1 border border-dark">
                        <label for="">IVA</label>
                    </div>
                    <div class="col-md-2 border border-dark">
                        <label for="">Total</label>
                    </div> --}}
                </div>
                <div id="rowForm">

                </div>
                {{-- <div class="form-row justify-content-end">
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
                </div> --}}
            </div>

            <div class="form-row col-md-12">
                <label for="description">Observación</label>
                <textarea name="description" id="" cols="30" rows="5" class="form-control" placeholder="Observación">{{old('description')}}</textarea>
            </div>
        </div>
    </form>
</div>
@stop

@section('footer')
@stop

@section('plugins.Datatables', true)
@section('plugins.Select2', true)
@section('js')
    <script src="../../js/tools.js"></script>
    <script src="../../js/notes.js"></script>
    {{-- @livewireScripts --}}
@stop
