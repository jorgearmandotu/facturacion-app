<table>
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Prefijo</th>
            <th>número</th>
            <th>Total</th>
            <th>Identificacion</th>
            <th>Cliente</th>
            <th>Metodo de pago</th>
            {{-- <th>Estado</th> --}}
            <th>Documento</th>
            <th>Usuario</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($invoices as $invoice)
            @if ($invoice->state->value != 'Anulado')
                @if ($invoice->receipts)
                    @foreach ($invoice->receipts as $receipt)
                        @if($receipt->state->value != 'Anulado')
                        <tr>
                            <td>{{ $receipt->date }}</td>
                            <td>Recibo</td>
                            <td>{{ $receipt->id }}</td>
                            <td>{{ $receipt->vlr_payment }}</td>
                            <td>{{ $receipt->clients->dni }}</td>
                            <td>{{ $receipt->clients->name }}</td>
                            <td>{{ $receipt->type }}</td>
                            <td>Recibo</td>
                            <td>{{ $receipt->user->name }}</td>
                        </tr>
                        @endif
                        @if ($receipt->remision)
                            @if($receipt->remision->state->value != 'Anulado')
                            <tr>
                                <td>{{ $receipt->remision->date_remision }}</td>
                                <td>Remision</td>
                                <td>{{ $receipt->remision->id }}</td>
                                <td>{{ $receipt->remision->vlr_payment }}</td>
                                <td>{{ $receipt->remision->clients->dni }}</td>
                                <td>{{ $receipt->remision->clients->name }}</td>
                                <td>{{ $receipt->remision->payment_method }}</td>
                                <td>Remision</td>
                                <td>{{ $receipt->remision->user->name }}</td>
                            </tr>
                            @endif
                        @endif
                    @endforeach
                @endif
                @if ($invoice->type == 'CONTADO')
                    <tr>
                        <td>{{ $invoice->date_invoice }}</td>
                        <td>{{ $invoice->prefijo }}</td>
                        <td>{{ $invoice->number }}</td>
                        <td>{{ $invoice->vlr_total }}</td>
                        <td>{{ $invoice->clients->dni }}</td>
                        <td>{{ $invoice->clients->name }}</td>
                        <td>{{ $invoice->payment_method }}</td>
                        <td>Factura</td>
                        <td>{{ $invoice->user->name }}</td>
                    </tr>
                @endif
            @endif
        @endforeach
    </tbody>
</table>
