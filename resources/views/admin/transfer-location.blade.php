@extends('adminlte::page')

@section('title', 'Traslados')

@section('css')
    <link rel="stylesheet" href="../../css/main.css">
    @livewireStyles
 @stop

@section('content_header')
@stop

@section('content')
    <h1>Traslados de Bodega</h1>
    <div class="container-fluid containers">
        <div>
            <div class="row">
                <button class="btn btn-light border" data-toggle="modal" data-target="#transferModal"><i class="fas fa-solid fa-plus"></i>Traslado rapido</button>
                <a class="btn btn-light border ml-2" href="transfer-products" target="_blanck"><i class="fas fa-solid fa-plus"></i>Nuevo traslado</a>
            </div>

            <div class="modal fade" id="transferModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Traslados por bodega</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form id="form-transfer" >
                    <div class="modal-body">
                        @csrf
                        <div id="datalist"></div>
                        <livewire:products.transfer-locations />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success" data-dismiss="modal" onclick="createTransfer(event)">Trasladar</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
        </div>

        <div class="container col-md-9 tables">
            <table id="tableLocationsProducts" class="table table-striped table-bordered bg-light" style="width:100%">
                <thead>
                    <tr>
                        <th style="max-width: 10px">Código Producto</th>
                        <th>Producto</th>
                        <th>Ubicacion</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach($locations as $location)
                    <tr>
                        <td>{{ $location->product->code }}</td>
                        <td>{{ $location->product->name }}</td>
                        <td>{{ $location->location->name }}</td>
                        <td>{{ $location->stock }}</td>
                    </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('footer')
@stop

@section('plugins.Datatables', true)
@section('js')
    <script src="../../js/tools.js"></script>
    <script src="../../js/transfer-location.js"></script>
    @livewireScripts
@stop
