<table>
    <thead>
        <tr>
            <th><b>Fecha</b></th>
            <th><b>número</b></th>
            <th><b>Monto</b></th>
            <th><b>Concepto</b></th>
            <th><b>Categoria</b></th>
            <th><b>Usuario</b></th>
        </tr>
    </thead>
    <tbody>
        @php
            $total = 0;
        @endphp
        @foreach ($discharges as $discharge)
            <tr>
                <td>{{ $discharge->date }}</td>
                <td>{{ $discharge->id }}</td>
                <td>{{ $discharge->mount }}</td>
                <td>{{ $discharge->description }}</td>
                <td>{{ $discharge->category->name }}</td>
                <td>{{ $discharge->user->name }}</td>
            </tr>
            @php
                $total += $discharge->mount;
            @endphp
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
