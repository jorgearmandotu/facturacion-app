<table>
    <thead>
        <tr>
            <th><b>Fecha</b></th>
            <th><b>número</b></th>
            <th><b>Monto</b></th>
            <th><b>Identificación</b></th>
            <th><b>Tercero</b></th>
            <th><b>Metodo de pago</b></th>
            <th><b>Categoria</b></th>
            <th><b>Concepto</b></th>
            <th><b>Usuario</b></th>
            <th><b>Estado</b></th>
            <th><b>Documento</b></th>
        </tr>
    </thead>
    <tbody>
        @php
            $total = 0;
        @endphp
        @foreach ($discharges as $discharge)
        @if($discharge->category_discharge)
            <tr>
                <td>{{ $discharge->date }}</td>
                <td>{{ $discharge->id }}</td>
                <td>{{ $discharge->mount }}</td>
                <td>{{ $discharge->tercero->dni }}</td>
                <td>{{ $discharge->tercero->name }}</td>
                <td>{{ $discharge->payment_method }}</td>
                <td>{{ $discharge->category->name }}</td>
                <td>{{ $discharge->description }}</td>
                <td>{{ $discharge->user->name }}</td>
                <td>{{ $discharge->state->value }}</td>
                <td>EGRESO</td>
            </tr>
            @php
            if($discharge->state->value != 'Anulado')
                $total += $discharge->mount;
            @endphp
            @else
            <tr>
                <td>{{ $discharge->date_invoice }}</td>
                <td>{{ $discharge->number }}</td>
                <td>{{ $discharge->total }}</td>
                <td>{{ $discharge->suppliers->dni }}</td>
                <td>{{ $discharge->suppliers->name }}</td>
                <td>{{ $discharge->payment_method }}</td>
                <td>{{ '' }}</td>
                <td>{{ 'CARGUE DE FACTURA' }}</td>
                <td>{{ $discharge->user->name }}</td>
                <td>{{ $discharge->state->value }}</td>
                <td>{{ 'FACTURA DE COMPRA' }}</td>
            </tr>
            @php
            if($discharge->state->value != 'Anulado')
                $total += $discharge->total;
            @endphp
        @endif

        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <td><b>Total</b></td>
            <td>{{ $total }}</td>
        </tr>
    </tfoot>
</table>
