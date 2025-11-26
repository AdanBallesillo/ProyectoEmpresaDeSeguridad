<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nueva Asignación - Sistema Integral de Gestión</title>

    <link rel="stylesheet" href="{{ asset('css/style_NuevaEstacion.css') }}" />

    <style>
        /* Sombreado de empleados ya asignados */
        .asignado {
            background-color: #f8d7da !important;
            color: #721c24 !important;
        }
        .tabla-empleados {
            width: 100%;
            border-collapse: collapse;
        }
        .tabla-empleados th,
        .tabla-empleados td {
            border: 1px solid #ccc;
            padding: 8px;
        }
        .tabla-empleados th {
            background: #eee;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <header class="header-container">
        <div class="header-content">
            <div class="logo-and-text">
                <div class="logo-placeholder"></div>
                <div class="text-group">
                    <h1 class="main-title">Sistema integral de gestion</h1>
                    <p class="subtitle">Control de Personal y Asistencia</p>
                </div>
            </div>
            <div class="user-info">
                <span class="user-role">Admin Usuario</span>
                <div class="user-icon"></div>
            </div>
        </div>
    </header>

    <!-- SUBHEADER -->
    <div class="sub-header">
        <h2>Nueva Asignación</h2>
    </div>

    <!-- TARJETA -->
    <div class="card">
        <div class="card-header">
            <h3>Asignar Personal a Estación</h3>
        </div>

        <div class="card-body">

            <form method="POST" action="{{ route('asignaciones.store') }}">
                @csrf

                <!-- Estación + Turno -->
                <div style="display: flex; gap: 30px; margin-bottom: 25px;">

                    <div>
                        <label><strong>Estación</strong></label><br>
                        <select name="estacion_id" required>
                            @foreach($estaciones as $est)
                                <option value="{{ $est->id_estacion }}">
                                    {{ $est->nombre_estacion }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label><strong>Turno</strong></label><br>
                        <select name="turno" required>
                            <option value="Matutino">Matutino</option>
                            <option value="Vespertino">Vespertino</option>
                            <option value="Nocturno">Nocturno</option>
                        </select>
                    </div>

                </div>

                <!-- TABLA DE EMPLEADOS -->
                <h3>Seleccionar Empleados</h3>

                <table class="tabla-empleados">
                    <thead>
                        <tr>
                            <th>Sel</th>
                            <th>Nombre</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($users as $user)
                            @php
                                $yaAsignado = in_array($user->id_empleado, $asignados);
                            @endphp

                            <tr class="{{ $yaAsignado ? 'asignado' : '' }}">

                                <td>
                                    @if(!$yaAsignado)
                                        <input type="checkbox" name="empleados[]" value="{{ $user->id_empleado }}">
                                    @else
                                        <span style="opacity: 0.6;">Asignado</span>
                                    @endif
                                </td>

                                <td>{{ $user->nombres }} {{ $user->apellidos }}</td>
                            </tr>

                        @endforeach
                    </tbody>

                </table>

                <!-- PAGINACIÓN -->
                <div style="margin-top: 20px;">
                    {{ $users->links() }}
                </div>

                <!-- BOTÓN -->
                <button type="submit" style="margin-top: 20px;">
                    Asignar
                </button>

            </form>

        </div>
    </div>

</body>
</html>
