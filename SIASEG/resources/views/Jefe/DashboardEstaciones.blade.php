<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistema integral de gestión</title>
    <link rel="stylesheet" href="{{ asset('css/style_DashboardEstaciones.css') }}" />
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="header-left">
            <div class="logo"></div>
            <div class="header-text">
                <h1>Sistema integral de gestión</h1>
                <p>Control de Personal y Asistencia</p>
            </div>
        </div>
        <div class="header-right">
            <span>Admin Usuario</span>
            <div class="user-icon">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                </svg>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Title and Actions -->
        <div class="title-section">
            <h2>Control de Estaciones</h2>
            <div class="action-buttons">
                {{-- Modificar estaciones → listado IndexEstaciones --}}
                <a href="{{ route('estaciones.index') }}" class="btn-modify">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M12 4V1L8 5l4 4V6c3.31 0 6 2.69 6 6 0 1.01-.25 1.97-.7 2.8l1.46 1.46C19.54 15.03 20 13.57 20 12c0-4.42-3.58-8-8-8zm0 14c-3.31 0-6-2.69-6-6 0-1.01.25-1.97.7-2.8L5.24 7.74C4.46 8.97 4 10.43 4 12c0 4.42 3.58 8 8 8v3l4-4-4-4v3z" />
                    </svg>
                    Modificar Estaciones
                </a>

                {{-- Nueva estación → formulario CreateEstacion --}}
                <a href="{{ route('estaciones.create') }} " class="btn-new">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
                    </svg>
                    Nueva Estación
                </a>

                <button class="menu-btn">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z" />
                    </svg>
                </button>
            </div>

        </div>

        <!-- Content Grid -->
        <div class="content-grid">
            <!-- Left Column - Stats -->
            <div class="left-column">
                <div class="stat-card">
                    <div class="stat-content">
                        <div class="stat-text">Total de Estaciones</div>
                        <div class="stat-value">{{ $totalEstaciones }}</div>
                    </div>
                    <div class="stat-icon">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                        </svg>
                    </div>
                </div>

                <div class="stat-card orange">
                    <div class="stat-content">
                        <div class="stat-text">Personal Total</div>
                        <div class="stat-value orange-text">{{ $personalTotal }}</div>
                    </div>
                    <div class="stat-icon orange-icon">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                        </svg>
                    </div>
                </div>

                <div class="stat-card green">
                    <div class="stat-content">
                        <div class="stat-text">Estaciones Completas</div>
                        <div class="stat-value green-text">{{ $estacionesCompletas }}</div>
                    </div>
                    <div class="stat-icon green-icon">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />
                        </svg>
                    </div>
                </div>

                <div class="stat-card red">
                    <div class="stat-content">
                        <div class="stat-text">Estaciones falta personal</div>
                        <div class="stat-value red-text">{{ $estacionesFaltaPersonal }}</div>
                    </div>
                    <div class="stat-icon red-icon">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z" />
                        </svg>
                    </div>
                </div>
            </div>


            <div class="middle-column">
                @forelse ($estaciones as $estacion)
                @php
                $asignado = $estacion->personal_asignado;
                $requerido = $estacion->p_requerido ?? 0;
                $porcentaje = $estacion->porcentaje_ocupacion;

                $progressClass = '';
                if ($requerido > 0 && $asignado >= $requerido) {
                $progressClass = ' full';
                }
                if ($requerido > 0 && $asignado > $requerido) {
                $progressClass = ' overfill';
                }

                $diferencia = $requerido - $asignado;
                @endphp

                <div class="station-card">
                    <h3>{{ $estacion->nombre_estacion }}</h3>

                    <div class="station-info">
                        <span>Personal Asignado</span>
                        <span>{{ $asignado }}/{{ $requerido }}</span>
                    </div>

                    <div class="progress-bar">
                        <div class="progress-fill{{ $progressClass }}"
                            style="width: {{ number_format($porcentaje, 0) }}%">
                        </div>
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('jefe.asignar.personal', $estacion->id_estacion) }}" class="btn-asignar">
                            Asignar
                        </a>
                    </div>



                </div>
                @empty
                <p>No hay estaciones registradas.</p>
                @endforelse
            </div>

            <!-- Right Column - Map -->
            <div class="right-column">
                <div class="map-card">
                    <h3>Mapa interactivo<br />de estaciones</h3>

                    <!-- Contenedor real del mapa -->
                    <div id="map" class="map-container"></div>

                    <p class="map-subtitle">Visualización de estaciones</p>
                </div>
            </div>

        </div>
    </main>
    <script>
        const estacionesMapa = @json($estacionesMapa);

        function initMap() {
            const defaultCenter = {
                lat: 23.6345,
                lng: -102.5528
            }; // México

            const map = new google.maps.Map(document.getElementById('map'), {
                center: defaultCenter,
                zoom: 6,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                mapTypeControl: true,
                streetViewControl: true,
                fullscreenControl: true,
                zoomControl: true
            });

            const bounds = new google.maps.LatLngBounds();

            if (estacionesMapa.length === 0) {
                map.setCenter(defaultCenter);
                map.setZoom(5);
                return;
            }

            estacionesMapa.forEach(est => {
                const position = {
                    lat: est.lat,
                    lng: est.lng
                };

                // 🎨 Color según estado
                let color = "#22c55e"; // verde
                let estadoTexto = "Estación completa";

                if (est.estado_personal === "sin_personal") {
                    color = "#ef4444"; // rojo
                    estadoTexto = "Sin personal asignado";
                } else if (est.estado_personal === "faltante") {
                    color = "#facc15"; // amarillo
                    estadoTexto = "Falta personal";
                }

                // Icono redondo "pro"
                const marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    title: est.nombre,
                    icon: {
                        path: google.maps.SymbolPath.CIRCLE,
                        scale: 10,
                        fillColor: color,
                        fillOpacity: 0.95,
                        strokeColor: "#ffffff",
                        strokeWeight: 2
                    }
                });

                // 🖼 InfoWindow elegante con Street View + link
                const infoWindow = new google.maps.InfoWindow({
                    content: `
                        <div style="font-size:13px; max-width:260px; line-height:1.35;">
                            <div style="font-weight:700; text-align:center; margin-bottom:2px;">
                                ${est.nombre}
                            </div>
                            <div style="text-align:center; color:#4b5563;">
                                ${est.ciudad}, ${est.estado}
                            </div>
                            <div style="text-align:center; color:#6b7280; margin-bottom:4px;">
                                ${est.tipo}
                            </div>

                            <div style="text-align:center; margin-bottom:2px;">
                                <span style="color:${color}; font-weight:700;">
                                    ${estadoTexto}
                                </span>
                            </div>
                            <div style="text-align:center; color:#4b5563; margin-bottom:6px;">
                                Personal: ${est.personal_asignado} / ${est.p_requerido}
                            </div>

                            <!-- Imagen Street View (si falla, se oculta) -->
                            <div style="margin-bottom:6px;">
                                <img
                                    src="https://maps.googleapis.com/maps/api/streetview?size=400x200&location=${est.lat},${est.lng}&key={{ config('services.google.maps_js_key') }}"
                                    alt="Vista de la estación"
                                    onerror="this.style.display='none';"
                                    style="width:100%; border-radius:8px; max-height:140px; object-fit:cover;">
                            </div>

                            <!-- Link a Street View en Google Maps -->
                            <div style="margin-top:4px; text-align:center;">
                                <a href="https://www.google.com/maps/@?api=1&map_action=pano&viewpoint=${est.lat},${est.lng}"
                                   target="_blank"
                                   style="display:inline-flex;align-items:center;gap:6px;
                                          padding:4px 10px;border-radius:999px;
                                          background:#2563eb;color:#ffffff;
                                          font-size:12px;text-decoration:none;">
                                    <span style="font-size:14px;">📍</span>
                                    <span>Ver vista de la estación</span>
                                </a>
                            </div>
                        </div>
                    `
                });

                marker.addListener('click', () => {
                    infoWindow.open(map, marker);
                });

                bounds.extend(position);
            });

            if (estacionesMapa.length > 1) {
                map.fitBounds(bounds);
            } else {
                map.setCenter(bounds.getCenter());
                map.setZoom(15);
            }
        }
    </script>

    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps_js_key') }}&callback=initMap&v=weekly"
        async defer>
    </script>
</body>

</html>