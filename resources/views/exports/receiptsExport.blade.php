<table>
    <thead>
    <tr>
        <th><b>Fecha</b></th>
        <th><b>Número</b></th>
        <th><b>Valor</b></th>
        <th><b>Identificacion</b></th>
        <th><b>Cliente</b></th>
        <th><b>Prefijo factura</b></th>
        <th><b>numero factura</b></th>
        <th><b>Remision</b></th>
        <th><b>Metodo de pago</b></th>
        <th><b>Comentarios</b></th>
    </tr>
    </thead>
    <tbody>
    @foreach($receipts as $receipt)
        <tr>
            <td>{{ $receipt->date }}</td>
            <td>{{ $receipt->id }}</td>
            <td>{{ $receipt->vlr_payment }}</td>
            <td>{{ $receipt->clients->dni }}</td>
            <td>{{ $receipt->clients->name }}</td>
            <td>{{ $receipt->invoices->prefijo }}</td>
            <td>{{ $receipt->invoices->number }}</td>
            <td>@if($receipt->remision) SI @else NO @endif</td>
            <td>{{ $receipt->type }}</td>
            <td>{{ $receipt->observation}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
