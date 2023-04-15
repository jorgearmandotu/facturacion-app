<table>
    <thead>
    <tr>
        <th><b>Fecha</b></th>
        <th><b>Prefijo</b></th>
        <th><b>número</b></th>
        <th><b>Subtotal</b></th>
        <th><b>IVA</b></th>
        <th><b>Total</b></th>
        <th><b>Identificacion</b></th>
        <th><b>Cliente</b></th>
        <th><b>Forma de pago</b></th>
        <th><b>Metodo de pago</b></th>
        <th><b>Estado de pago</b></th>
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
