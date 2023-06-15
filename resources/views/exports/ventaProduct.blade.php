<html>
    {{-- {{ HTML::style('../../css/export.css') }} --}}
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="{{ asset('../../css/export.css') }}" >
    </head>
    <table style="border: 1px solid black;">
        <thead>
        <tr>
            <th class="headerTable"><b>Fecha</b></th>
            <th class="headerTable"><b>prefijo</b></th>
            <th class="headerTable"><b>Numero Factura</b></th>
            <th class="headerTable"><b>Producto</b></th>
            <th class="header"><b>cantidad</b></th>
            <th class="header"><b>vlr. Unitario</b></th>
            <th class="header"><b>Impuestos</b></th>
        </tr>
        </thead>
        <tbody>

        @foreach($movements as $movement)
            <tr>
                <td>{{ $movement->date_invoice }}</td>
                <td>{{ $movement->prefijo }}</td>
                <td>{{ $movement->number }}</td>
                <td>{{ $movement->product }}</td>
                <td>{{ $movement->quantity }}</td>
                <td>{{ $movement->vlr_unit }}</td>
                <td>{{ $movement->tax }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</html>
