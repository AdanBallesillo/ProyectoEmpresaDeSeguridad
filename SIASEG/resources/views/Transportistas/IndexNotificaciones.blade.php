<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Notificaciones</title>
    <link rel="stylesheet" href="../Estilos/style_Notificaciones.css" />
  </head>
  <body>
    <div class="container">
      <div class="content">
        <!-- Icono de campanita -->
        <div class="bell" onclick="toggleNotifications()">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="26"
            height="26"
            fill="none"
            stroke="black"
            stroke-width="1.8"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="icon"
          >
            <path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9" />
            <path d="M13.73 21a2 2 0 0 1-3.46 0" />
          </svg>
        </div>
      </div>

      <!-- Overlay -->
      <div id="overlay" class="overlay" onclick="toggleNotifications()"></div>

      <!-- Barra lateral -->
      <div id="notification-panel" class="panel">
        <div class="panel-header">
          <h2>Notificaciones</h2>
          <button class="close-btn" onclick="toggleNotifications()">✖</button>
        </div>

        <div class="notifications">
          <div class="notif red">
            <strong>Asignación de estación</strong><br />
            Cambio de ubicación de Sara Nome
          </div>

          <div class="notif red">
            <strong>Horarios nuevos</strong>
          </div>

          <div class="notif green">
            <strong>Eres candidato a próximo aumento</strong>
          </div>

          <div class="notif green">
            <strong>Suspensión de unidades</strong>
          </div>
        </div>
      </div>
    </div>

    <script>
      function toggleNotifications() {
        const panel = document.getElementById("notification-panel");
        const overlay = document.getElementById("overlay");
        panel.classList.toggle("open");
        overlay.classList.toggle("show");
        overlay.classList.toogle("close");
      }
    </script>
  </body>
</html>
