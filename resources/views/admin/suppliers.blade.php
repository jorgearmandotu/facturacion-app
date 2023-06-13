@extends('adminlte::page')

@section('title', 'Proveedores')

@section('css')
    <link rel="stylesheet" href="../../css/main.css">
    @livewireStyles
@stop

@section('content_header')
@stop

@section('content')
    <h1>Proveedores</h1>

    <div class="container col-md-8 tables">
        <table id="suppliersTable" class="table table-striped table-bordered bg-light" style="width:100%">
            <thead>
                <tr>
                    <th>NIT</th>
                    <th>NOMBRE</th>
                    <th>TELÉFONO</th>
                    <th>DIRECCIÓN</th>
                    <th>CORREO ELÉCTRONICO</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@stop

@section('footer')
@stop

@section('plugins.Datatables', true)
@section('js')
    <script src="../../js/suppliers.js"></script>
    {{-- @livewireScripts --}}
@stop
