<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Estaciones - Sistema Integral de Gestión</title>

    {{-- CSS específico de Estaciones --}}
    <link rel="stylesheet" href="{{ asset('css/style_Estaciones.css') }}">
</head>

<body>
    {{-- HEADER PRINCIPAL (igual estilo que Unidades) --}}
    <header class="header-container">
        <div class="header-content">
            <div class="logo-and-text">
                <div class="logo-placeholder"></div>
                <div class="text-group">
                    <h1 class="main-title">Sistema integral de gestion</h1>
                    <p class="subtitle">Control de Personal y Asistencia</p>
                </div>
            </div>

            <div class="header-right">
                <div class="user-info">
                    <span class="user-role"> Bienvenido, {{ Auth::user() -> nombres ?? 'Invitado' }} </span>
                    <div class="user-icon"></div>
                </div>

                <button class="menu-btn" id="menuBtn" aria-label="Menú">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </header>

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

    {{-- CONTENIDO PRINCIPAL --}}
    <main class="main-content">
        <section class="section-wrapper">
            <header class="section-header">
                <div>
                    <h2 class="page-title">Control de Estaciones</h2>
                    <p class="page-subtitle">Listado general de estaciones registradas</p>
                </div>

                <button class="new-station-button" id="btnNuevaEstacion">
                    + Agregar Estación
                </button>
            </header>

            {{-- Barra de búsqueda centrada --}}
            <form action="{{ route('estaciones.index') }}" method="GET" class="search-form">
                <input
                    type="text"
                    name="busqueda"
                    value="{{ request('busqueda') }}"
                    placeholder="Buscar estación por nombre, estado, ciudad, colonia o calle..."
                    class="search-input">
                <button class="search-btn">Buscar</button>

            </form>

            {{-- Tabla de estaciones --}}
            <div class="table-container">
                <table class="stations-table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Ciudad</th>
                            <th>Colonia</th>
                            <th>Calle</th>
                            <th>Número Exterior</th>
                            <th>Personal Requerido</th>
                            <th>Tipo</th>
                            <th>Descripción</th>
                            <th>Status</th>
                            <th class="actions-header">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($estaciones as $estacion)
                        <tr>
                            <td>{{ $estacion->nombre_estacion }}</td>
                            <td>{{ $estacion->estado }}</td>
                            <td>{{ $estacion->ciudad }}</td>
                            <td>{{ $estacion->colonia }}</td>
                            <td>{{ $estacion->calle }}</td>
                            <td>{{ $estacion->n_exterior }}</td>
                            <td>{{ $estacion->p_requerido }}</td>
                            <td>{{ $estacion->tipo }}</td>
                            <td>{{ $estacion->descripcion }}</td>
                            <td>{{ $estacion->status }}</td>
                            <td class="actions-cell">
                                <button
                                    class="btn-modificar"
                                    data-id="{{ $estacion->id_estacion }}"
                                    data-nombre="{{ $estacion->nombre_estacion }}"
                                    data-estado="{{ $estacion->estado }}"
                                    data-ciudad="{{ $estacion->ciudad }}"
                                    data-colonia="{{ $estacion->colonia }}"
                                    data-calle="{{ $estacion->calle }}"
                                    data-n_exterior="{{ $estacion->n_exterior }}"
                                    data-p_requerido="{{ $estacion->p_requerido }}"
                                    data-tipo="{{ $estacion->tipo }}"
                                    data-descripcion="{{ $estacion->descripcion }}"
                                    data-status="{{ $estacion->status }}">
                                    MODIFICAR
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11" class="empty-row">
                                No hay estaciones registradas.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINACIÓN --}}
            @if($estaciones->hasPages())
            <div class="pagination-wrapper">
                <div class="pagination-info">
                    Mostrando página {{ $estaciones->currentPage() }}
                    de {{ $estaciones->lastPage() }}
                    ( Total: {{ $estaciones->total() }} registros )
                </div>

                <div class="pagination-links">
                    {{ $estaciones->onEachSide(1)->links('pagination::simple-tailwind') }}
                </div>
            </div>
            @endif
        </section>
    </main>

    {{-- Scripts --}}
    <script src="{{ asset('js/Anim_Menu.js') }}"></script>
    <script>
        // Botón Nueva Estación
        document.getElementById('btnNuevaEstacion').addEventListener('click', function() {
            window.location.href = "{{ route('estaciones.create') }}";
        });

        // Redirección a editar
        document.querySelectorAll('.btn-modificar').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.dataset.id;
                const url = "{{ route('estaciones.edit', ['id' => ':id']) }}".replace(':id', id);
                window.location.href = url;
            });
        });
    </script>
</body>

</html>
