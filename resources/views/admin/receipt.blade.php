@extends('adminlte::page')

@section('title', __('titles.receipt') )

@section('css')
<link rel="stylesheet" href="../../css/main.css">
@livewireStyles
@stop

@section('content_header')
@stop

@section('content')
<h1>{{ __('Receipt') }}</h1>
<div class="container-fluid col-md-10 containers border p-2">
    <x-messages_flash />
    <form method="post" action="{{route('receipt.store')}}" id="formSubmit">
        @csrf
        <livewire:receipt.select-invoice />
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="vlr_payment">{{ __('Amount to be Paid') }} $</label><label id="aPagar" class="text-primary">  </label>
                <input type="number" class="form-control" name="vlr_payment" id="inputValor">
            </div>
            <div class="form-group col-md-3">
                <label for="paymentMethod">{{ __('Way to Pay') }}</label>
                <select name="paymentMethod" id="" class="form-control">
                    @foreach($paymentMethods as $method)
                        <option value="{{$method->value}}">{{$method->value}}</option>
                    @endforeach
                </select>
            </div>
            <div class="from-group col-md-9 mb-2">
                <label for="observation">{{ __('Observation') }}</label>
                <input type="text" name="observation" class="form-control">
            </div>
        </div>
        <div class="form-row justify-content-center">
            {{-- <button class="d-none" id="submit" type="submit">Generar</button> --}}
            <button class="btn btn-success" id="btnSubmit" type="submit">{{ __('Generate') }}</button>
        </div>
    </form>
    <div class="form-row justify-content-end">
        <a href="listRemisiones" target="_blank" class="link-secondary" > {{ __('See Referrals') }}</a>
    </div>
    <div class="form-row justify-content-end">
        <a href="pending-invoices" target="_blank" class="link-secondary" >{{ __('View Pending Invoices') }}</a>
    </div>
</div>
@stop

@section('footer')
@stop

@section('plugins.Datatables', true)
@section('js')
    <script src="../../js/tools.js"></script>
    {{-- <script src="../../js/receipts.js"></script> --}}
    @livewireScripts
@stop
