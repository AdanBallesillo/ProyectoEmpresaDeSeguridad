    <!DOCTYPE html>
    <html lang="es">

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Inicio de Empleado</title>
      <link rel="stylesheet" href="../Estilos/style_Empleados_Conductores.css">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>

    <body>
      <div class="top-bar"></div>

      <main class="main-content">
        <div class="page-container">
          <header class="content-header">
            <h1 class="header-title">Inicio</h1>
            <div class="header-info">
              <span class="date">Lunes, 24 de Septiembre del 2025</span>
              <span class="time">11:20:23</span>
              <span class="notification-icon" id="notification-icon">
                <span class="material-icons">notifications</span>
              </span>
            </div>
          </header>

          <section class="progress-section">
            <h2 class="section-title">Progreso de asistencia</h2>
            <div class="progress-bar">
              <div class="progress-circle start"></div>
              <div class="progress-line"></div>
              <div class="progress-circle current"></div>
              <div class="progress-line"></div>
              <div class="progress-circle end"></div>
            </div>
          </section>

          <section class="personal-data-section">
            <h2 class="section-title">Datos personales</h2>
            <div class="data-table">
              <div class="table-header">
                <span class="header-item">No. empleado</span>
                <span class="header-item">Apellido paterno</span>
                <span class="header-item">Apellido materno</span>
                <span class="header-item">Nombre(s)</span>
              </div>
              <div class="table-row">
                <div class="employee-number-cell">
                  <div class="avatar"></div>
                  <span>220110353</span>
                </div>
                <span>López</span>
                <span>Chavez</span>
                <span>Juan De Dios</span>
              </div>
            </div>
          </section>

          <section class="info-cards-section">
            <div class="card card-gray">
              <div class="card-header">
                <span class="material-icons">place</span>
                <h3>Estación asignada</h3>
              </div>
              <p>Estación sur</p>
            </div>
            <div class="card card-green">
              <div class="card-header">
                <span class="material-icons">schedule</span>
                <h3>Hora de entrada</h3>
              </div>
              <p>07:00 A.M.</p>
            </div>
            <div class="card card-white">
              <div class="card-header">
                <span class="material-icons">schedule</span>
                <h3>Hora de salida</h3>
              </div>
              <p>5:30 P.M.</p>
            </div>
            <div class="card card-orange">
              <div class="card-header">
                <span class="material-icons">route</span>
                <h3>Ruta asignada</h3>
              </div>
              <p>Calle 12</p>
              <button class="start-route-btn" onclick="abrirModal()">Iniciar Ruta</button>

            </div>
          </section>
        </div>
      </main>

      <!-- Panel lateral de notificaciones -->
      <div id="notification-panel" class="notification-panel">
        <span class="close-panel" onclick="cerrarPanel()">&times;</span>
        <h3>Notificaciones</h3>
        <div class="notification-item leve">
          <span class="material-icons">check_circle</span>
          <div>
            <h4>Recordatorio de Ruta</h4>
            <p>No olvides revisar el vehículo antes de iniciar la ruta asignada en Calle 12.</p>
          </div>
        </div>
        <div class="notification-item grave">
          <span class="material-icons">warning</span>
          <div>
            <h4>Actualización de Horario</h4>
            <p>Tu hora de salida ha sido cambiada a 5:45 P.M. por mantenimiento en la estación.</p>
          </div>
        </div>
        <div class="notification-item leve">
          <span class="material-icons">check_circle</span>
          <div>
            <h4>Capacitación Obligatoria</h4>
            <p>Tienes una sesión de capacitación en seguridad programada para mañana a las 9:00 A.M.</p>
          </div>
        </div>
        <div class="notification-item grave">
          <span class="material-icons">warning</span>
          <div>
            <h4>Reporte de Asistencia</h4>
            <p>Tu progreso de asistencia está al 75%. Completa la jornada para alcanzar el 100%.</p>
          </div>
        </div>
      </div>

      <!-- Modal para el formulario -->
      <div id="modalCard" class="modal">
        <div class="modal-content">
          <span class="close" onclick="cerrarModal()">&times;</span>
          <!-- Aquí inyectaremos el contenido de card.blade.php -->
          <div id="modal-body"></div>
        </div>
      </div>

      <script src="../Java/Anim_Ruta.js"></script>
      <script>
        // Funcionalidad para abrir/cerrar el panel de notificaciones
        const notificationIcon = document.getElementById('notification-icon');
        const notificationPanel = document.getElementById('notification-panel');

        notificationIcon.addEventListener('click', function() {
          notificationPanel.classList.toggle('open');
        });

        function cerrarPanel() {
          notificationPanel.classList.remove('open');
        }

        // Cerrar el panel al hacer clic fuera de él
        document.addEventListener('click', function(event) {
          if (!notificationPanel.contains(event.target) && !notificationIcon.contains(event.target)) {
            notificationPanel.classList.remove('open');
          }
        });
      </script>
    </body>

    </html>