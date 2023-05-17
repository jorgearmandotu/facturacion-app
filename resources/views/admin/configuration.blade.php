@extends('adminlte::page')

@section('title', 'Configuración')

@section('css')
    <link rel="stylesheet" href="../../css/main.css">
    @livewireStyles
@stop

@section('content_header')
@stop

@section('content')
<h1>Configuraciones</h1>

<h3>Metodos de pago autorizados</h3>
        <form action="paymentMethodsStore" method="post">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="value">Metodo de pago</label>
                    <input type="text" class="form-control" name="value" value="" required />
                </div>
                <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-success mt-4">Agregar</button>
                </div>
            </div>
        </form>
        <div class="col-md-8">
            <table id="methodsTable" class="table table-striped table-bordered bg-light" >
                <thead>
                    <tr>
                        <th>Metodos de pago</th>
                        <th>Estado</th>
                        {{-- <th>Opciones</th> --}}
                    </tr>
                </thead>
                    {{-- <tbody> --}}
                        {{-- @foreach ($methods_payment as $method)
                        <tr>
                            <td>{{ $method->value }}</td>
                            <td>{{ $method->state->value }}</td>
                        </tr>
                        @endforeach --}}
                    {{-- </tbody> --}}
            </table>
        </div>
        <hr>
@stop

@section('footer')
@stop

@section('plugins.Datatables', true)
@section('js')
    <script src="../../js/tools.js"></script>
    <script src="../../js/configuration.js"></script>
    {{-- @livewireScripts --}}
@stop
