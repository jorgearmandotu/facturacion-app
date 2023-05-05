@extends('adminlte::page')

@section('title', 'Traslado de bodega')

@section('css')
    <link rel="stylesheet" href="../../css/main.css">
    {{-- @livewireStyles --}}
@stop

@section('content_header')
@stop

@section('content')

<div class="container col-md-10">
    <div class="d-print-none">
        <h1>Detalle de traslado</h1>
    </div>
    <div class="row justify-content-center container-fluid col-md-12">
        <div class="col col-md-12 text-center">
            <h3 class="p-0 m-0">{{ $company->name_view }}</h3>
            <span>{{ $company->razon_social }}<br>
                Nit. {{ $company->dni }}<br>
                {{ $company->address }}<br>
                {{ $company->phone }}</span>
            {{-- <p class="p-0 m-0">{{ $company->razon_social }}</p>
            <p class="p-0 m-0">Nit. {{ $company->dni }}</p>
            <p class="p-0 m-0">{{ $company->address }}</p>
            <p class="p-0 m-0">{{ $company->phone }} </p> --}}
        </div>
    </div>
    <hr>
    <div class="row container-fluid col-md-12">
        <div class="col">
            <strong>No. {{$transfer[0]->number}}</strong>
        </div>
        <div class="col">
            <p> Traslado de bodega</p>
        </div>
        <div class="col text-center">
            <p>Fecha: {{ str_replace('-','/', $transfer[0]->created_at) }}</p>
        </div>
    </div>
    <div class="row col-md-12">
        <table width=100%>
            <tr>
                <td>Usuario:</td>
                <td>{{ $seller->name }}</td>
            </tr>
        </table>
    </div>
    <hr>
    <div class="row">
        <table width=100%>
            <thead class="border-bottom">
                <tr>
                    <td style="width: 10%" class="text-center">CÓDIGO</td>
                    <td style="width: 40%" class="text-center">PRODUCTO</td>
                    <td style="width: 10%" class="text-center">CANT.</td>
                    <td style="width: 15%" class="text-center">SALE</td>
                    <td style="width: 10%" class="text-center">INGRESA</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($transfer as $transferLocation)
                <tr>
                    <td class="text-center">{{ $transferLocation->product->code }}</td>
                    <td class="text-center">{{ $transferLocation->product->name }}</td>
                    <td class="text-center">{{ $transferLocation->quantity }}</td>
                    <td class="text-center">{{ $transferLocation->fromLocations->name }}</td>
                    <td class="text-center">{{ $transferLocation->toLocations->name }}</td>

                    {{-- <td class="text-right">Sale</td>
                </tr>
                <tr>
                    <td class="text-center">{{ $transferLocation->product->code }}</td>
                    <td class="text-center">{{ $transferLocation->product->name }}</td>
                    <td class="text-center">{{ $transferLocation->quantity }}</td>
                    <td class="text-center">{{ $transferLocation->toLocations->name }}</td>
                    <td class="text-right">Entra</td> --}}
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <hr>
    <div class="justify-content-center col-md-12 text-center">
        <button type="button" class="btn btn-primary d-print-none mt-2" onclick="window.print()"><i class="fas fa-print"></i> Imprimir</button>
    </div>
</div>
@stop

@section('footer')
@stop

{{-- @section('plugins.Datatables', true) --}}
@section('js')
    {{-- <script src="../../js/tools.js"></script>
    <script src="../../js/invoice.js"></script> --}}
    {{-- <script src="../../js/clients.js"></script> --}}
    {{-- @livewireScripts --}}
@stop
