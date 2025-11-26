<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Viajes - Sistema Integral</title>

    <link rel="stylesheet" href="{{ asset('css/style_Personal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.AgregarRuta.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style_Menu.css') }}">
</head>
<body>

    <header class="header-container">
        <div class="header-content">
            <div class="logo-and-text">
                <div class="logo-placeholder"></div>
                <div class="text-group">
                    <h1 class="main-title">Sistema Integral de Gestión</h1>
                </div>
            </div>

            <div class="user-info">
                <span class="user-role">Admin Usuario</span>
                <div class="user-icon"></div>
            </div>
        </div>
    </header>

    <div class="menu-trigger-container">
        <button class="menu-btn-floating" id="menuBtn">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>

    <div class="overlay" id="overlay"></div>
    <div class="menu-container" id="menuContainer">
        <div class="menu-header">
            <div class="arrow" id="closeMenu">→</div>
            <h2>Menú</h2>
        </div>
        <div class="menu-items">
            <div class="menu-item" onclick="window.location.href='{{ url('/dashboard') }}'">
                <div class="icon dashboard">
                    <svg viewBox="0 0 24 24"><rect class="square1" x="3" y="3" width="8" height="8" /><rect class="square2" x="13" y="3" width="8" height="8" /><rect class="square2" x="3" y="13" width="8" height="8" /><rect class="square1" x="13" y="13" width="8" height="8" /></svg>
                </div>
                <span>Dashboard</span>
            </div>
            </div>
        <button class="logout-btn" id="logoutBtn">Cerrar Sesión</button>
    </div>


    <div class="main-content">

        <div class="top-bar">
            <div class="title-group">
                <h2 class="page-title"> Gestión de Viajes</h2>
                <p class="page-subtitle">Historial y asignación de rutas</p>
            </div>

            <a href="{{ route('viajes.create') }}">
                <button class="new-station-button" id="btnNuevoViaje">
                Asignar Nuevo Viaje
            </button>
            </a>
        </div>

        <div class="table-container">

            <div class="search-bar" style="margin-bottom: 20px; display: flex; justify-content: center; width: 100%;">
                <form action="{{ route('viajes.index') }}" method="GET" style="display: flex; width: 100%; max-width: 800px; gap: 10px;">
                    <input type="text" name="busqueda" placeholder="🔍 Buscar por chofer o ruta..."
                        value="{{ request('busqueda') }}"
                        style="flex: 1; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">

                    <button type="submit" style="padding: 10px 25px; border: none; background: #0d284e; color: white; border-radius: 5px; cursor: pointer; font-weight: bold;">
                        Buscar
                    </button>

                    @if(request('busqueda'))
                        <a href="{{ route('viajes.index') }}" style="padding: 10px 20px; text-decoration: none; background: #7D848C; color: white; border-radius: 5px; display: flex; align-items: center;">
                            Limpiar
                        </a>
                    @endif
                </form>
            </div>

            <table class="personnel-table">
                <thead>
                    <tr>
                        <th>Chofer</th>
                        <th>Unidad</th>
                        <th>Ruta / Destino</th>
                        <th style="text-align: center;">Fecha Salida</th>
                        <th style="text-align: center;">Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($viajes as $viaje)
                        <tr>
                            <td>
                                <strong>{{ $viaje->empleado->nombres }} {{ $viaje->empleado->apellidos }}</strong><br>
                                <span style="font-size: 12px; color: #777;">No. Empleado: {{ $viaje->empleado->no_empleado }}</span>
                            </td>

                            <td>
                                <strong>{{ $viaje->transporte->placas }}</strong><br>
                                <span style="font-size: 12px; color: #555;">{{ $viaje->transporte->marca }} {{ $viaje->transporte->modelo }}</span>
                            </td>

                            <td>
                                <span style="color: #0d284e; font-weight: bold;">{{ $viaje->ruta->nombre }}</span><br>
                                <small style="color: #666;">Destino: {{ $viaje->ruta->destino }}</small>
                            </td>

                            <td style="text-align: center;">
                                {{ \Carbon\Carbon::parse($viaje->fecha_programada)->format('d/m/Y') }}
                            </td>

                            <td style="text-align: center;">
                                @if($viaje->estado == 'pendiente')
                                    <span class="status-badge status-pending"> Pendiente</span>
                                @elseif($viaje->estado == 'en_curso')
                                    <span class="status-badge status-active">En Curso</span>
                                @elseif($viaje->estado == 'finalizado')
                                    <span class="status-badge status-finished"> Finalizado</span>
                                @elseif($viaje->estado == 'cancelado')
                                    <span class="status-badge status-cancelled"> Cancelado</span>
                                @endif
                            </td>

                            <td class="actions-cell">
                                @if(in_array($viaje->estado, ['pendiente', 'en_curso']))
                                    {{-- <button class="action-button modify-button"
                                            onclick="window.location.href='{{ route('viajes.edit', $viaje->id_viaje) }}'">
                                        Modificar
                                    </button> --}}
                                @else
                                    <span style="font-size: 12px; font-style: italic; color: #999; padding-left: 10px;">-- Cerrado --</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center; padding: 40px; color: #777;">
                                No se encontraron viajes registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="pagination-container" style="margin-top: 20px; margin-bottom: 20px;">
                <div style="margin-bottom: 10px; font-size: 13px; color: #666; text-align: center;">
                    Página {{ $viajes->currentPage() }} de {{ $viajes->lastPage() }}
                </div>
                <div class="pagination-wrapper">
                    {{ $viajes->appends(['busqueda' => request('busqueda')])->links('pagination::simple-tailwind') }}
                </div>
            </div>

        </div>
    </div>

    <script src="{{ asset('js/Anim_Menu.js') }}"></script>
    <script>
        // Redirigir botón Nuevo Viaje
        const btnNuevo = document.getElementById('btnNuevoViaje');
        if(btnNuevo) {
            btnNuevo.addEventListener('click', function() {
                window.location.href = "{{ route('viajes.create') }}";
            });
        }

        // Lógica del menú
        const menuBtn = document.getElementById('menuBtn');
        const menuContainer = document.getElementById('menuContainer');
        const overlay = document.getElementById('overlay');
        const closeMenu = document.getElementById('closeMenu');

        function toggleMenu() {
            if(menuBtn) menuBtn.classList.toggle('active');
            if(menuContainer) menuContainer.classList.toggle('active');
            if(overlay) overlay.classList.toggle('active');
        }

        if(menuBtn) menuBtn.addEventListener('click', toggleMenu);
        if(closeMenu) closeMenu.addEventListener('click', toggleMenu);
        if(overlay) overlay.addEventListener('click', toggleMenu);
    </script>
</body>
</html>
