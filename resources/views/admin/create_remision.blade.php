@extends('adminlte::page')

@section('title', __('titles.remisiones'))

@section('css')
    <link rel="stylesheet" href="../../css/main.css">
    @livewireStyles
@stop

@section('content_header')
@stop

@section('content')
    <h1>{{ __('Purchase Order') }}</h1>
    <x-messages_flash />
    <div class=" container-fluid col-md-10 containers">
        <form method="POST" action="{{ route('remision.store') }}" id='formRemision'>
            @csrf
            <livewire:invoice.search-clients />
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="vlr_total">{{ __('Service Value') }} $ </label><label id="aPagar" class="text-primary"> </label>
                    <input type="number" class="form-control" name="vlr_total" id="inputValor">
                </div>
                <div class="form-group col-md-3">
                    <label for="payment">{{ __('Advance') }} $</label><label id="anticipo" class="text-primary"> </label>
                    <input type="number" class="form-control" name="payment" id="inputAnticipo">
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
                <div class="form-group col-md-9">
                    <label for="description">{{ __('Order Description') }}</label>
                    <textarea name="description" id="" cols="20" rows="10" class="form-control" maxlength="400"></textarea>
                    {{-- <textarea type="text" name="description" class="" rows="5"> --}}
                </div>
            </div>
            <div class="form-row justify-content-center m-3">
                <button class="btn btn-success" type="submit" >{{ __('Generate') }}</button>
            </div>
        </form>
    </div>
@stop

@section('footer')
@stop

@section('plugins.Datatables', true)
@section('js')
    <script src="../../js/tools.js"></script>
    <script src="../../js/products.js"></script>
    @livewireScripts
@stop
