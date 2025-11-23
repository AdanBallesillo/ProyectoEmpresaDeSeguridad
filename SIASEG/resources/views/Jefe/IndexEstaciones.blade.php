<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset ('css/style_Estaciones.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/style_Menu.css') }}">
    <title>Sistema de Gestión de Personal</title>
</head>
<body>
    <!-- Encabezado -->
    <header class="header-container" style="position: relative">
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

            <!-- SUBHEADER -->
            <div class="sub-header">
                <button class="menu-btn" id="menuBtn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </header>

    {{-- En caso de errores, descomentar el siguiente codigo y quitar el que esta arriba --}}
    <!-- SUBHEADER -->
    {{-- <div class="sub-header">
        <button class="menu-btn" id="menuBtn">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div> --}}

    <!-- OVERLAY -->
    <div class="overlay" id="overlay"></div>

        <!-- Transición entre páginas -->
    <div id="page-transition"></div>

    <!-- Fondo oscuro del menú -->
    <div class="overlay" id="overlay"></div>

    <!-- MENÚ HAMBURGUESA -->
    <div class="menu-container" id="menuContainer">
      <div class="menu-header">
        <div class="arrow" id="closeMenu">→</div>
        <h2>Menú</h2>
      </div>

      <div class="menu-items">
        <div class="menu-item" data-link="../Formularios/Frm_Dashboard.php">
          <div class="icon dashboard">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <rect class="square1" x="3" y="3" width="8" height="8" />
              <rect class="square2" x="13" y="3" width="8" height="8" />
              <rect class="square2" x="3" y="13" width="8" height="8" />
              <rect class="square1" x="13" y="13" width="8" height="8" />
            </svg>
          </div>
          <span>Dashboard</span>
        </div>

        <div class="menu-item" data-link="../Formularios/Frm_Asistencia.php">
          <div class="icon">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <circle
                cx="12"
                cy="12"
                r="10"
                fill="none"
                stroke="#FF8B00"
                stroke-width="2"
              />
              <polyline
                points="12,6 12,12 16,14"
                fill="none"
                stroke="#FF8B00"
                stroke-width="2"
                stroke-linecap="round"
              />
            </svg>
          </div>
          <span>Asistencia</span>
        </div>

        <div class="menu-item" data-link="../Formularios/Frm_VistaPersonal.php">
          <div class="icon">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <circle cx="12" cy="7" r="4" />
              <path d="M5,21 C5,16.5 8,14 12,14 C16,14 19,16.5 19,21" />
            </svg>
          </div>
          <span>Personal</span>
        </div>

        <div class="menu-item" data-link="../Formularios/Frm_estaciones.html">
          <div class="icon">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M12 2L2 7v3c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"
              />
              <path
                d="M12 7c-2.21 0-4 1.79-4 4h2c0-1.1.9-2 2-2s2 .9 2 2c0 2-3 1.75-3 5h2c0-2.25 3-2.5 3-5 0-2.21-1.79-4-4-4z"
                fill="#7D848C"
              />
              <circle cx="12" cy="17" r="1" fill="#7D848C" />
            </svg>
          </div>
          <span>Estaciones</span>
        </div>

        <div class="menu-item" data-link="unidades.html">
          <div class="icon">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4z"
              />
              <circle cx="6" cy="17" r="2" fill="#7D848C" />
              <circle cx="18" cy="17" r="2" fill="#7D848C" />
              <path d="M17 8V4l3 4h-3z" fill="#7D848C" />
            </svg>
          </div>
          <span>Unidades</span>
        </div>

        <div class="menu-item" data-link="../Formularios/Frm_VistaReportes.php">
          <div class="icon">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <rect x="5" y="4" width="14" height="17" rx="1" />
              <line
                x1="9"
                y1="8"
                x2="15"
                y2="8"
                stroke="#7D848C"
                stroke-width="1.5"
              />
              <line
                x1="9"
                y1="12"
                x2="15"
                y2="12"
                stroke="#7D848C"
                stroke-width="1.5"
              />
              <line
                x1="9"
                y1="16"
                x2="13"
                y2="16"
                stroke="#7D848C"
                stroke-width="1.5"
              />
            </svg>
          </div>
          <span>Reportes</span>
        </div>
      </div>

      <button class="logout-btn" id="logoutBtn">Cerrar Sesión</button>
    </div>

    <!-- Contenido principal -->
    <div class="main-content">
        <div class="top-bar">
            <div class="title-group">
                <h2 class="page-title">Control de Estaciones</h2>
                <p class="page-subtitle">Lista de estaciones actuales</p>
            </div>
            <button class="new-station-button" id="btnNuevaEstacion"> Agregar Estacion</button>
        </div>

        <div class="table-container">
            <!-- Barra de búsqueda -->
            <div class="search-bar" style="margin-bottom: 20px; display: flex; justify-content: center; width: 100%; ">
                <form action="{{ route('estaciones.index') }}" method="GET" style="display: flex; width: 100%; max width: 700px; gap: 10px;">
                    <input type="text" name="busqueda" placeholder="Buscar estacion..."
                        value="{{ request('busqueda') }}"
                        style="flex: 1; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
                    <button type="submit" style="padding: 10px 20px; border: none; background: #FF8B00; color: white; border-radius: 5px;">
                        Buscar
                    </button>
                </form>
            </div>

            <table class="stations-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Ciudad</th>
                        <th>Colonia</th>
                        <th>Calle</th>
                        <th>Numero Exterior</th>
                        <th>Personal Requerido</th>
                        <th>Codigo Postal</th>
                        <th>Tipo</th>
                        <th>Descripcion</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($estaciones as $estacion)
                        <tr>
                            <td>{{ $estacion->nombre_estacion }}</td>
                            <td>{{ $estacion->estado }}</td>
                            <td>{{ $estacion->ciudad }}</td>
                            <td>{{ $estacion->colonia }}</td>
                            <td>{{ $estacion->calle }}</td>
                            <td>{{ $estacion->n_exterior }}</td>
                            <td>{{ $estacion->p_requerido}}</td>
                            <td>{{ $estacion->codigo_estacion}}</td>
                            <td>{{ $estacion->tipo}}</td>
                            <td>{{ $estacion->descripcion}}</td>
                            <td>{{ $estacion->status}}</td>
                            <td class="actions-cell">
                                <button class="action-button modify-button"
                                    data-id="{{ $estacion->id_estacion }}"
                                    data-nombre="{{ $estacion->nombre_estacion }}"
                                    data-estado="{{ $estacion->estado }}"
                                    data-ciudad="{{ $estacion->ciudad }}"
                                    data-colonia="{{ $estacion->colonia }}"
                                    data-calle="{{ $estacion->calle }}"
                                    data-n_exterior="{{ $estacion->n_exterior }}"
                                    data-p_requerido="{{ $estacion->p_requerido }}"
                                    data-codigo_postal="{{ $estacion->codigo_estacion }}"
                                    data-tipo="{{ $estacion->tipo }}"
                                    data-descripcion="{{ $estacion->descripcion }}"
                                    data-status="{{ $estacion->status }}"
                                >Modificar</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;">No hay estaciones registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{-- Paginación --}}
            <div class="pagination-container" style="margin-top: 15px; margin-bottom: 10px;">
                <div style="margin-bottom: 5px; font-size: 14px; color: #555; text-align: center;">
                    Mostrando página {{ $estaciones->currentPage() }} de {{ $estaciones->lastPage() }}
                    ( Total: {{ $estaciones->total() }} registros )
                </div>

                <div class="pagination-container">
                    {{ $estaciones->onEachSide(1)->links('pagination::simple-tailwind') }}
                </div>
            </div>

        </div>
    </div>

    <!-- Scripts -->
    <script src="../Java/Anim_Menu.js"></script>
    <script>
        // Redirigir botón Nueva Estacion
        document.getElementById('btnNuevaEstacion').addEventListener('click', function() {
            window.location.href = "{{ route('estaciones.create') }}";
        });

        // Redirigir botones Modificar
        document.querySelectorAll('.modify-button').forEach(button => {
        button.addEventListener('click', () => {
            // le damos el id de la estacione a modificar
            const id = button.dataset.id;
            // construimos la url con el id hacia la vista de modificar
            const url = "{{ route('estaciones.edit', ['id' => ':id']) }}".replace(':id', id);
            window.location.href = url;
        });
    });
    </script>
</body>
</html>
