<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exportar empleados a PDF</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f9fafb;
            padding: 2rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        h2 {
            font-size: 1.5rem;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 1.5rem;
        }

        .table-wrapper {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #f3f4f6;
        }

        th {
            padding: 12px 24px;
            text-align: left;
            font-size: 0.75rem;
            font-weight: 600;
            color: #374151;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid #e5e7eb;
        }

        tbody tr {
            border-bottom: 1px solid #e5e7eb;
        }

        tbody tr:hover {
            background-color: #f9fafb;
        }

        td {
            padding: 16px 24px;
            font-size: 0.875rem;
            color: #4b5563;
        }

        td:first-child {
            color: #111827;
            font-weight: 500;
        }

        .empty-state {
            text-align: center;
            color: #6b7280;
            padding: 24px;
        }

        /* Estilos específicos para PDF */
        @media print {
            body {
                background-color: white;
                padding: 1rem;
            }

            .table-wrapper {
                box-shadow: none;
            }

            tbody tr:hover {
                background-color: transparent;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Empleados Registrados en el Sistema</h2>

    <div class="table-wrapper">
        <table>
            <thead>
            <tr>
                <th>Nombre</th>
                <th>RFC</th>
                <th>CURP</th>
                <th>Número de Emergencia</th>
                <th>Correo</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->nombres }} {{ $empleado->apellidos }}</td>
                    <td>{{ $empleado->RFC }}</td>
                    <td>{{ $empleado->CURP }}</td>
                    <td>{{ $empleado->telefono }}</td>
                    <td>{{ $empleado->correo }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="empty-state">No hay empleados registrados.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
