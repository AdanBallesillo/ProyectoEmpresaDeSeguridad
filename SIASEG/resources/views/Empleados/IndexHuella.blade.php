<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tomar Asistencia - Empleados</title>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <style>
    /* Reset básico */
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        background-color: #f4f6f9;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
        color: #333;
    }

    /* Contenedor tipo Tarjeta */
    .card-asistencia {
        background: white;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        text-align: center;
        width: 90%;
        max-width: 400px;
        position: relative;
    }

    h2 {
        color: #1e40af; /* Mismo azul corporativo */
        margin-bottom: 10px;
        font-size: 24px;
    }

    p.subtitle {
        color: #666;
        margin-bottom: 30px;
        font-size: 14px;
    }

    /* El botón de huella digital */
    .huella-btn {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: none;
        background: linear-gradient(145deg, #ffffff, #e6e6e6);
        box-shadow:  5px 5px 10px #d1d1d1, -5px -5px 10px #ffffff;
        color: #1e40af;
        font-size: 60px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 auto 20px auto;
        outline: none;
        position: relative;
    }

    .huella-btn:hover {
        transform: scale(1.05);
        color: #008cff;
    }

    .huella-btn:active {
        transform: scale(0.95);
        box-shadow: inset 5px 5px 10px #d1d1d1, inset -5px -5px 10px #ffffff;
    }

    /* Animación de escaneo */
    .scanning {
        animation: pulse-blue 1.5s infinite;
        color: #28a745 !important;
        pointer-events: none;
    }

    @keyframes pulse-blue {
        0% { box-shadow: 0 0 0 0 rgba(30, 64, 175, 0.4); }
        70% { box-shadow: 0 0 0 20px rgba(30, 64, 175, 0); }
        100% { box-shadow: 0 0 0 0 rgba(30, 64, 175, 0); }
    }

    /* Texto de estado */
    #status {
        font-size: 16px;
        margin-top: 10px;
        min-height: 24px;
        font-weight: 600;
        color: #555;
    }

    /* Botón del menú */
    .btn-menu {
        display: inline-block;
        margin-top: 30px;
        padding: 10px 20px;
        color: #888;
        text-decoration: none;
        font-size: 14px;
        transition: color 0.3s;
        border: 1px solid transparent;
    }
    .btn-menu:hover {
        color: #1e40af;
        text-decoration: underline;
    }

    /* Barras decorativas */
    .top-bar, .bottom-bar {
        position: fixed;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, #1e40af, #008cff);
        z-index: 100;
    }
    .top-bar { top: 0; }
    .bottom-bar { bottom: 0; }

  </style>
</head>

<body>

  <div class="top-bar"></div>

  <div class="card-asistencia">
    <h2>Control de Asistencia</h2>
    <p class="subtitle">Empleados: Presiona para registrar</p>

    <button id="btn-asistencia" class="huella-btn" aria-label="Registrar asistencia">
        <i class="fas fa-fingerprint"></i>
    </button>

    <p id="status">Esperando huella...</p>

    <a href="{{ route('Empleado.Menu') }}" class="btn-menu">
        <i class="fas fa-arrow-left"></i> Volver al menú
    </a>
  </div>

  <div class="bottom-bar"></div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const btnAsistencia = document.getElementById("btn-asistencia");
    const status = document.getElementById("status");

    btnAsistencia.addEventListener("click", () => {
        // 1. Feedback visual
        status.textContent = "Escaneando...";
        btnAsistencia.classList.add('scanning');
        btnAsistencia.disabled = true;

        // ESTA RUTA ESTÁ BIEN (Coincide con tu Route::post)
        fetch("/asistencias/verificar", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                "Content-Type": "application/json"
            }
        })
        .then(r => r.json())
        .then(data => {
            btnAsistencia.classList.remove('scanning');
            btnAsistencia.disabled = false;
            status.textContent = "Procesado.";

            if (data.accion === "espera") {
                Swal.fire({
                    icon: "info",
                    title: "Espera un momento",
                    text: "Debes esperar 3 minutos para registrar salida.",
                    confirmButtonColor: "#1e40af"
                });
                return;
            }

            // CORRECCIÓN AQUÍ: Agregamos la "E" para que coincida con tu ruta
            if (data.accion === "entrada") {
                status.textContent = "Validando identidad...";
                status.style.color = "#28a745";
                window.location.href = "/asistencias/camaraE?tipo=entrada"; // <<< AQUI ESTABA EL ERROR
                return;
            }

            // CORRECCIÓN AQUÍ TAMBIÉN
            if (data.accion === "salida") {
                status.textContent = "Validando identidad...";
                status.style.color = "#dc3545";
                window.location.href = "/asistencias/camaraE?tipo=salida"; // <<< AQUI ESTABA EL ERROR
                return;
            }

            if (data.accion === "terminado") {
                Swal.fire({
                    icon: "warning",
                    title: "Jornada Completa",
                    text: "Hoy ya se registró entrada y salida.",
                    confirmButtonColor: "#1e40af"
                });
            }
        })
        .catch(error => {
            console.error("Error:", error);
            status.textContent = "Error de conexión.";
            btnAsistencia.classList.remove('scanning');
            btnAsistencia.disabled = false;
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "No se pudo conectar con el servidor."
            });
        });
    });
  </script>

</body>
</html>
