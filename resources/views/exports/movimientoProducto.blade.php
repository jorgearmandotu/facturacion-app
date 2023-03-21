<table>
    <thead>
    <tr>
        <th>Fecha</th>
        <th>Producto</th>
        <th>movimiento</th>
        <th>cantidad</th>
        <th>vlr. unitario</th>
        <th>factura</th>
        <th>proveedor</th>
    </tr>
    </thead>
    <tbody>

    @foreach($invoices as $invoice)
        <tr>
            <td>{{ $invoice->date_upload }}</td>
            <td>{{ $invoice->product->name }}</td>
            <td>Entrada</td>
            <td>{{ $invoice->products->quantity }}</td>
            <td>{{ $invoice->products->price }}</td>
            <td>{{ $invoice->number }}</td>
            <td>{{ $invoice->suppliers->name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
