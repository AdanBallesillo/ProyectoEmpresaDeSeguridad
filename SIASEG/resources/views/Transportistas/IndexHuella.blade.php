<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tomar asistencia</title>

  <link rel="stylesheet" href="{{ asset('css/style_Huella.css') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <style>
    #fingerprint {
        width: 160px;
        height: 160px;
        background-image: url("{{ asset('images/Huella.png') }}");
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        cursor: pointer;
        position: relative;
        margin: 20px auto;
    }
    .press-animation {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        position: absolute;
        top: 0;
        left: 0;
        transform: scale(0);
        border: 4px solid rgba(0, 255, 0, 0.55);
        transition: transform 0.3s ease;
    }
    .press-animation.active {
        transform: scale(1.15);
    }
    #status {
        font-size: 18px;
        margin-top: 10px;
        min-height: 24px;
    }
  </style>
</head>
<body>

  <div class="top-bar"></div>

  <div class="container">
    <h2>Tomar asistencia</h2>
    <p>Primero revisa si tienes otros asuntos.</p>

    <div class="fingerprint" id="fingerprint">
      <div class="press-animation"></div>
    </div>

    <p id="status">Presiona la huella…</p>
  </div>

  <div class="bottom-bar"></div>

  <script>
    const fingerprint = document.getElementById("fingerprint");
    const pressAnimation = fingerprint.querySelector(".press-animation");
    const status = document.getElementById("status");

    let timer;

    fingerprint.addEventListener("mousedown", () => {
        status.textContent = "Mantén presionado...";
        pressAnimation.classList.add("active");

        const holdTime = Math.floor(Math.random() * 3) + 1;

        timer = setTimeout(() => {
            status.textContent = "Huella reconocida ✅";
            pressAnimation.classList.remove("active");

            fetch("/asistencias/registrar", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({})
            })
            .then(r => r.json())
            .then(data => {
                status.textContent = data.mensaje;
            });
        }, holdTime * 1000);
    });

    fingerprint.addEventListener("mouseup", () => {
        clearTimeout(timer);
        pressAnimation.classList.remove("active");
        status.textContent = "Presión cancelada ❌";
    });
  </script>

</body>
</html>
