<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Unidades</title>
    <link rel="stylesheet" href="{{ asset('css/style_Unidades.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style_Menu.css') }}" />
</head>

<body>

    <!-- Menú hamburguesa -->
    <div class="menu-container" id="menuContainer">
        <div class="menu-header">
            <div class="arrow" id="closeMenu">→</div>
            <h2>Menú</h2>
        </div>
        <div class="menu-items">
            <div class="menu-item" data-link="../Formularios/IndexDashboard.php">
                <div class="icon dashboard">
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="3" width="8" height="8" />
                        <rect x="13" y="3" width="8" height="8" />
                        <rect x="3" y="13" width="8" height="8" />
                        <rect x="13" y="13" width="8" height="8" />
                    </svg>
                </div>
                <span>Dashboard</span>
            </div>
            <div class="menu-item" data-link="../Formularios/IndexAsistencia.blade.php">
                <div class="icon">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" fill="none" stroke="#FF8B00" stroke-width="2" />
                        <polyline points="12,6 12,12 16,14" fill="none" stroke="#FF8B00" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </div>
                <span>Asistencia</span>
            </div>
            <div class="menu-item" data-link="../Formularios/IndexPersonal.blade.php">
                <div class="icon">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="7" r="4" />
                        <path d="M5,21 C5,16.5 8,14 12,14 C16,14 19,16.5 19,21" />
                    </svg>
                </div>
                <span>Personal</span>
            </div>
            <div class="menu-item" data-link="../Formularios/IndexEstaciones.blade.php">
                <div class="icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 2L2 7v3c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z" />
                        <path d="M12 7c-2.21 0-4 1.79-4 4h2c0-1.1.9-2 2-2s2 .9 2 2c0 2-3 1.75-3 5h2c0-2.25 3-2.5 3-5 0-2.21-1.79-4-4-4z" fill="#7D848C" />
                        <circle cx="12" cy="17" r="1" fill="#7D848C" />
                    </svg>
                </div>
                <span>Estaciones</span>
            </div>
            <div class="menu-item" data-link="../Formularios/IndexUnidades.blade.php">
                <div class="icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4z" />
                        <circle cx="6" cy="17" r="2" fill="#7D848C" />
                        <circle cx="18" cy="17" r="2" fill="#7D848C" />
                        <path d="M17 8V4l3 4h-3z" fill="#7D848C" />
                    </svg>
                </div>
                <span>Unidades</span>
            </div>
            <div class="menu-item" data-link="../Formularios/IndexReportes.blade.php">
                <div class="icon">
                    <svg viewBox="0 0 24 24">
                        <rect x="5" y="4" width="14" height="17" rx="1" />
                        <line x1="9" y1="8" x2="15" y2="8" stroke="#7D848C" stroke-width="1.5" />
                        <line x1="9" y1="12" x2="15" y2="12" stroke="#7D848C" stroke-width="1.5" />
                        <line x1="9" y1="16" x2="13" y2="16" stroke="#7D848C" stroke-width="1.5" />
                    </svg>
                </div>
                <span>Reportes</span>
            </div>
        </div>
        <button class="logout-btn" id="logoutBtn">Cerrar Sesión</button>
    </div>


    <header class="header-container">
        <div class="header-content">
            <div class="logo-and-text">
                <div class="logo-placeholder"></div>
                <div class="text-group">
                    <span class="main-title">Sistema integral de gestion</span>
                    <span class="subtitle">Control de Personal y Asistencia</span>
                </div>
            </div>
            <div class="user-info">
                <span class="user-role">Admin Usuario</span>
                <div class="user-icon"></div>
            </div>
        </div>
    </header>

    <div class="page-header">
        <div class="page-header-content">
            <h2>Gestión de Unidades</h2>
            <button class="menu-btn" id="menuBtn">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>



    <main class="main-container">

        <div class="botones-acciones">

            <a href="{{ route('nuevasunidades') }}" class="btn-accion">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Agregar Unidades
            </a>

            <a href="{{ route('mostrartodasunidades') }}" class="btn-accion">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                </svg>
                Detalles de Unidades
                </class=>

                <a href="Formulario_Gestion_Choferes.html" class="btn-accion">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    Gestión de Choferes
                </a>

        </div>



        <div class="contenido">
            <div class="actividad-unidades">
    <h3>Actividad de las Unidades</h3>

    {{-- INICIO DEL CICLO: Repetimos por cada viaje encontrado --}}
    @forelse($actividadUnidades as $viaje)

        <div class="unidad">
            <div class="unidad-header">
                {{-- 1. PLACAS DEL VEHÍCULO --}}
                <p class="placa">{{ $viaje->transporte->placas }}</p>

                {{-- 2. ESTATUS (Cambia de color según el estado) --}}
                @if($viaje->estado == 'en_curso')
                    <span class="activo" style="background-color: #4CAF50; color: white; padding: 2px 8px; border-radius: 4px;">
                        ✓ En Ruta
                    </span>
                @else
                    <span class="activo" style="background-color: #FF9800; color: white; padding: 2px 8px; border-radius: 4px;">
                        🕒 Pendiente
                    </span>
                @endif
            </div>

            {{-- 3. DATOS DEL VEHÍCULO (Marca, Modelo, Año) --}}
            <small>
                {{ $viaje->transporte->marca }} {{ $viaje->transporte->modelo }} ({{ $viaje->transporte->anio }})
            </small>

            {{-- 4. NOMBRE DEL CHOFER --}}
            <small>
                {{ $viaje->empleado->nombres }} {{ $viaje->empleado->apellidos }}
            </small>

            {{-- 5. NOMBRE DE LA RUTA --}}
            <p class="ruta">{{ $viaje->ruta->nombre }}</p>
        </div>

    @empty
        {{-- Si no hay ningún viaje activo, mostramos esto --}}
        <div class="unidad" style="justify-content: center; text-align: center; color: gray;">
            <p>No hay unidades en ruta actualmente.</p>
        </div>
    @endforelse

