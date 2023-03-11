<table>
    <thead>
    <tr>
        <th>Fecha</th>
        <th>Cliente</th>
        <th>Identificacion</th>
        <th>Prefijo factura</th>
        <th>numero factura</th>
        <th>Valor</th>
        <th>Metodo de pago</th>
        <th>Remision</th>
    </tr>
    </thead>
    <tbody>
    @foreach($receipts as $receipt)
        <tr>
            <td>{{ $receipt->date }}</td>
            <td>{{ $receipt->clients->name }}</td>
            <td>{{ $receipt->clients->dni }}</td>
            <td>{{ $receipt->invoices->prefijo }}</td>
            <td>{{ $receipt->invoices->number }}</td>
            <td>{{ $receipts->vlr_payment }}</td>
            <td>{{ $receipt->type }}</td>
            <td>@if($receipt->remision) SI @else NO @endif</td>
        </tr>
    @endforeach
    </tbody>
</table>
