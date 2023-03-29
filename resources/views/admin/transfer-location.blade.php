@extends('adminlte::page')

@section('title', 'Translados')

@section('css')
    <link rel="stylesheet" href="../../css/main.css">
    {{-- @livewireStyles --}}
 @stop

@section('content_header')
@stop

@section('content')
    <h1>Translados de Bodega</h1>
<ul>
    @foreach($locations as $location)
    <li>{{$location->product->name}} - {{$location->location->name}} - {{$location->stock}}</li>
    @endforeach
</ul>
@stop

@section('footer')
@stop

@section('plugins.Datatables', true)
@section('js')
    <script src="../../js/suppliers.js"></script>
    @livewireScripts
@stop
