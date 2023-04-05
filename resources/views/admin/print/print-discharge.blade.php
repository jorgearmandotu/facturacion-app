@extends('adminlte::page')

@section('title', 'Egreso')

@section('css')
    <link rel="stylesheet" href="../../css/main.css">
    {{-- @livewireStyles --}}
@stop

@section('content_header')
@stop

@section('content')

    <div class="container col-md-10">
        <div class="d-print-none">
            <h1>Detalle de Egreso</h1>
        </div>
        <div class="row justify-content-center container-fluid col-md-12">
            <div class="col col-md-12 text-center">
                <h3 class="p-0 m-0">{{ $company->name_view }}</h3>
                <span>{{ $company->razon_social }}<br>
                    Nit. {{ $company->dni }}<br>
                    {{ $company->address }}<br>
                    {{ $company->phone }}</span>
            </div>
        </div>
        <hr>
        <div class="row container-fluid col-md-12">
            <div class="col justify-start col-md-5">
                <strong>Egreso No. {{ $discharge->id }}</strong>
            </div>
            <div class="col text-center">
                <p>Fecha: {{ str_replace('-', '/', $discharge->date) }}</p>
            </div>
        </div>
        <div class="row container-fluid">
            <div class="col justify-start col-md-5">
                <p>Quien realiza: {{ $discharge->user->name }}</p>
            </div>
            <div class="col col-md-3">
                <p> Valor: {{ number_format($discharge->mount, 2, ',', '.') }}</p>
            </div>
            <div class="col col-md-3">
                <p>  {{ $discharge->category->name }}</p>
            </div>
        </div>
        <div class="row col-md-12 justify-start">
            <hr>
            <table width=100%>
                <thead class="border">
                    <tr>
                        <th class="border" style="width: 8%" class="text-rigth">Concepto</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            @php
                                echo str_replace(["\r\n", "\n\r", "\r", "\n"], '<br>', $discharge->description);
                            @endphp
                        </td>
                </tbody>
                <tfoot></tfoot>
            </table>
        </div>
    </div>
    <hr>
    <div class="justify-content-center col-md-12 text-center">
        <button type="button" class="btn btn-primary d-print-none mt-2" onclick="window.print()"><i class="fas fa-print"></i> Imprimir</button>
    </div>
@stop

@section('footer')
@stop

{{-- @section('plugins.Datatables', true) --}}
@section('js')

@stop
