@extends('adminlte::page')

@section('title', __('titles.facturacion'))

@section('css')
    <link rel="stylesheet" href="../../css/main.css">
    @livewireStyles
@stop

@section('content_header')
@stop

@section('content')
    <h1>{{ __('Create Invoice') }}</h1>

    <x-messages_flash />

    <div class=" container-fluid col-md-10 containers">
        <form method="POST" action="{{ route('invoices') }}" id='formClient'>
            @csrf

            <livewire:invoice.search-clients />
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="type">{{ __('Type Invoice') }}</label>
                    <select name="typeInvoice" class="form-control" id="selectTypeInvoice">
                        <option value="CONTADO">{{ __('Cash') }}</option>
                        <option value="CREDITO">{{ __('Credit') }}</option>
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label for="paymentMethod">{{ __('Way to Pay') }}</label>
                    <select name="paymentMethod" id="" class="form-control">
                        @foreach($paymentMethods as $method)
                            <option value="{{$method->value}}">{{$method->value}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="observation">{{ __('Observation') }}</label>
                    <textarea name="observation" id="" cols="30" rows="3" class="form-control"></textarea>
                </div>
            </div>
        </form>
        <form method="POST" id="formProduct">
            <div class="container-fluid bg-white">
                <label for="">{{ __('add products') }}</label>
                <form id="formProducts">
                    <livewire:invoice.select-product />

                    {{-- <div class="form-row justify-content-center pb-4 mb-4">
                        <button class="btn btn-info" type="button" onclick="add()">Agregar</button>
                    </div> --}}
                </form>
            </div>
        </form>

        <div class=" p-1 pl-2">
            {{-- border border-primary --}}
            <div class="form-row">
                <div class="col-md-1 border border-dark text-center">
                    <label for="">{{ __('No.') }}</label>
                </div>
                <div class="col-md-4 border border-dark text-center">
                    <label for="">{{ __('Product') }}</label>
                </div>
                <div class="col-md-1 border border-dark text-center">
                    <label for="">{{ __('Cant') }}</label>
                </div>
                <div class="col-md-2 border border-dark text-center">
                    <label for=""> {{__('Unit Value')}} </label>
                </div>
                <div class="col-md-1 border border-dark text-center">
                    <label for="">IVA</label>
                </div>
                <div class="col-md-2 border border-dark text-center">
                    <label for="">{{ __('Total') }}</label>
                </div>
            </div>
            <div id="rowForm">
            </div>
            <div class="form-row justify-content-end">
                <div class="col-md-2 border border-dark p-0 text-center">
                    <label for="">{{ __('Total') }}</label>
                </div>
                <div class="col-md-2 border border-dark p-0">
                    <input type="text" class="form-control col-md-12" id="inputValueTotal" disabled>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
        <div class="form-row justify-content-center m-3">
            <button class="btn btn-success" onclick="send()">{{ __('Generate invoice') }}</button>
        </div>
    </div>
@stop

@section('footer')
@stop


@section('plugins.Datatables', true)
@section('js')
    <script src="../../js/tools.js"></script>
    <script src="../../js/invoice.js"></script>
    {{-- <script src="../../js/clients.js"></script> --}}
    @livewireScripts
@stop
