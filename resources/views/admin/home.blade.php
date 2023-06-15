@extends('adminlte::page')

@section('title', 'home')

@section('content_header')
    <h1>Estadisticas</h1>

    <div>
        <canvas id="myChart"></canvas>
      </div>

@stop
@section('plugins.Chartjs', true)
@section('js')
<script>

  </script>
    <script src="../../js/home.js"></script>
    {{-- <script src="../../js/tools.js"></script>
    @livewireScripts --}}
@stop
