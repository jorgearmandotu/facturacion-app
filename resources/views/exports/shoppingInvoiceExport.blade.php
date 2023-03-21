<table>
    <thead>
    <tr>
        <th>Fecha</th>
        <th>número</th>
        <th>Producto</th>
        <th>cantidad</th>
        <th>vlr. unitario</th>
        <th>sub.total</th>
        <th>Total factura</th>
        <th>Proveedor</th>
        <th>identificación</th>
        <th>Fecha Subida</th>
    </tr>
    </thead>
    <tbody>
    @foreach($invoices as $invoice)
        <tr>
            <td>{{ $invoice->date_invoice }}</td>
            <td>{{ $invoice->number }}</td>
            @foreach($invoice->products as $product)
            <td>{{ $product->product->name }}</td>
            <td>{{ $product->quantity }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ ($product->price*$product->quantity) }}</td>
            @endforeach
            <td>{{ $invoice->total }}</td>
            <td>{{ $invoice->suppliers->name }}</td>
            <td>{{ $invoice->suppliers->dni }}</td>
            <td>{{ $invoice->date_upload }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
