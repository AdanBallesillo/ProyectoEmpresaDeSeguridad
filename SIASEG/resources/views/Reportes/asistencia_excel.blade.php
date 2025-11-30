<table>
    <thead>
        <tr>
            <th>Empleado</th>
            <th>A tiempo</th>
            <th>Retardos</th>
            <th>Faltas</th>
            <th>Puntualidad</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($asistencia as $row)
        <tr>
            <td>{{ $row['nombre'] }}</td>
            <td>{{ $row['a_tiempo'] }}</td>
            <td>{{ $row['tarde'] }}</td>
            <td>{{ $row['falta'] }}</td>
            <td>{{ $row['porcentaje'] }}%</td>
        </tr>
        @endforeach
    </tbody>
</table>
