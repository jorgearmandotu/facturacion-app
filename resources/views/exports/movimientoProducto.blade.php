<html>
{{-- {{ HTML::style('../../css/export.css') }} --}}

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="{{ asset('../../css/export.css') }}">
</head>
<table style="border: 1px solid black;">
    <thead>
        <tr>
            <th class="headerTable"><b>Fecha</b></th>
            <th class="headerTable"><b>Producto</b></th>
            <th class="header"><b>movimiento</b></th>
            <th class="header"><b>cantidad</b></th>
            <th class="header"><b>saldo</b></th>
            <th class="header"><b>vlr. unitario</b></th>
            <th class="header"><b>IVA</b></th>
            <th class="header"><b>Documento</b></th>
            <th class="header"><b>Tercero</b></th>
            <th class="header"><b>Tipo</b></th>
            <th class="header"><b>Ubicación</b></th>
        </tr>
    </thead>
    <tbody>
        @php
            $primeraIteracion = true;
        @endphp
        @foreach ($movements as $movement)
            @if (
                $movement->document_type == 'Invoice' ||
                    $movement->document_type == 'shopping_invoice' ||
                    $movement->document_type == 'Anulacion' ||
                    $movement->document_type == 'TransferLocation')
                @if ($primeraIteracion)
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{ $movement->saldo - $movement->quantity }}</td>
                    </tr>
                    @php
                        $primeraIteracion = false;
                    @endphp
                @endif
                <tr>
                    <td>{{ date_format($movement->created_at, 'Y-m-d') }}</td>
                    <td>{{ $movement->product->name }}</td>
                    <td>{{ $movement->type }}</td>
                    <td>{{ $movement->quantity }}</td>
                    <td>{{ $movement->saldo }}</td>
                    @if ($movement->document_type == 'TransferLocation')
                        <td></td>
                        <td></td>
                    @else
                        <td>{{ $movement->invoice->vlr_unit }}</td>
                        <td>{{ $movement->invoice->vlr_tax }}</td>
                    @endif
                    @if (
                        $movement->document_type == 'shopping_invoice' ||
                            ($movement->document_type == 'Anulacion' && $movement->type == 'Salida'))
                        <td>{{ $movement->shoppingInvoice->shoppingInvoice->number }}</td>
                        <td>{{ $movement->shoppingInvoice->shoppingInvoice->suppliers->name }}</td>
                    @elseif($movement->document_type == 'Invoice' || ($movement->document_type == 'Anulacion' && $movement->type == 'Entrada'))
                        <td>{{ $movement->invoice->invoice->prefijo.'-'.$movement->invoice->invoice->number }}</td>
                        <td>{{ $movement->invoice->invoice->clients->name }}</td>
                    @elseif($movement->document_type == 'TransferLocation')
                        <td>{{ $movement->transfer->number }}</td>
                        <td></td>
                    @endif
                    @if ($movement->document_type && $movement->document_type == 'Invoice')
                        <td>Factura</td>
                    @elseif($movement->document_type && $movement->document_type == 'shopping_invoice')
                        <td>Factura de compra</td>
                    @elseif($movement->document_type && $movement->document_type == 'Anulacion' && $movement->type == 'Salida')
                        <td>Anulacion de factura de compra</td>
                    @elseif($movement->document_type && $movement->document_type == 'Anulacion' && $movement->type == 'Entrada')
                        <td>Anulacion de factura</td>
                    @elseif($movement->document_type && $movement->document_type == 'TransferLocation')
                        <td>Traslado</td>
                    @endif
                    <td>{{ $movement->location->name }}</td>
                </tr>
            @else
                @if ($primeraIteracion)
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{ $movement->saldo - $movement->quantity }}</td>
                    </tr>
                    @php
                        $primeraIteracion = false;
                    @endphp
                @endif
                <tr>
                    <td>{{ date_format($movement->created_at, 'Y-m-d') }}</td>
                    <td>{{ $movement->product->name }}</td>
                    <td>{{ $movement->type }}</td>
                    <td>{{ $movement->quantity }}</td>
                    <td>{{ $movement->saldo }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Creación de producto</td>
                    <td>{{ $movement->location->name }}</td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>

</html>
