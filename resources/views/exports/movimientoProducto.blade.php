<table>
    <thead>
    <tr>
        <th>Fecha</th>
        <th>Producto</th>
        <th>movimiento</th>
        <th>cantidad</th>
        <th>vlr. unitario</th>
        <th>IVA</th>
        <th>factura</th>
        <th>proveedor/cliente</th>
    </tr>
    </thead>
    <tbody>

    @foreach($dataInvoices as $invoice)
        @if($invoice->shopping_invoice_id)
        <tr>
            <td>{{ $invoice->shoppingInvoice->date_upload }}</td>
            <td>{{ $invoice->product->name }}</td>
            <td>Entrada</td>
            <td>{{ $invoice->quantity }}</td>
            <td>{{ $invoice->vlr_unit }}</td>
            <td>{{ $invoice->vlr_tax }}</td>
            <td>{{ $invoice->shoppingInvoice->number }}</td>
            <td>{{ $invoice->shoppingInvoice->suppliers->name }}</td>
        </tr>
        @else
        <tr>
            <td>{{ $invoice->invoice->date_invoice }}</td>
            <td>{{ $invoice->product->name }}</td>
            <td>Salida</td>
            <td>{{ $invoice->quantity }}</td>
            <td>{{ $invoice->vlr_unit }}</td>
            <td>{{ $invoice->vlr_tax }}</td>
            <td>{{ $invoice->invoice->number }}</td>
            <td>{{ $invoice->invoice->clients->name }}</td>
        </tr>
        @endif
    @endforeach
    </tbody>
</table>
