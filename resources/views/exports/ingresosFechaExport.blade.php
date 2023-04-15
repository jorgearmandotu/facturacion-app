<table>
    <thead>
        <tr>
            <th><b>Fecha</b></th>
            <th><b>Prefijo</b></th>
            <th><b>número</b></th>
            <th><b>Total</b></th>
            <th><b>Identificacion</b></th>
            <th><b>Cliente</b></th>
            <th><b>Metodo de pago</b></th>
            {{-- <th>Estado</th> --}}
            <th><b>Documento</b></th>
            <th><b>Usuario</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($invoices as $invoice)
            @if ($invoice->state->value != 'Anulado')
                @if (isset($invoice->prefijo))
                {{-- es factura --}}
                    @if ($invoice->receipts)
                        @foreach ($invoice->receipts as $receipt)
                            @if ($receipt->state->value != 'Anulado')
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
                                @if ($receipt->remision->state->value != 'Anulado')
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
                @else
                    {{-- es remision --}}
                    <tr>
                        <td>{{ $invoice->date_remision }}</td>
                        <td>Remision</td>
                        <td>{{ $invoice->id }}</td>
                        <td>{{ $invoice->vlr_payment }}</td>
                        <td>{{ $invoice->clients->dni }}</td>
                        <td>{{ $invoice->clients->name }}</td>
                        <td>{{ $invoice->payment_method }}</td>
                        <td>Remision</td>
                        <td>{{ $invoice->user->name }}</td>
                    </tr>
                @endif
            @endif
        @endforeach
    </tbody>
</table>
