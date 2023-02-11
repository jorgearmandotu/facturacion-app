@extends('adminlte::page')

@section('title', 'Inventario')

@section('css')
    <link rel="stylesheet" href="../../css/main.css">
    @livewireStyles
@stop

@section('content_header')
@stop

@section('content')
    <h1>Crear Producto</h1>

    <div class=" container-fuid col-md-8 containers">
        <form action="/admin/products" method="POST">
            <div>
                <livewire:products.group-select />
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="code">Codigo</label>
                    <input type="text" class="form-control" name="code" required/>
                </div>
                <div class="form-group col-md-6">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" name="name" required />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="costo">Costo</label>
                    <input type="number" class="form-control" name="costo" required id="costo" onchange="change()" />
                </div>
                <div class="form-group col-md-3">
                    <label for="impuesto">Iva</label>
                    <select name="impuesto" class="form-control" id="impuesto" >
                        @foreach($taxes as $tax)
                        <option value="{{$tax->id}}">{{$tax->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="percent">% utilidad</label>
                    <input type="number" class="form-control" name="percent" id="percent" placeholder="%" onchange="change()" />
                </div>
                <div class="form-group col-md-3">
                    <label for="price">Precio</label>
                    <input type="number" class="form-control" name="price" id="price" placeholder="$" required/>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="reference">Referencia</label>
                    <input type="text" name="reference" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label for="codeBar">Cod Barras</label>
                    <input type="text" name="codeBar" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label for="state">Estado</label>
                    <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input" id="customControlAutosizing" name="state"
                            checked>
                        <label class="custom-control-label" for="customControlAutosizing">Activo</label>
                    </div>
                </div>
            </div>
            <div class="form-row justify-content-center">
                <button type="button" class="btn btn-success">Guardar</button>
            </div>
        </form>
    </div>

@stop

@section('footer')
@stop

@section('plugins.Datatables', true)
@section('js')
    <script src="../../js/products-create.js"></script>
    @livewireScripts
@stop
