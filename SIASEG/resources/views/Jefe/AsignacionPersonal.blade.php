<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nueva Asignación - Sistema Integral de Gestión</title>

    <link rel="stylesheet" href="{{ asset('css/style_NuevaEstacion.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style_Menu.css') }}" />
    <style>
        /* CONTENEDOR GENERAL */
        .card-body-inner {
            padding: 10px 5px 0 5px;
        }

        /* Empleado asignado EN ESTA estación */
        .asignado-esta {
            background-color: #e0f2fe !important;
            color: #0f172a !important;
        }

        /* Empleado asignado en OTRA estación (ocupado) */
        .ocupado-otra {
            background-color: #fee2e2 !important;
            color: #b91c1c !important;
        }

        .badge-ocupado {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 999px;
            background: #b91c1c;
            color: #fff;
            font-size: 12px;
            font-weight: 600;
        }

        .tabla-empleados {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
            font-size: 14px;
        }

        .tabla-empleados thead {
            background: #0f172a;
            color: #fff;
        }

        .tabla-empleados th,
        .tabla-empleados td {
            border: 1px solid #e5e7eb;
            padding: 8px 10px;
        }

        .tabla-empleados tbody tr:nth-child(odd):not(.asignado-esta):not(.ocupado-otra) {
            background-color: #f9fafb;
        }

        .tabla-empleados tbody tr:hover {
            background-color: #e5e7eb;
        }

        .col-sel {
            width: 70px;
            text-align: center;
        }

        .col-lugar {
            width: 220px;
        }

        .col-turno {
            width: 100px;
            text-align: center;
        }

        .col-salida {
            width: 130px;
            text-align: center;
        }

        /* Paginación */
        .pagination-wrapper {
            margin-top: 18px;
            display: flex;
            justify-content: center;
        }

        .pagination {
            display: inline-flex;
            list-style: none;
            padding-left: 0;
            border-radius: 999px;
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }

        .pagination li a,
        .pagination li span {
            display: block;
            padding: 6px 10px;
            font-size: 13px;
            text-decoration: none;
            color: #111827;
            background: #fff;
        }

        .pagination li a:hover {
            background: #e5e7eb;
        }

        .pagination .active span {
            background: #0f172a;
            color: #fff;
        }

        .pagination .disabled span {
            color: #9ca3af;
            background: #f9fafb;
        }

        /* Botón submit */
        .btn-submit {
            background-color: #111827;
            border: none;
            color: #fff;
            padding: 10px 16px;
            border-radius: 999px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.15s ease;
        }

        .btn-submit:hover {
            background-color: #020617;
        }

        .info-estacion {
            font-size: 16px;
            margin-bottom: 6px;
        }

        .info-estacion span {
            font-weight: 700;
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
                <span class="user-role"> Bienvenido, {{ Auth::user() -> nombres ?? 'Invitado' }} </span>
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

        <div class="card-body card-body-inner">

            <form method="POST" action="{{ route('asignaciones.store') }}">
                @csrf

                <!-- estación oculta -->
                <input type="hidden" name="estacion_id" value="{{ $estacionSeleccionada }}">

                <!-- Información visible -->
                <p class="info-estacion">
                    Estación seleccionada:
                    <span style="color:#003366;">
                        {{ $estaciones->firstWhere('id_estacion', $estacionSeleccionada)->nombre_estacion ?? '—' }}
                    </span>
                </p>

                <!-- SOLO TURNOS -->
                <div style="margin-bottom: 18px;">
                    <label><strong>Turno:</strong></label><br>
                    <select name="turno" required>
                        <option value="Matutino" {{ $turnoSeleccionado === 'Matutino' ? 'selected' : '' }}>Matutino</option>
                        <option value="Nocturno" {{ $turnoSeleccionado === 'Nocturno' ? 'selected' : '' }}>Nocturno</option>
                    </select>
                </div>

                <!-- TABLA DE EMPLEADOS -->
                <h3 style="margin-bottom: 10px;">Seleccionar Empleados</h3>

                <table class="tabla-empleados">
                    <thead>
                        <tr>
                            <th class="col-sel">Sel</th>
                            <th>Nombre</th>
                            <th class="col-lugar">Lugar</th>
                            <th class="col-turno">Turno hoy</th>
                            <th class="col-salida">Salida (sim.)</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach(
                        $users->sortBy(function($u) use ($asignaciones, $estacionSeleccionada) {

                        // Buscar asignación de ESTE empleado (hoy) en la colección
                        $asig = $asignaciones->firstWhere('id_empleado', $u->id_empleado);

                        // 0 = libre
                        // 1 = asignado a esta estación
                        // 2 = asignado en otra estación
                        if (!$asig) return 0;
                        if ($asig->id_estacion == $estacionSeleccionada) return 1;
                        return 2;
                        })
                        as $user)

                        @php
                        // Buscar asignación de este empleado hoy
                        $asig = $asignaciones->firstWhere('id_empleado', $user->id_empleado);

                        // Nombre de la estación donde está asignado hoy (si aplica)
                        $lugar = $asig ? $asig->nombre_estacion : '—';

                        $esDeEstaEstacion = $asig && $asig->id_estacion == $estacionSeleccionada;
                        $asignadoOtra = $asig && $asig->id_estacion != $estacionSeleccionada;

                        // Turno y salida simulada (+3 min desde created_at)
                        $turnoAsignado = $asig->turno ?? '—';

                        if ($asig) {
                        $salidaSimulada = \Carbon\Carbon::parse($asig->created_at)
                        ->addMinutes(3) // 👈 aquí simulas 3 minutos
                        ->format('H:i:s');
                        } else {
                        $salidaSimulada = '—';
                        }
                        @endphp

                        <tr class="
                                @if($asignadoOtra)
                                    ocupado-otra
                                @elseif($esDeEstaEstacion)
                                    asignado-esta
                                @endif
                            ">

                            <td class="col-sel">
                                @if($asignadoOtra)
                                <span class="badge-ocupado">Ocupado</span>
                                @else
                                <input
                                    type="checkbox"
                                    name="empleados[]"
                                    value="{{ $user->id_empleado }}"
                                    {{ $esDeEstaEstacion ? 'checked' : '' }}>
                                @endif
                            </td>

                            <td>{{ $user->nombres }} {{ $user->apellidos }}</td>
                            <td class="col-lugar">{{ $lugar }}</td>
                            <td class="col-turno">{{ $turnoAsignado }}</td>
                            <td class="col-salida">{{ $salidaSimulada }}</td>

                        </tr>

                        @endforeach
                    </tbody>
                </table>

                <!-- Paginación -->
                <div class="pagination-wrapper">
                    {{ $users->appends(['turno' => $turnoSeleccionado])->links('pagination::bootstrap-4') }}
                </div>

                <!-- Botón -->
                <div style="margin-top: 20px;">
                    <button type="submit" class="btn btn-submit" style="width: 100%;">
                        Asignar
                    </button>
                </div>
   <div style="margin-top: 20px;">
    <button type="button" class="cancelar"
        style="width: 100%; background-color: #0056b3; color: white; border: none; padding: 10px; border-radius: 5px; cursor: pointer;"
        onclick="window.location.href='{{ route('dashboard.estaciones') }}'">
        Regresar
    </button>
</div>

            </form>

        </div>
    </div>

</body>

</html>
