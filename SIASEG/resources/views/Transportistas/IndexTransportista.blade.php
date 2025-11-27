<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Empleado</title>
    <link rel="stylesheet" href="{{ asset('css/style_Empleados_Conductores.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="top-bar"></div>

<<<<<<< HEAD
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Inicio de Empleado</title>
      <link rel="stylesheet" href="{{ asset('css/style_Empleados_Conductores.css') }}">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>

    <body>
      <div class="top-bar"></div>

      <main class="main-content">
=======
    <main class="main-content">
>>>>>>> RegistroAsistencia
        <div class="page-container">
            <header class="content-header">
                <h1 class="header-title">Inicio</h1>
                <div class="header-info">
                    <span class="date">{{ now()->locale('es')->isoFormat('dddd, D [de] MMMM [del] YYYY') }}</span>
                    <span class="time" id="liveClock"></span>

                    <span class="notification-icon" id="notification-icon">
                        <span class="material-icons">notifications</span>
                    </span>
                </div>
            </header>

            <section class="progress-section">
                <h2 class="section-title">Progreso de asistencia</h2>
                <div class="progress-bar">
                    <div class="progress-circle {{ $progreso >= 50 ? 'completed' : '' }}"></div>
                    <div class="progress-line {{ $progreso >= 50 ? 'completed' : '' }}"></div>

                    <div class="progress-circle {{ $progreso == 100 ? 'completed' : '' }}"></div>
                    <div class="progress-line {{ $progreso == 100 ? 'completed' : '' }}"></div>

                    <div class="progress-circle {{ $progreso == 100 ? 'completed' : '' }}"></div>
                </div>
                <p>Progreso: {{ $progreso }}%</p>
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
                    @php
                        $apellidos = explode(' ', $empleado->apellidos);
                    @endphp
                    <div class="table-row">
                        <div class="employee-number-cell">
                            <div class="avatar"></div>
                            <span>{{ $empleado->no_empleado }}</span>
                        </div>
                         <span>{{ $apellidos[0] ?? '' }}</span>
                        <span>{{ $apellidos[1] ?? '' }}</span>
                        <span>{{ $empleado->nombres }}</span>
                    </div>
                </div>
            </section>

            <section class="info-cards-section">
                <div class="card card-gray">
                    <div class="card-header">
                        <span class="material-icons">place</span>
                        <h3>Estación asignada</h3>
                    </div>
                    <p>{{ $empleado->estacion_asignada ?? '---' }}</p>
                </div>
                <div class="card card-green">
                    <div class="card-header">
                        <span class="material-icons">schedule</span>
                        <h3>Hora de entrada</h3>
                    </div>
                    <p>{{ $asistencia->hora_entrada ?? '---' }}</p>
                </div>
                <div class="card card-white">
                    <div class="card-header">
                        <span class="material-icons">schedule</span>
                        <h3>Hora de salida</h3>
                    </div>
                    <p>{{ $asistencia->hora_salida ?? '---' }}</p>
                </div>
                <div class="card card-orange">
                    <div class="card-header">
                        <span class="material-icons">route</span>
                        <h3>Ruta asignada</h3>
                    </div>
                    <p>{{ $empleado->ruta_asignada ?? '---' }}</p>
                    <button class="start-route-btn" onclick="abrirModal()">Iniciar Ruta</button>
                </div>
            </section>
        </div>
    </main>

    <!-- Panel lateral de notificaciones -->
    <div id="notification-panel" class="notification-panel">
        <span class="close-panel" onclick="cerrarPanel()">&times;</span>
        <h3>Notificaciones</h3>
        <!-- Aquí puedes hacer un foreach si tienes notificaciones dinámicas -->
        <div class="notification-item leve">
            <span class="material-icons">check_circle</span>
            <div>
                <h4>Recordatorio de Ruta</h4>
                <p>No olvides revisar el vehículo antes de iniciar la ruta asignada.</p>
            </div>
        </div>
    </div>

    <!-- Modal para el formulario -->
    <div id="modalCard" class="modal">
        <div class="modal-content">

        <span class="close" onclick="cerrarModal()">&times;</span>

        <div id="modal-body">
            <iframe id="iframeRuta" src="" width="100%" height="600px" style="border: none;"></iframe>
        </div>

        </div>
    </div>

      <script src="{{ asset('js/Anim_Ruta_T.js') }}"></script>
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

        document.addEventListener('click', function(event) {
            if (!notificationPanel.contains(event.target) && !notificationIcon.contains(event.target)) {
                notificationPanel.classList.remove('open');
            }
        });
      </script>
      <script>
    // CORRECCIÓN AQUÍ: Usamos la ruta de VER (GET), no la de INICIAR (POST)
    const urlRuta = "{{ route('viajes.iniciar') }}";

    function abrirModal() {
        const modal = document.getElementById('modalCard');
        const iframe = document.getElementById('iframeRuta'); // Ahora sí lo encontrará

        // Cargamos la ruta
        iframe.src = urlRuta;

        // Mostramos el modal
        modal.style.display = "block";
    }

    function cerrarModal() {
        const modal = document.getElementById('modalCard');
        const iframe = document.getElementById('iframeRuta');

        modal.style.display = "none";
        iframe.src = ""; // Limpiamos para que no se quede cargado
    }

    window.onclick = function(event) {
        const modal = document.getElementById('modalCard');
        if (event.target == modal) {
            cerrarModal();
        }
    }
</script>
    </body>

    </html>

