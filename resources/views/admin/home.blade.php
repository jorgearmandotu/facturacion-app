@extends('adminlte::page')

@section('title', 'home')
@section('css')
    <link rel="stylesheet" href="../../css/main.css">
    {{-- @livewireStyles --}}
@stop

@section('content_header')
<h1>Bienvenido {{Auth()->user()->name}}</h1>
@can('estadisticas')
    <h1>Estadisticas</h1>

    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card" >
                <div class="card-body">
                    <h4 class="card-title">
                        <i class="far fa-chart-bar"></i>
                        Recaudo del día {{ $today }}
                    </h4>
                    <div id="" class="col-md-9">
                        <canvas id="dailySalesCash"></canvas>
                        {{-- <div id="orders-chart-legend" class="orders-chart-legend"></div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endcan
@stop
@section('plugins.Chartjs', true)
@section('js')
@can('estadisticas')
    <script src="../../js/home.js"></script>
    {{-- <script src="../../js/tools.js"></script>
    @livewireScripts --}}
@endcan
@stop
