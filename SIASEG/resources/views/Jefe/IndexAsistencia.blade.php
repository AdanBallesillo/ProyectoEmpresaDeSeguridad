<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Asistencia</title>
    <link rel="stylesheet" href="{{ asset('css/style_Asistencia.css') }}">
    <link rel="stylesheet" href="{{ asset('js/Anim_Menu.js') }}">
</head>
<body>
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

    <main class="main-content">
        <h1 class="page-title">Control de Asistencia</h1>
        <p class="page-subtitle">Registro de Asistencia del personal</p>

        <section class="dashboard-grid">
            <div class="attendance-table-container card">
                <h2 class="section-title">Asistencia</h2>
                <div class="attendance-table">
                    <div class="table-header">
                        <span class="header-item">Empleado</span>
                        <span class="header-item">Estación</span>
                        <span class="header-item">Hora</span>
                        <span class="header-item">Asistencia</span>
                    </div>
                    <div class="table-row">
                        <span class="row-item">Osvaldo Flaco Gallegos</span>
                        <span class="row-item">Central</span>
                        <span class="row-item">07:55</span>
                        <span class="row-item status-punctual">Puntual</span>
                    </div>
                    <div class="table-row">
                        <span class="row-item">Emiliano Villa Hernandez Martinez</span>
                        <span class="row-item">Central</span>
                        <span class="row-item">08:10</span>
                        <span class="row-item status-absent">Retardo</span>
                    </div>
                </div>
            </div>

            <div class="top-lists-container">
                <div class="top-list card">
                    <h2 class="section-title">TOP 10 Asistencia</h2>
                    <div class="list-item">
                        <div class="ranking-number rank-1">1</div>
                        <div class="user-avatar user-1"></div>
                        <span class="user-name">Osvaldo Flaco</span>
                    </div>
                </div>

                <div class="top-list card">
                    <h2 class="section-title">TOP 10 Inasistencia</h2>
                    <div class="list-item">
                        <div class="ranking-number rank-red-1">1</div>
                        <div class="user-avatar user-4"></div>
                        <span class="user-name">Pancracio Villa</span>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="{{ asset('js/Anim_Menu.js') }}"></script>
</body>
</html>
