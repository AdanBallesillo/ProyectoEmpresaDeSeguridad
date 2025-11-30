<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: sans-serif; }
        .header { text-align:center; margin-bottom:20px; }
        .logo { width: 120px; margin-bottom: 10px; }

        table {
            width:100%;
            border-collapse:collapse;
            margin-top: 20px;
        }

        th {
            background:#FFA500;
            color:white;
            padding:8px;
            font-size:14px;
        }

        td {
            padding:8px;
            border-bottom:1px solid #ddd;
            font-size:13px;
        }

        .footer {
            margin-top:40px;
            text-align:center;
            font-size:12px;
            color:#888;
        }
    </style>
</head>
<body>

    <div class="header">
        <!-- LOGO → AQUI PONES LA RUTA -->
        <img src="{{ public_path('images/Logo.png') }}" class="logo">
        <h2>Reporte de Asistencia — {{ $periodo }}</h2>
        <p>Generado automáticamente por el sistema</p>
    </div>

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

    <div class="footer">
        Sistema Integral de Gestión — {{ date('d/m/Y H:i') }}
    </div>

</body>
</html>
