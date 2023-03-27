<table>
    <thead>
    <tr>
        <th>Fecha</th>
        <th>Producto</th>
        <th>movimiento</th>
        <th>cantidad</th>
        <th>saldo</th>
        <th>vlr. unitario</th>
        <th>IVA</th>
        <th>Documento</th>
        <th>Tercero</th>
        <th>Tipo</th>
    </tr>
    </thead>
    <tbody>

    @foreach($movements as $movement)
        @if($movement->document_type == 'Invoice' || $movement->document_type == 'shopping_invoice' || $movement->document_type == 'Anulacion')
        <tr>
            <td>{{ $movement->created_at }}</td>
            <td>{{ $movement->product->name }}</td>
            <td>{{ $movement->type }}</td>
            <td>{{ $movement->quantity }}</td>
            <td>{{ $movement->saldo }}</td>
            <td>{{ $movement->invoice->vlr_unit }}</td>
            <td>{{ $movement->invoice->vlr_tax }}</td>
            @if($movement->document_type == 'shopping_invoice' || ($movement->document_type == 'Anulacion' && $movement->type == 'Salida'))
            <td>{{ $movement->shoppingInvoice->shoppingInvoice->number }}</td>
            <td>{{ $movement->shoppingInvoice->shoppingInvoice->suppliers->name }}</td>
            @elseif($movement->document_type == 'Invoice' || ($movement->document_type == 'Anulacion' && $movement->type == 'Entrada') )
            <td>{{ $movement->invoice->invoice->number }}</td>
            <td>{{ $movement->invoice->invoice->clients->name }}</td>
            {{-- @elseif($movement->document_type == 'Anulacion' && $movement->type == 'Entrada')
            <td>{{ $movement->invoice->invoice->number }}</td>
            <td>{{ $movement->invoice->invoice->clients->name }}</td>
            @elseif($movement->document_type == 'Anulacion' && $movement->type == 'Salida')
            <td>{{ $movement->shoppingInvoice->shoppingInvoice->number }}</td>
            <td>{{ $movement->shoppingInvoice->shoppingInvoice->suppliers->name }}</td> --}}
            @endif
            @if($movement->document_type && $movement->document_type == 'Invoice')
                <td>Factura</td>
            @elseif($movement->document_type && $movement->document_type == 'shopping_invoice')
                <td>Factura de compra</td>
            @elseif($movement->document_type && $movement->document_type == 'Anulacion' && $movement->type == 'Salida')
                <td>Anulacion de factura de compra</td>
            @elseif($movement->document_type && $movement->document_type == 'Anulacion' && $movement->type == 'Entrada')
                <td>Anulacion de factura</td>
            @endif
        </tr>
        @else
        <tr>
            <td>{{ $movement->created_at }}</td>
            <td>{{ $movement->product->name }}</td>
            <td>{{ $movement->type }}</td>
            <td>{{ $movement->quantity }}</td>
            <td>{{ $movement->saldo }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Creación de producto</td>
        </tr>
        @endif
    @endforeach
    </tbody>
</table>
