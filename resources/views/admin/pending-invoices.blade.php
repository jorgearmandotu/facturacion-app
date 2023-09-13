@extends('adminlte::page')

@section('title', __('titles.pending invoices') )

@section('css')
<link rel="stylesheet" href="../../css/main.css">
@livewireStyles
@stop

@section('content_header')
@stop

@section('content')
<h1>{{ __('Pending Credit Invoices') }}</h1>

<div class="containers container-fluid col-md-10">
    <div class="tables">
        <table id="pendingInvoicesTable" class="table table-striped table-bordered bg-light" style="width:100%">
            <thead>
                <tr>
                    <th>{{ __('Prefix') }}</th>
                    <th>{{ __('Number') }}</th>
                    <th>{{ __('Client') }}</th>
                    <th>{{ __('Identification') }}</th>
                    <th>{{ __('Total') }}</th>
                    <th>{{ __('Outstanding Balance') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoices as $invoice)
                <tr>
                    <td>{{$invoice->prefijo}}</td>
                    <td>{{$invoice->number}}</td>
                    <td>{{$invoice->clients->name}}</td>
                    <td>{{$invoice->clients->dni}}</td>
                    <td>{{ number_format($invoice->vlr_total, 2, ',', '.') }}</td>
                    @php
                        //$receipts = App\Models\Receipt::where('invoice_id', $invoice->id)->get();
                        $saldo = $invoice->vlr_total;
                        foreach ($invoice->receipts as $receipt) {
                            $saldo -= $receipt->vlr_payment;
                            if($receipt->remision){
                                $saldo -= $receipt->remision->vlr_payment;
                            }
                        }
                    @endphp
                    <td>{{ number_format($saldo, 2, ',', '.') }}</td>
                    <td><a href="printInvoice/{{$invoice->id}}">{{ __('View') }}</a></td>
                </tr>
                @endforeach
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
    <script src="../../js/pending-invoices.js"></script>
    {{-- <script src="../../js/datatables-buttons/dataTables.buttons.min.js"></script>
    <script src="../../js/datatables-buttons/jszip.min.js"></script>
    <script src="../../js/datatables-buttons/pdfmake.min.js"></script>
    <script src="../../js/datatables-buttons/vfs_fonts.js"></script>
    <script src="../../js/datatables-buttons/buttons.html5.min.js"></script>
    <script src="../../js/datatables-buttons/buttons.print.min.js"></script> --}}
    @livewireScripts
@stop
