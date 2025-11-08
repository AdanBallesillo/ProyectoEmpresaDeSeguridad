<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset ('css/style_Personal.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/style_Menu.css') }}">
    <title>Sistema de Gestión de Personal</title>
</head>
<body>
    <!-- Encabezado -->
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
      <button class="menu-btn" id="menuBtn">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>

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
                <h2 class="page-title">Control de Personal</h2>
                <p class="page-subtitle">Monitoreo en tiempo real y redistribución del personal</p>
            </div>
            <button class="new-employee-button" id="btnNuevoEmpleado"> Nuevo Empleado</button>
        </div>

        <div class="table-container">

            <!-- Barra de búsqueda -->
            <div class="search-bar" style="margin-bottom: 20px;">
                <form action="{{ route('mostrarempleados') }}" method="GET">
                    <input type="text" name="busqueda" placeholder="Buscar empleado..."
                        value="{{ request('busqueda') }}"
                        style="padding: 8px; width: 250px; border-radius: 5px; border: 1px solid #ccc;">
                    <button type="submit" style="padding: 8px 15px; border: none; background: #FF8B00; color: white; border-radius: 5px;">
                        Buscar
                    </button>
                </form>
            </div>

            <table class="personnel-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>RFC</th>
                        <th>CURP</th>
                        <th>Numero de Emergencia</th>
                        <th>Correo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($empleados as $empleado)
                        <tr>
                            <td>{{ $empleado->nombres }} {{ $empleado->apellidos }}</td>
                            <td>{{ $empleado->RFC }}</td>
                            <td>{{ $empleado->CURP }}</td>
                            <td>{{ $empleado->telefono }}</td>
                            <td>{{ $empleado->correo }}</td>
                            <td class="actions-cell">
                                <button class="action-button modify-button"
                                    data-id="{{ $empleado->id_empleado }}"
                                    data-nombres="{{ $empleado->nombres }}"
                                    data-apellidos="{{ $empleado->apellidos }}"
                                    data-curp="{{ $empleado->CURP }}"
                                    data-rfc="{{ $empleado->RFC }}"
                                    data-telefono="{{ $empleado->telefono }}"
                                    data-rol="{{ $empleado->rol }}"
                                    data-correo="{{ $empleado->correo }}"
                                    data-foto="{{ $empleado->fotografia }}"
                                >Modificar</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;">No hay empleados registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{-- Paginación --}}
            <div class="pagination-container" style="margin-top: 15px; text-align:center; margin-bottom: 10px;">
                <div style="margin-bottom: 5px; margin-left: 5px; font-size: 14px; color: #555;">
                    Mostrando página {{ $empleados->currentPage() }} de {{ $empleados->lastPage() }}
                    ( Total: {{ $empleados->total() }} registros )
                </div>

                {{ $empleados->onEachSide(1)->links('pagination::simple-tailwind') }}
            </div>

        </div>
    </div>

    <!-- Scripts -->
    <script src="../Java/Anim_Menu.js"></script>
    <script>
        // Redirigir botón Nuevo Empleado
        document.getElementById('btnNuevoEmpleado').addEventListener('click', function() {
            window.location.href = "{{ route('crearempleado') }}";
        });

        // Redirigir botones Modificar
        document.querySelectorAll('.modify-button').forEach(button => {
        button.addEventListener('click', () => {
            // le damos el id del usuario a modificar
            const id = button.dataset.id;
            // construimos la url con el id hacia la vista de modificar
            const url = "{{ route('modificarempleadojefe', ['id' => ':id']) }}".replace(':id', id);
            window.location.href = url;
        });
    });
    </script>
</body>
</html>
