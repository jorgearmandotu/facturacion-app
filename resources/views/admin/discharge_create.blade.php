@extends('adminlte::page')

@section('title', __('titles.create discharge') )

@section('css')
    <link rel="stylesheet" href="../../css/main.css">
    @livewireStyles
@stop

@section('content_header')
@stop

@section('content')
    <h1>{{ __('Expenses') }}</h1>
    @if($invoice)
        <h2>{{ __('Cross with purchase invoice No. ') }} {{$invoice->number}}</h2>
        <h2>{{ __('Outstanding Balance') }} ${{ number_format($invoice->total, 2, ',', '.') }}</h2>
    @endif
    <div class="container-fluid">
        <x-messages_flash/>
        <div class="col-md-9">
            <div class="row justify-content-end"> <h3>{{ $date }}</h3> </div>
            <form action="{{ route('egresos.store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="form-group">
                        <label for="category">{{ __('Category') }}</label>
                        <select name="category" id="" class="form-control">
                            @foreach ($categories as $category)
                            @if( old('category') == $category->id )
                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <livewire:invoice.search-suppliers :invoice="$invoice"/>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="mount">{{ __('Amount') }} $</label><label id="aPagar" class="text-primary"></label>
                        <input type="number" class="form-control" name="mount" value="{{ old('mount')}}" id="inputValor">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="method_payment">{{ __('Way to Pay') }}</label>
                        <select name="method_payment" id="" class="form-control">
                            @foreach($paymentMethods as $method)
                                @if(old('method_payment') && old('method_payment')== $method->value)
                                    <option value="{{$method->value}}" selected>{{$method->value}}</option>
                                @else
                                    <option value="{{$method->value}}">{{$method->value}}</option>
                                @endif
                            @endforeach
                        </select>
                        @if($invoice)
                         <input type="hidden" name="shopping_invoice" value="{{$invoice->id}}" />
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description">{{ __('Description') }}</label>
                    @if($invoice)
                    <textarea name="description" id="" cols="30" rows="10" class="form-control" placeholder="{{ __('Enter reason for discharge') }}"> {{ __('Cross with invoice No.') }} {{ $invoice->number}}, {{ __('from the provider') }} {{$invoice->suppliers->name}} identificado con {{$invoice->suppliers->documentType->name }}: {{$invoice->suppliers->dni }}</textarea>
                    @else
                    <textarea name="description" id="" cols="30" rows="10" class="form-control" placeholder="{{ __('Enter reason for discharge') }}">{{old('description')}}</textarea>
                    @endif
                </div>
                <div class="form-group row">
                    <button class="btn btn-success" type="submit">{{ __('Add') }}</button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('footer')
@stop

{{-- @section('plugins.Datatables', true) --}}
@section('js')
    <script src="../../js/tools.js"></script>
    {{-- <script src="../../js/clients.js"></script> --}}
    @livewireScripts
 @stop
