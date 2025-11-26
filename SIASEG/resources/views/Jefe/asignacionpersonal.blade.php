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
                            <th>Lugar</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach(
                            $users->sortBy(function($u) use ($asignaciones, $estacionSeleccionada) {

                                // buscar asignación del empleado
                                $asig = $asignaciones->firstWhere('id_usuarioPK', $u->id_empleado);

                                // 0 = disponible (queda arriba)
                                // 1 = asignado a esta estación (queda en medio)
                                // 2 = asignado a otra estación (abajo del todo)

                                if (!$asig) return 0; // libre
                                if ($asig->id_estacionPK == $estacionSeleccionada) return 1; // editable
                                return 2; // asignado a otra estacion
                            })
                        as $user)

                            @php
                                $asig = $asignaciones->firstWhere('id_usuarioPK', $user->id_empleado);

                                $lugar = $asig ? $asig->nombre_estacion : '—';

                                $esDeEstaEstacion = $asig && $asig->id_estacionPK == $estacionSeleccionada;

                                $asignadoOtra = $asig && $asig->id_estacionPK != $estacionSeleccionada;
                            @endphp

                            <tr class="{{ $asig ? 'asignado' : '' }}">

                                <td>
                                    @if($asignadoOtra)
                                        {{-- empleado ya asignado en otro lado --}}
                                        <span style="opacity: .5;">Ocupado</span>

                                    @else
                                        {{-- checkbox normal o marcado --}}
                                        <input type="checkbox"
                                            name="empleados[]"
                                            value="{{ $user->id_empleado }}"
                                            {{ $esDeEstaEstacion ? 'checked' : '' }}>
                                    @endif
                                </td>

                                <td>{{ $user->nombres }} {{ $user->apellidos }}</td>
                                <td>{{ $lugar }}</td>

                            </tr>

                        @endforeach
                    </tbody>
                </table>
                <p id="limite-aviso" style="color:red; font-weight:bold; margin-top:10px;"></p>


                <!-- PAGINACIÓN -->
                <div style="margin-top: 20px;">
                    {{ $users->links() }}
                </div>

                <!-- BOTÓN -->
                <button type="submit" style="margin-top: 20px; width:100%; " class="btn btn-submit">
                    Asignar
                </button>

            </form>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const selectEstacion = document.querySelector('select[name="estacion_id"]');
            let limite = 0;

            const checkboxes = document.querySelectorAll('input[type="checkbox"][name="empleados[]"]');

            function actualizarLimite() {
                const estacionId = selectEstacion.value;

                const estaciones = @json($estaciones);

                const estacion = estaciones.find(e => e.id_estacion == estacionId);

                limite = estacion ? estacion.p_requerido : 0;

                controlarSeleccion();
            }

            function controlarSeleccion() {
                const seleccionados = document.querySelectorAll('input[name="empleados[]"]:checked').length;

                checkboxes.forEach(cb => {
                    if (!cb.checked) {
                        cb.disabled = seleccionados >= limite;
                    }
                });

                const aviso = document.getElementById('limite-aviso');
                if (seleccionados >= limite) {
                    aviso.innerHTML = `Límite alcanzado: ${limite} empleados requeridos.`;
                } else {
                    aviso.innerHTML = '';
                }
            }

            // Evento: cambio de estación
            selectEstacion.addEventListener('change', actualizarLimite);

            // Evento: checkbox
            checkboxes.forEach(cb => {
                cb.addEventListener('change', controlarSeleccion);
            });

            actualizarLimite();
        });
    </script>
</body>
</html>
