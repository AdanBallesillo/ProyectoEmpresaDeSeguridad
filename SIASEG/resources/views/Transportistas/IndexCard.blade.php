<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Ruta Asignada</title>
    <link rel="stylesheet" href="{{ asset('css/style_Card.css') }}">
</head>
<body>

    {{-- VALIDACIÓN PRINCIPAL: ¿Tiene viaje asignado? --}}
    @if(isset($viaje) && $viaje)

        <div class="route-card-wrapper">
            <header class="route-header-card">
                <h1 class="route-title-card"> {{ $viaje->ruta->nombre }} </h1>
                <div class="route-header-info">
                    {{-- Fecha con formato bonito --}}
                    <span class="date-card">
                        {{ \Carbon\Carbon::parse($viaje->fecha_programada)->isoFormat('dddd, D [de] MMMM [del] YYYY') }}
                    </span>
                    {{-- Estado con color dinámico --}}
                    <span class="time-card" style="text-transform: uppercase; color: {{ $viaje->estado == 'en_curso' ? '#4CAF50' : '#FF9800' }}">
                        ● {{ str_replace('_', ' ', $viaje->estado) }}
                    </span>
                </div>
            </header>

            <div class="route-progress-container">
                <div class="route-point-card start">
                    <span class="point-label-card"> Inicio de la ruta </span>
                    <div class="point-details">
                        <span class="point-name-card"> {{ $viaje->ruta->origen }} </span>
                    </div>
                    {{-- Hora formateada --}}
                    <p class="point-time-card">
                        {{ $viaje->hora_inicio_real ? \Carbon\Carbon::parse($viaje->hora_inicio_real)->format('h:i A') : '--:--' }}
                    </p>
                </div>

                <div class="route-direction-card">
                    <div class="arrow-line">
                        <svg width="100%" height="20" viewBox="0 0 100 20" xmlns="http://www.w3.org/2000/svg">
                            <line x1="0" y1="10" x2="90" y2="10" stroke="#333" stroke-width="2" />
                            <polygon points="90,5 100,10 90,15" fill="#333" />
                        </svg>
                    </div>
                </div>

                <div class="route-point-card end">
                    <span class="point-label-card">Fin de la ruta</span>
                    <div class="point-details">
                        <span class="point-name-card"> {{ $viaje->ruta->destino }} </span>
                    </div>
                    {{-- Hora formateada --}}
                    <p class="point-time-card">
                        {{ $viaje->hora_fin_real ? \Carbon\Carbon::parse($viaje->hora_fin_real)->format('h:i A') : '--:--' }}
                    </p>
                </div>
            </div>

            <div class="route-actions-card">

                {{-- CASO 1: PENDIENTE --}}
                @if($viaje->estado == 'pendiente')

                    <form action="{{ route('viajes.inicio', $viaje->id_viaje) }}" method="POST" style="display: contents;">
                        @csrf
                        <button type="submit" class="action-btn-card start-btn-card">Iniciar</button>
                    </form>

                    <button class="action-btn-card finish-btn-card" disabled style="opacity: 0.5; cursor: not-allowed;">Finalizar</button>

                {{-- CASO 2: EN CURSO --}}
                @elseif($viaje->estado == 'en_curso')

                    <button class="action-btn-card start-btn-card" disabled style="opacity: 0.5; cursor: not-allowed;">Iniciado</button>

                    <form action="{{ route('viajes.terminar', $viaje->id_viaje) }}" method="POST" style="display: contents;">
                        @csrf
                        <button type="submit" class="action-btn-card finish-btn-card" onclick="return confirm('¿Confirmas que has llegado al destino?')">Finalizar</button>
                    </form>

                {{-- CASO 3: FINALIZADO --}}
                @elseif($viaje->estado == 'finalizado')
                    <div style="width: 100%; text-align: center; background-color: #e8f5e9; color: #2e7d32; font-weight: bold; padding: 15px; border-radius: 8px;">
                        ✅ Viaje Completado
                    </div>
                @endif

            </div>
        </div>

    {{-- CASO: NO HAY VIAJE ASIGNADO --}}
    @else
        <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100vh; text-align: center; font-family: sans-serif;">
            <h1 style="font-size: 3rem; margin-bottom: 10px;">😴</h1>
            <h2 style="color: #333;">Sin Asignación</h2>
            <p style="color: #666;">No tienes ninguna ruta pendiente en este momento.</p>
        </div>
    @endif

    <script src="../Java/js.js"></script>
</body>
</html>
