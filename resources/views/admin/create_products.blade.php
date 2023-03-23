@extends('adminlte::page')

@section('title', 'Creacion de productos')

@section('css')
    <link rel="stylesheet" href="../../css/main.css">
    @livewireStyles
@stop

@section('content_header')
@stop

@section('content')
    <h1>Crear Producto</h1>

    <x-messages_flash />

    <div class=" container-fuid col-md-8 containers">

        <form method="POST" action="{{route('products')}}" id="formSubmit" >
            @csrf
            <div>
                <livewire:products.group-select />
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="code">Codigo</label>
                    <input type="number" class="form-control" name="code" value="{{ old('code') }}" />
                </div>
                <div class="form-group col-md-6">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="costo">Costo</label>
                    <input type="number" class="form-control" name="costo"  id="inputCosto" onchange="changeCosto()" min="0" value="{{ old('costo') }}"/>
                </div>
                <div class="form-group col-md-3">
                    <label for="impuesto">Iva</label>
                    <select name="tax" class="form-control" id="impuesto" >
                        @foreach($taxes as $tax)
                            @if(old('tax'))
                                @if(old('tax') == $tax->id)
                                    <option value="{{$tax->id}}" selected>{{$tax->name}}</option>
                                @else
                                    <option value="{{$tax->id}}">{{$tax->name}}</option>
                                @endif
                            @else
                                <option value="{{$tax->id}}">{{$tax->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="profit">% utilidad</label>
                    <input type="number" step="0.01" class="form-control" name="profit" id="inputProfit" placeholder="%" onchange="changePercent()" value="{{ old('profit') }}" />
                </div>
                <div class="form-group col-md-3">
                    <label for="price">Precio 1</label>
                    <input type="number" class="form-control" name="price" id="inputPrice" placeholder="$" onchange="changePrice()" min="0" value="{{ old('price') }}" />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="reference">Referencia</label>
                    <input type="text" name="reference" class="form-control" value="{{ old('reference') }}">
                </div>
                <div class="form-group col-md-3">
                    <label for="bar_code">Cod Barras</label>
                    <input type="text" name="bar_code" class="form-control" value="{{ old('bar_code') }}">
                </div>
                <div class="form-group col-md-3">
                    <label for="location">Ubicación</label>
                    <select name="location" id="" class="form-control">
                        @foreach($locations as $location)
                            @if(old('location'))
                                @if(old('location') == $location->id)
                                    <option value="{{$location->id}}" selected>{{$location->name}}</option>
                                @else
                                    <option value="{{$location->id}}" >{{$location->name}}</option>
                                @endif
                            @else
                                <option value="{{$location->id}}" >{{$location->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="stock">Saldo Inical</label>
                    <input type="number" name="stock" class="form-control" min="0"  value="0">
                </div>
                <div class="form-group col-md-1">
                    <label for="state">Estado</label>
                    <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input" id="customControlAutosizing" name="state"
                            checked>
                        <label class="custom-control-label" for="customControlAutosizing">Activo</label>
                    </div>
                </div>
            </div>
            <div class="form-row justify-content-center">
                <button class="d-none" id="submit" type="submit">Generar</button>
                <button class="btn btn-success" id="btnSubmit">Guardar</button>
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
