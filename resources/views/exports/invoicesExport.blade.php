<table>
    <thead>
    <tr>
        <th>Fecha</th>
        <th>Prefijo</th>
        <th>número</th>
        <th>Subtotal</th>
        <th>IVA</th>
        <th>Total</th>
        <th>Identificacion</th>
        <th>Cliente</th>
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
            @php
            $subtotal = 0;
                foreach ($invoice->dataInvoices as $data) {
                    $subtotal += $data->quantity * $data->vlr_unit;
                }
                echo '<td>'.$subtotal.'</td>';
                echo '<td>'.($subtotal*$data->vlr_tax/100).'</td>';
            @endphp
            <td>{{ $invoice->vlr_total }}</td>
            <td>{{ $invoice->clients->dni }}</td>
            <td>{{ $invoice->clients->name }}</td>
            <td>{{ $invoice->type }}</td>
            <td>{{ $invoice->payment_method }}</td>
            <td>{{ $invoice->state->value }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
