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
                   <span class="user-role"> Bienvenido, {{ Auth::user() -> nombres ?? 'Invitado' }} </span>
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

   <!-- Fondo oscuro del menú -->
    <div class="overlay" id="overlay"></div>

    <!-- MENÚ HAMBURGUESA -->
    <div class="menu-container" id="menuContainer">
      <div class="menu-header">
        <div class="arrow" id="closeMenu">→</div>
        <h2>Menú</h2>
      </div>
            <a href="{{ route('dashboard.personal') }}" class="menu-item" style="text-decoration: none; color: inherit;">
          <div class="icon dashboard">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <rect class="square1" x="3" y="3" width="8" height="8" />
              <rect class="square2" x="13" y="3" width="8" height="8" />
              <rect class="square2" x="3" y="13" width="8" height="8" />
              <rect class="square1" x="13" y="13" width="8" height="8" />
            </svg>
          </div>
          <span>Dashboard</span>
        </a>

      <div class="menu-items">
        <a href="{{ route('dashboard.asistencia') }}" class="menu-item" style="text-decoration: none; color: inherit;">
          <div class="icon">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <circle cx="12" cy="12" r="10" fill="none" stroke="#FF8B00" stroke-width="2" />
              <polyline points="12,6 12,12 16,14" fill="none" stroke="#FF8B00" stroke-width="2" stroke-linecap="round" />
            </svg>
          </div>
          <span>Asistencia</span>
        </a>

        <a href="{{ route('dashboard.personal') }}" class="menu-item" style="text-decoration: none; color: inherit;">
          <div class="icon">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <circle cx="12" cy="7" r="4" />
              <path d="M5,21 C5,16.5 8,14 12,14 C16,14 19,16.5 19,21" />
            </svg>
          </div>
          <span>Personal</span>
        </a>

        <a href="{{ route('dashboard.estaciones') }}" class="menu-item" style="text-decoration: none; color: inherit;">
          <div class="icon">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M12 2L2 7v3c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z" />
              <path d="M12 7c-2.21 0-4 1.79-4 4h2c0-1.1.9-2 2-2s2 .9 2 2c0 2-3 1.75-3 5h2c0-2.25 3-2.5 3-5 0-2.21-1.79-4-4-4z" fill="#7D848C" />
              <circle cx="12" cy="17" r="1" fill="#7D848C" />
            </svg>
          </div>
          <span>Estaciones</span>
        </a>

        <a href="{{ route('dashboard.unidades') }}" class="menu-item" style="text-decoration: none; color: inherit;">
          <div class="icon">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4z" />
              <circle cx="6" cy="17" r="2" fill="#7D848C" />
              <circle cx="18" cy="17" r="2" fill="#7D848C" />
              <path d="M17 8V4l3 4h-3z" fill="#7D848C" />
            </svg>
          </div>
          <span>Unidades</span>
        </a>

        <a href="{{ route('dashboard.reportes') }}" class="menu-item" style="text-decoration: none; color: inherit;">
          <div class="icon">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <rect x="5" y="4" width="14" height="17" rx="1" />
              <line x1="9" y1="8" x2="15" y2="8" stroke="#7D848C" stroke-width="1.5" />
              <line x1="9" y1="12" x2="15" y2="12" stroke="#7D848C" stroke-width="1.5" />
              <line x1="9" y1="16" x2="13" y2="16" stroke="#7D848C" stroke-width="1.5" />
            </svg>
          </div>
          <span>Reportes</span>
        </a>
                <a href="{{ route('dashboard.rutas') }}" class="menu-item" style="text-decoration: none; color: inherit;">
  <div class="icon">
    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <rect x="5" y="4" width="14" height="17" rx="1" />
      <path d="M8 8 L11 11 L16 7 V16" stroke="#7D848C" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
  </div>
  <span>Rutas</span>
</a>


      </div>

      <a href="{{ route('Empleado.Logout') }}"><button class="logout-btn" id="logoutBtn">Cerrar Sesión</button></a>
    </div>

    <div class="main-content">

        <div class="top-bar">
            <div class="title-group">
                <h2 class="page-title"> Gestión de Viajes</h2>
                <p class="page-subtitle">Historial y asignación de rutas</p>
            </div>

            <a href="{{ route('viajes.create') }}">
                <button class="action-button modify-button" id="btnNuevoViaje">
                Asignar Nuevo Viaje
            </button>
            </a>
        </div>
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
        <div class="table-container">
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
                                    <button class="action-button modify-button"
                                            onclick="window.location.href='{{ route('viajes.edit', $viaje->id_viaje) }}'">
                                        Modificar
                                    </button>
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
