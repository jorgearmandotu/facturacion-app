@extends('adminlte::page')

@section('title', 'Remision')

@section('css')
    <link rel="stylesheet" href="../../css/main.css">
    {{-- @livewireStyles --}}
@stop

@section('content_header')
@stop

@section('content')
    <h1>Exportaciones</h1>

    <div class="conatiner">

        <x-messages_flash />
        <label for="">Exportar facturas de venta</label>
        {{-- <ul>
            <li><a href="exportInvoices">Exportar facturas</a></li>
        </ul> --}}
        <form action="exportInvoices" method="post">
            @csrf
            <div class="form-row form">
                <div class="form-group col-md-3">
                    <label for="dateInitial">Fecha inical</label>
                    <input type="date" class="form-control" name="dateInitial">
                </div>
                <div class="form-group col-md-3">
                    <label for="dateFinal">Fecha Final</label>
                    <input type="date" class="form-control" name="dateFinal">
                </div>
                <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-info mt-4" >Generar</button>
                </div>
            </div>
        </form>
        <hr>
        <label for="">Exportar recibos de caja</label>
        <form action="exportReceipts" method="post">
            @csrf
            <div class="form-row form">
                <div class="form-group col-md-3">
                    <label for="dateInitial">Fecha inical</label>
                    <input type="date" class="form-control" name="dateInitial">
                </div>
                <div class="form-group col-md-3">
                    <label for="dateFinal">Fecha Final</label>
                    <input type="date" class="form-control" name="dateFinal">
                </div>
                <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-info mt-4" >Generar</button>
                </div>
            </div>
        </form>
        <hr>
        <label for="">Exportar facturas de compra</label>
        <form action="exportShoppingInvoices" method="post">
            @csrf
            <div class="form-row form">
                <div class="form-group col-md-3">
                    <label for="dateInitial">Fecha inical</label>
                    <input type="date" class="form-control" name="dateInitial">
                </div>
                <div class="form-group col-md-3">
                    <label for="dateFinal">Fecha Final</label>
                    <input type="date" class="form-control" name="dateFinal">
                </div>
                <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-info mt-4" >Generar</button>
                </div>
            </div>
        </form>
        <hr>
        <label for="">Exportar ingresos por fecha</label>
        <form action="exportIngresos" method="post">
            @csrf
            <div class="form-row form">
                <div class="form-group col-md-3">
                    <label for="dateInitial">Fecha inical</label>
                    <input type="date" class="form-control" name="dateInitial">
                </div>
                <div class="form-group col-md-3">
                    <label for="dateFinal">Fecha Final</label>
                    <input type="date" class="form-control" name="dateFinal">
                </div>
                <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-info mt-4" >Generar</button>
                </div>
            </div>
        </form>
        <hr>
        <label for="">Exportar egresos por fecha</label>
        <form action="exportEgresos" method="post">
            @csrf
            <div class="form-row form">
                <div class="form-group col-md-3">
                    <label for="dateInitial">Fecha inical</label>
                    <input type="date" class="form-control" name="dateInitial">
                </div>
                <div class="form-group col-md-3">
                    <label for="dateFinal">Fecha Final</label>
                    <input type="date" class="form-control" name="dateFinal">
                </div>
                <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-info mt-4" >Generar</button>
                </div>
            </div>
        </form>
        <hr>
        <label for="">Exportar ingresos y egresos por fecha</label>
        <form action="exportIngresosDischarge" method="post">
            @csrf
            <div class="form-row form">
                <div class="form-group col-md-3">
                    <label for="dateInitial">Fecha inical</label>
                    <input type="date" class="form-control" name="dateInitial">
                </div>
                <div class="form-group col-md-3">
                    <label for="dateFinal">Fecha Final</label>
                    <input type="date" class="form-control" name="dateFinal">
                </div>
                <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-info mt-4" >Generar</button>
                </div>
            </div>
        </form>
        <hr>
        <label for="">Exportar movimientos por producto</label>
        <form action="exportMovimientoProducto" method="post">
            @csrf
            <div class="form-row form">
                <div class="form-group col-md-3">
                    <label for="dateInitial">Fecha inical</label>
                    <input type="date" class="form-control" name="dateInitial">
                </div>
                {{-- <div class="form-group col-md-3">
                    <label for="dateDinal">Fecha final</label>
                    <input type="date" class="form-control" name="dateFinal">
                </div> --}}
                <div class="form-group col-md-3">
                    <label for="product">Producto</label>
                    <select name="product" id="selectProducts" class="form-control selectProducts style="width: 100%" >
                        <option value="-1">Seleccione Producto</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->code }} - {{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-info mt-4" >Generar</button>
                </div>
            </div>
        </form>
        <hr>
        <label for="">Exportar ventas por producto</label>
        <form action="exportVentaProducto" method="post">
            @csrf
            <div class="form-row form">
                <div class="form-group col-md-3">
                    <label for="dateInitial">Fecha inical</label>
                    <input type="date" class="form-control" name="dateInitial" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="dateFinal">Fecha final</label>
                    <input type="date" class="form-control" name="dateFinal">
                </div>
                <div class="form-group col-md-3">
                    <label for="product">Producto</label>
                    <select name="product" id="selectProductsVenta" class="form-control selectProducts" style="width: 100%" >
                        <option value="-1">Seleccione Producto</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->code }} - {{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-info mt-4" >Generar</button>
                </div>
            </div>
        </form>
        <hr>
    </div>

@stop

@section('footer')
@stop
@section('plugins.Select2', true)
@section('plugins.Datatables', true)
@section('js')
    <script src="../../js/tools.js"></script>
    <script src="../../js/exports.js"></script>
    {{-- @livewireScripts --}}
@stop