</div>

            <div class="estadisticas">
                <div class="card">
                    <div class="card-content">
                        <h3>Total de Unidades</h3>
                        <h2>{{ $total }}</h2>
                    </div>
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 254.215 254.215" style="enable-background:new 0 0 254.215 254.215;" xml:space="preserve">
                        <g>
                            <path d="M228.053,52.502H26.162C11.724,52.502,0,64.226,0,78.665v79.432c0,14.439,11.724,26.162,26.162,26.162h30.019
                    c-0.198,1.442-0.347,2.906-0.347,4.394c0,14.439,11.724,26.162,26.162,26.162c14.439,0,26.162-11.724,26.162-26.162
                    c0-1.488-0.149-2.952-0.347-4.394h57.086c-0.198,1.442-0.347,2.906-0.347,4.394c0,14.439,11.724,26.162,26.162,26.162
                    c14.439,0,26.162-11.724,26.162-26.162c0-1.488-0.149-2.952-0.347-4.394h30.019c14.439,0,26.162-11.724,26.162-26.162V78.665
                    C254.215,64.226,242.491,52.502,228.053,52.502z M240.59,158.097c0,6.911-5.604,12.516-12.516,12.516h-30.019V84.118h42.535
                    V158.097z M197.838,158.097h-59.563V84.118h59.563V158.097z M130.64,84.118v73.979H71.076V84.118H130.64z M26.162,84.118
                    h42.535v73.979H26.162c-6.911,0-12.516-5.604-12.516-12.516V78.665C13.646,71.754,19.251,66.15,26.162,66.15h11.954V84.118z
                     M81.834,228.053c-6.911,0-12.516-5.604-12.516-12.516c0-6.911,5.604-12.516,12.516-12.516s12.516,5.604,12.516,12.516
                    C94.35,222.449,88.745,228.053,81.834,228.053z M172.381,228.053c-6.911,0-12.516-5.604-12.516-12.516
                    c0-6.911,5.604-12.516,12.516-12.516s12.516,5.604,12.516,12.516C184.897,222.449,179.292,228.053,172.381,228.053z" />
                        </g>
                    </svg>
                </div>
                <div class="card">
                    <div class="card-content">
                        <h3>Unidades Activas</h3>
                        <h2 class="verde">{{ $activos }}</h2>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#7ac142">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="card">
                    <div class="card-content">
                        <h3>Mantenimientos</h3>
                        <h2 class="rojo">{{ $mantenimientos }}</h2>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#e74c3c">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.25 2.25 0 0021 17.25l-5.82-5.82m-4.5-4.5L12.75 6m-4.5 4.5L12.75 15m-4.5 4.5l6.75-6.75M9 12l.75.75M12 9l.75.75M15 6l.75.75m-6-6l7.5 7.5M10.5 5.25L10.5 5.25C11.975 3.975 14.125 3.975 15.6 5.25L15.6 5.25m-6 0l-1.5-1.5M15.6 5.25l1.5-1.5M7.5 1.5c-1.137 0-2.195.463-2.955 1.223A4.488 4.488 0 003.375 6H2.25a.75.75 0 000 1.5h1.125c.04.283.094.56.165.832L2.8 11.666A.75.75 0 003 12.75l1.125 1.125a3.75 3.75 0 010 5.303L6.394 21h11.212l2.269-2.269a3.75 3.75 0 010-5.303L20.69 7.728a.75.75 0 00.18-1.082l-1.5-1.5c-.76-.76-1.818-1.223-2.955-1.223H17.25M12 4.5h2.25m-4.5 0H12m-4.5 0a3 3 0 013-3h2.25a3 3 0 013 3z" />
                    </svg>
                </div>
            </div>

            @php
            use App\Models\Transporte;

            // Unidades SOLO para el mapa (todas las que no estén en baja)
            $unidadesMapa = Transporte::where('status', '!=', 'Baja')->get();
            @endphp

            <div class="ubicacion">
                <h3>Ubicación de Unidades Aproximada</h3>
                <div id="map" style="width:100%; height:420px; border-radius:12px; background:#eef2f7;"></div>
            </div>

            <script>
                // ========= Unidades desde BD (todas las NO baja) =========
                const RAW_UNIDADES = @json($unidadesMapa ?? []);

                // Filtro extra de seguridad por si en un futuro cambias la consulta
                const UNIDADES = (RAW_UNIDADES || []).filter(u => {
                    const s = String(u.status || '').toLowerCase();
                    return !s.includes('baja');
                });

                // ========= Centros cercanos (no solo uno) =========
                // Puedes agregar más puntos si quieres
                const CENTERS = [{
                        lat: 21.3564,
                        lng: -101.9399
                    }, // Lagos de Moreno centro
                    {
                        lat: 21.3605,
                        lng: -101.9300
                    }, // zona cercana 1
                    {
                        lat: 21.3500,
                        lng: -101.9500
                    }, // zona cercana 2
                    {
                        lat: 21.3700,
                        lng: -101.9450
                    }, // zona cercana 3
                ];

                const RADIUS_M = 2500; // radio alrededor de cada centro (metros)

                function metersToLat(m) {
                    return m / 111320;
                }

                function metersToLng(m, lat) {
                    return m / (40075000 * Math.cos(lat * Math.PI / 180) / 360);
                }

                function randomAround(center) {
                    const r = Math.random() * RADIUS_M;
                    const theta = Math.random() * Math.PI * 2;
                    const dLat = metersToLat(r * Math.cos(theta));
                    const dLng = metersToLng(r * Math.sin(theta), center.lat);
                    return {
                        lat: center.lat + dLat,
                        lng: center.lng + dLng
                    };
                }

                // Elige un centro aleatorio cercano (no siempre el mismo)
                function randomCenter() {
                    const idx = Math.floor(Math.random() * CENTERS.length);
                    return CENTERS[idx];
                }

                function jitter(pos) {
                    const step = 60;
                    const dLat = metersToLat((Math.random() - 0.5) * step * 2);
                    const dLng = metersToLng((Math.random() - 0.5) * step * 2, pos.lat);
                    return {
                        lat: pos.lat + dLat,
                        lng: pos.lng + dLng
                    };
                }

                function pinColor(status) {
                    if (status === 'Activo') return '#28a745';
                    if (status === 'En mantenimiento') return '#e67e22';
                    return '#e74c3c';
                }

                window.initMap = function() {
                    // Centro inicial: primer centro de la lista
                    const map = new google.maps.Map(document.getElementById('map'), {
                        center: CENTERS[0],
                        zoom: 13,
                    });

                    const markers = [];

                    (UNIDADES || []).forEach(u => {
                        // Para cada unidad elegimos un centro cercano distinto
                        const baseCenter = randomCenter();
                        const pos = randomAround(baseCenter);

                        const svgMarker = {
                            path: "M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z",
                            fillColor: pinColor(u.status),
                            fillOpacity: 1,
                            strokeColor: "#333",
                            strokeWeight: 1,
                            scale: 1.6,
                            anchor: new google.maps.Point(12, 22),
                        };

                        const marker = new google.maps.Marker({
                            position: pos,
                            map,
                            icon: svgMarker,
                            title: `${u.placas} · ${u.marca} ${u.modelo}`,
                        });

                        const info = new google.maps.InfoWindow({
                            content: `
                    <div style="font-family:Arial,sans-serif;">
                        <strong>${u.placas}</strong><br>
                        ${u.marca} ${u.modelo}<br>
                        <small>Estatus: <b>${u.status}</b></small>
                    </div>
                `
                        });

                        marker.addListener('click', () => info.open({
                            anchor: marker,
                            map
                        }));

                        // Simulación de movimiento
                        setInterval(() => {
                            const next = jitter(marker.getPosition().toJSON());
                            marker.setPosition(next);
                        }, 3000);

                        markers.push(marker);
                    });

                    if (markers.length === 0) {
                        new google.maps.InfoWindow({
                            content: '<div style="font-family:Arial">Sin unidades para mostrar (todas están en baja).</div>',
                            position: CENTERS[0]
                        }).open(map);
                    }
                };
            </script>





            <script
                src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps_js_key') }}&callback=initMap&v=weekly"
                async defer>
            </script>
        </div>

        <!-- Corrige la ruta del script del menú -->
        <script src="{{ asset('js/Anim_Menu.js') }}"></script>

</body>

</html>
