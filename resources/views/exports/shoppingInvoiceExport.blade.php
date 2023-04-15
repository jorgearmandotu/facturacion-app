<table>
    <thead>
        <tr>
            <th><b>Fecha</b></th>
            <th><b>número</b></th>
            <th><b>Producto</b></th>
            <th><b>cantidad</b></th>
            <th><b>vlr. unitario</b></th>
            <th><b>sub.total</b></th>
            <th><b>Total factura</b></th>
            <th><b>Proveedor</b></th>
            <th><b>identificación</b></th>
            <th><b>Fecha Subida</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($invoices as $invoice)
            @foreach ($invoice->products as $product)
                <tr>
                    <td>{{ $invoice->date_invoice }}</td>
                    <td>{{ $invoice->number }}</td>
                    {{-- <td></td>
        <td></td>
        <td></td>
        <td></td> --}}
                    <td>{{ $product->product->name }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->vlr_unit }}</td>
                    <td>{{ $product->vlr_unit * $product->quantity }}</td>
                    <td>{{ $invoice->total }}</td>
                    <td>{{ $invoice->suppliers->name }}</td>
                    <td>{{ $invoice->suppliers->dni }}</td>
                    <td>{{ $invoice->date_upload }}</td>
                </tr>
                {{-- <tr>
            <td></td>
            <td></td>

            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr> --}}
            @endforeach
        @endforeach
    </tbody>
</table>
