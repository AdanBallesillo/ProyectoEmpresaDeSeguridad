<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Principal</title>
    <link rel="stylesheet" href="{{ asset('css/style_Dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style_Menu.css') }}">

  </head>
  <body>
    <!-- HEADER PRINCIPAL -->
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
      <h2>Dashboard Principal</h2>
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
        <div class="menu-item" data-link="../Formularios/IndexDashboard.php">
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

        <div class="menu-item" data-link="../Formularios/IndexAsistencia.blade.php">
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

        <div class="menu-item" data-link="../Formularios/IndexPersonal.blade.php">
          <div class="icon">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <circle cx="12" cy="7" r="4" />
              <path d="M5,21 C5,16.5 8,14 12,14 C16,14 19,16.5 19,21" />
            </svg>
          </div>
          <span>Personal</span>
        </div>

        <div class="menu-item" data-link="../Formularios/IndexEstaciones.blade.php">
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

        <div class="menu-item" data-link="../Formularios/IndexUnidades.blade.php">
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

        <div class="menu-item" data-link="../Formularios/IndexReportes.blade.php">
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

    <!-- CONTENIDO PRINCIPAL -->
    <div class="main-content">
      <!-- COLUMNA IZQUIERDA -->
      <div class="left-column">
        <!-- ASISTENCIAS RECIENTES -->
        <div class="recent-card">
          <div class="card-header">
            <h3>Asistencias recientes de Hoy</h3>
            <a href="#" class="ver-todos">Ver Todos</a>
          </div>
          <div class="attendance-list">
            <!-- Los datos se cargarán desde el backend -->
            <div class="attendance-item">
              <div class="avatar-placeholder"></div>
              <div class="attendance-info">
                <div class="name"></div>
                <div class="station"></div>
              </div>
              <div class="time-badge">
                <span class="time"></span>
                <span class="status-badge"></span>
              </div>
            </div>
          </div>
        </div>

        <!-- ALERTAS Y NOTIFICACIONES -->
        <div class="alerts-card">
          <h3>Alertas y notificaciones</h3>
          <div class="alert-list">
            <div class="alert-item alert-error">
              <div class="alert-header">
                <span class="alert-title"></span>
                <svg
                  class="alert-icon"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                >
                  <path
                    d="M12 2 L22 20 L2 20 Z"
                    fill="none"
                    stroke="#8B0000"
                    stroke-width="2"
                  />
                  <line
                    x1="12"
                    y1="9"
                    x2="12"
                    y2="14"
                    stroke="#8B0000"
                    stroke-width="2"
                    stroke-linecap="round"
                  />
                  <circle cx="12" cy="17" r="1" fill="#8B0000" />
                </svg>
              </div>
              <p class="alert-message"></p>
            </div>

            <div class="alert-item alert-success">
              <div class="alert-header">
                <span class="alert-title"></span>
                <svg
                  class="alert-icon-check"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                >
                  <polyline
                    points="20,6 9,17 4,12"
                    fill="none"
                    stroke="#2d5016"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                </svg>
              </div>
              <p class="alert-message"></p>
            </div>
          </div>
        </div>
      </div>

      <!-- COLUMNA CENTRO -->
      <div class="center-column">
        <!-- PRESENTES HOY -->
        <div class="stat-card">
          <div class="stat-content">
            <span class="stat-label">Presentes Hoy</span>
            <div class="stat-number"></div>
          </div>
          <div class="stat-icon">
            <svg
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
              width="60"
              height="60"
            >
              <circle
                cx="12"
                cy="12"
                r="10"
                fill="none"
                stroke="#FF8B00"
                stroke-width="2"
              />
              <polyline
                points="7,12 10,16 17,8"
                fill="none"
                stroke="#FF8B00"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
          </div>
        </div>

        <!-- LLEGADAS TARDE -->
        <div class="stat-card">
          <div class="stat-content">
            <span class="stat-label">Llegadas Tarde</span>
            <div class="stat-number"></div>
          </div>
          <div class="stat-icon">
            <svg
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
              width="60"
              height="60"
            >
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
        </div>

        <!-- UNIDADES ACTIVAS -->
        <div class="stat-card">
          <div class="stat-content">
            <span class="stat-label">Unidades Activas</span>
            <div class="stat-number"></div>
          </div>
          <div class="stat-icon">
            <svg
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
              width="60"
              height="60"
            >
              <path
                d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4z"
                fill="#FF8B00"
              />
              <circle cx="6" cy="17" r="2" fill="#E0E0E0" />
              <circle cx="18" cy="17" r="2" fill="#E0E0E0" />
            </svg>
          </div>
        </div>
      </div>

      <!-- COLUMNA DERECHA -->
      <div class="right-column">
        <h3>Estado de estaciones</h3>

        <div class="station-status">
          <h4>Estacion central</h4>
          <span class="station-label">Personal</span>
          <div class="progress-container">
            <div class="progress-bar-wrapper">
              <div class="progress-bar-fill" style="width: 0%"></div>
              <div class="progress-handle" style="left: 0%"></div>
            </div>
            <span class="progress-ratio"></span>
          </div>
        </div>

        <div class="station-status">
          <h4>Estación norte</h4>
          <span class="station-label">Personal</span>
          <div class="progress-container">
            <div class="progress-bar-wrapper">
              <div class="progress-bar-fill" style="width: 0%"></div>
              <div class="progress-handle" style="left: 0%"></div>
            </div>
            <span class="progress-ratio"></span>
          </div>
        </div>

        <div class="station-status">
          <h4>Estación Sur</h4>
          <span class="station-label">Personal</span>
          <div class="progress-container">
            <div class="progress-bar-wrapper">
              <div class="progress-bar-fill" style="width: 0%"></div>
              <div class="progress-handle" style="left: 0%"></div>
            </div>
            <span class="progress-ratio"></span>
          </div>
        </div>
      </div>
    </div>

    <script src="{{ asset('js/Anim_Menu.js') }}"></script>
  </body>
</html>
