<table>
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Prefijo</th>
            <th>número</th>
            <th>Total</th>
            <th>Metodo de pago</th>
            {{-- <th>Estado</th> --}}
            <th>Documento</th>
            <th>Usuario</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($movements as $movement)
            @if ($movement->state->value != 'Anulado')
                @if (isset($movement->prefijo))
                    @if ($movement->receipts)
                        @foreach ($movement->receipts as $receipt)
                            @if ($movement->state->value != 'Anulado')
                                <tr>
                                    <td>{{ $receipt->date }}</td>
                                    <td>Recibo</td>
                                    <td>{{ $receipt->id }}</td>
                                    <td>{{ $receipt->vlr_payment }}</td>
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
                                        <td>{{ $receipt->remision->payment_method }}</td>
                                        <td>Remision</td>
                                        <td>{{ $receipt->remision->user->name }}</td>
                                    </tr>
                                @endif
                            @endif
                        @endforeach
                    @endif
                    @if ($movement->type == 'CONTADO')
                        <tr>
                            <td>{{ $movement->date_invoice }}</td>
                            <td>{{ $movement->prefijo }}</td>
                            <td>{{ $movement->number }}</td>
                            <td>{{ $movement->vlr_total }}</td>
                            <td>{{ $movement->payment_method }}</td>
                            <td>Factura</td>
                            <td>{{ $movement->user->name }}</td>
                        </tr>
                    @endif
                @elseif(isset($movement->date_remision))
                    {{-- es remision --}}
                    <tr>
                        <td>{{ $movement->date_remision }}</td>
                        <td>Remision</td>
                        <td>{{ $movement->id }}</td>
                        <td>{{ $movement->vlr_payment }}</td>
                        <td>{{ $movement->payment_method }}</td>
                        <td>Remision</td>
                        <td>{{ $movement->user->name }}</td>
                    </tr>
                @else
                {{-- es egreso --}}
                <tr>
                    <td>{{ $movement->date }}</td>
                    <td>Egreso</td>
                    <td>{{ $movement->id }}</td>
                    <td>{{ $movement->mount }}</td>
                    <td>EFECTIVO</td>
                    <td>Egreso</td>
                    <td>{{ $movement->user->name }}</td>
                </tr>
                @endif
            @endif
        @endforeach
    </tbody>
</table>
