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
    <form method="POST" id="formNote">
        @csrf
        <div class="container-fluid bg-white p-2 ">
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
        </div>
    </form>
        <div class="container-fluid bg-white p-2 ">
            <form id="formProducts" action="" method="POST">
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

            <div class="p-1 pl-2 ">
                <div class="form-row">
                    <div class="col-sm-1 border border-dark">
                        <label for="">No.</label>
                    </div>
                    <div class="col-sm-5 border border-dark">
                        <label for="">Producto</label>
                    </div>
                    <div class="col-sm-1 border border-dark">
                        <label for="">Cant</label>
                    </div>
                </div>
                <div id="rowForm">

                </div>

            </div>

            <div class="form-row col-md-12">
                <label for="description">Observación</label>
                <textarea name="description" id="descriptionNote" cols="30" rows="5" class="form-control" placeholder="Observación" maxlength="230">{{old('description')}}</textarea>
            </div>
            <div class="form-row p-2 justify-content-center col-md-8">
                <button type="button" class="btn btn-success" onclick="send()">Generar</button>
            </div>
        </div>
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
