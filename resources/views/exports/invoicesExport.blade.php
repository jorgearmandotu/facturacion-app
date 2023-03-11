<table>
    <thead>
    <tr>
        <th>Fecha</th>
        <th>Prefijo</th>
        <th>número</th>
        <th>Valor</th>
        <th>Forma de pago</th>
        <th>Metodo de pago</th>
        <th>Estado</th>
    </tr>
    </thead>
    <tbody>
    @foreach($invoices as $invoice)
        <tr>
            <td>{{ $invoice->date_invoice }}</td>
            <td>{{ $invoice->prefijo }}</td>
            <td>{{ $invoice->number }}</td>
            <td>{{ $invoice->vlr_total }}</td>
            <td>{{ $invoice->type }}</td>
            <td>{{ $invoice->payment_method }}</td>
            <td>{{ $invoice->value }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
