@extends('adminlte::page')

@section('title', 'Empresa')

@section('css')
    <link rel="stylesheet" href="../../css/main.css">
    @livewireStyles
@stop

@section('content_header')
@stop

@section('content')
    <h1>Datos de empresa</h1>
    <div class="container">
        <h3>Datos de empresa</h3>
        <hr>
        @forelse ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                <li>{{ $error }}</li>
            </div>
        @empty
        @endforelse
        @if(session('fatal'))
        <div class="alert alert-danger" role="alert">
            <li>{{ session('fatal') }}</li>
        </div>
        @endif
        @if(session('success'))
        <div class="alert alert-success" role="alert">
            <li>{{ session('success') }}</li>
        </div>
        @endif
        <form action="{{ route('config-company.store') }}" method="post">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="razon-social">Razon social</label>
                    <span class="form-control">{{ $company->razon_social }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label for="nit">Nit</label>
                    <span class="form-control">{{ $company->dni }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label for="nameComercial">Nombre comercial</label>
                    <input type="text" class="form-control" name="nameComercial" value="{{ $company->name_view }}"
                        required>
                </div>
                <div class="form-group col-md-3">
                    <label for="address">Dirección</label>
                    <input type="text" name="address" class="form-control" value="{{ $company->address }}" >
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="phone">teléfono</label>
                    <input type="text" class="form-control" name="phone" value="{{ $company->phone }}" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="phone">Correo electrónico</label>
                    <input type="email" class="form-control" name="email" value="{{ $company->email }}" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="regimen">Responsabilidad fiscal</label>
                    <input type="text" class="form-control" name="regimen" value="{{ $company->regimen }}" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="activity">Actividad economica</label>
                    <input type="text" class="form-control" name="activity" value="{{ $company->actividad_economica }}"
                        required>
                </div>
            </div>
            <div class="form-row justify-content-center">
                <button class="btn btn-success" type="submit">Actualizar</button>
            </div>
        </form>
        <hr>

        <h3>Resolucion de factura</h3>
        <label for="">Resolución actual</label><br>
        <div class="row">
            <div class="col col-md-3">
                <strong>Numero: </strong><span>{{ $resolution->number }} </span>
            </div>
            <div class="col col-md-3">
                <strong> Fecha: </strong><span>{{ $resolution->date_resolution }} </span>
            </div>
            <div class="col col-md-3">
                <strong> Fecha de vencimiento: </strong><span>{{ $resolution->expiration_date }}</span><br>
            </div>
            <div class="row"></div>
            <div class="col col-md-3">
                <strong>Vigencia: </strong><span>{{ $resolution->validity }} </span>
            </div>
            <div class="col col-md-3">
                <strong> Prefijo: </strong><span>{{ $resolution->prefijo }} </span>
            </div>
            <div class="col col-md-3">
                <strong> Número incial: </strong><span>{{ $resolution->initial_number }}</span>
            </div>
            <div class="col col-md-3">
                <strong> Número final: </strong><span>{{ $resolution->final_number }}</span>
            </div>
        </div>
        <hr>

        <form action="resolutionStore" method="post">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="resolution">Número de resolucion</label>
                    <input type="text" class="form-control" name="resolution" value=""  />
                </div>
                <div class="form-group col-md-3">
                    <label for="date">Fecha</label>
                    <input type="date" class="form-control" name="date" value="" >
                </div>
                <div class="form-group col-md-3">
                    <label for="expiration">Fecha de vencimiento</label>
                    <input type="date" name="expiration" class="form-control" value="" >
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="validity">Vigencia</label>
                    <input type="text" class="form-control" name="validity" value="" >
                </div>
                <div class="form-group col-md-3">
                    <label for="prefijo">Prefijo</label>
                    <input type="text" class="form-control" name="prefijo" value="" >
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="initial">Numero inicial</label>
                    <input type="number" class="form-control" name="initial" value="" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="initial">Numero final</label>
                    <input type="number" class="form-control" name="final" value="" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="state">Resolución de factura</label>
                    <div class="">
                        @if($company->usa_resolucion_factura)
                        <input type="checkbox" class="" id="stateResolution" name="stateResolution"
                        checked >
                        @else
                        <input type="checkbox" class="" id="stateResolution" name="stateResolution">
                        @endif
                    <label class="" for="stateResolution" data-toggle="tooltip" data-placement="top" title="Si está seleccionado se usara la configuración de resolución de factura suministrada, de lo contrario solo se tomara la numeración inicial y final para el proceso de generación de facturas.">Activo</label>
                    </div>
                </div>
            </div>
            <div class="form-row justify-content-center">
                <button type="submit" class="btn btn-success">Actualizar</button>
            </div>
        </form>
        <hr>


    </div>
@stop

@section('footer')
@stop

@section('plugins.Datatables', true)
@section('js')
    <script src="../../js/tools.js"></script>
    <script src="../../js/clients.js"></script>
    {{-- @livewireScripts --}}
@stop
