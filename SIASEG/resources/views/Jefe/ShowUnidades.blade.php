<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset ('css/style_Personal.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/style_Menu.css') }}">
    <title>Control de Unidades</title>
</head>

<body>

    <!-- HEADER -->
    <header class="header-container" style="position: relative;">
        <div class="header-content">
            <div class="logo-and-text">
                <div class="logo-placeholder"></div>
                <div class="text-group">
                    <h1 class="main-title">Sistema integral de gestión</h1>
                    <p class="subtitle">Control de Unidades</p>
                </div>
            </div>
            <div class="user-info">
                <span class="user-role"> Bienvenido, {{ Auth::user() -> nombres ?? 'Invitado' }} </span>
                <div class="user-icon"></div>
            </div>
        </div>
    </header>


    <!-- SUBHEADER -->
    <div class="sub-header" style="display: flex; justify-content: right; padding: 1rem;">
        <button class="menu-btn" id="menuBtn">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
    <div class="overlay" id="overlay"></div>
    <!-- Menú hamburguesa -->
<div class="menu-container" id="menuContainer">
      <div class="menu-header">
        <div class="arrow" id="closeMenu">→</div>
        <h2>Menú</h2>
      </div>

      <div class="menu-items">

        <a href="{{ route('dashboard.jefe') }}" class="menu-item" style="text-decoration: none; color: inherit;">
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

    <!-- CONTENIDO PRINCIPAL -->
    <div class="main-content">

        <div class="top-bar">
            <div class="title-group">
                <h2 class="page-title">Control de Unidades</h2>
                <p class="page-subtitle">Listado general de unidades registradas</p>
            </div>

            <button class="new-employee-button" id="btnNuevaUnidad">Nueva Unidad</button>
        </div>



        <!-- Barra de búsqueda -->
        <div class="search-bar" style="margin-bottom: 20px;  display: flex; justify-content: center; width: 100%; ">
            <form action="{{ route('mostrartodasunidades') }}" method="GET" style="display: flex; width: 100%; max-width: 700px; gap: 10px;">
                <input type="text" name="busqueda" placeholder="Buscar unidad..."
                    value="{{ request('busqueda') }}"
                    style="flex: 1; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
                <button type="submit" style="padding: 10px 20px; border: none; background: #FF8B00; color: white; border-radius: 5px;">
                    Buscar
                </button>
            </form>
        </div>

        <!-- Tabla -->
        <div class="table-container">
            <table class="personnel-table">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Placas</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Año</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($unidades as $u)
                    <tr>
                        <td>{{ $u->tipo }}</td>
                        <td>{{ $u->placas }}</td>
                        <td>{{ $u->marca }}</td>
                        <td>{{ $u->modelo }}</td>
                        <td>{{ $u->anio }}</td>
                        <td>{{ $u->status }}</td>

                        <td class="actions-cell">
                            <button class="action-button modify-button"
                                data-id="{{ $u->id_transporte }}">
                                Modificar
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align:center;">No hay unidades registradas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Paginación --}}
            <div class="pagination-container" style="margin-top: 15px; text-align:center; margin-bottom: 10px;">
                <div style="margin-bottom: 5px; margin-left: 5px; font-size: 14px; color: #555;">
                    Mostrando página {{ $unidades->currentPage() }} de {{ $unidades->lastPage() }}
                    ( Total: {{ $unidades->total() }} registros )
                </div>

                {{ $unidades->appends(['busqueda' => request('busqueda')])->onEachSide(1)->links('pagination::simple-tailwind') }}
            </div>
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/Anim_Menu.js') }}"></script>

    <script>
        // Redirigir a crear nueva unidad
        document.getElementById('btnNuevaUnidad').addEventListener('click', function() {
            window.location.href = "{{ route('nuevasunidades') }}";
        });

        // Botón modificar
        document.querySelectorAll('.modify-button').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.dataset.id;
                const url = "{{ route('unidades.edit', ['id' => ':id']) }}".replace(':id', id);
                window.location.href = url;
            });
        });
    </script>

</body>

</html>
