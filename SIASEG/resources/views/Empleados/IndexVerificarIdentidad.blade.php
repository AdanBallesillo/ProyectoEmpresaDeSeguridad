<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verificar Identidad</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/style_VerificarIdentidad.css') }}">
</head>

<body>

  <main class="main-content">
    <div class="verify-container">
      <h1>Verificar Identidad</h1>

      <div class="camera-container">
        <div class="camera-frame">
          <video id="video" autoplay playsinline></video>
          <canvas id="canvas"></canvas>
        </div>
      </div>

      <div class="action-buttons">
        <button class="btn-action btn-cancel">Cancelar</button>
        <button class="btn-action btn-capture" id="captureBtn">Capturar</button>
        <button class="btn-action btn-confirm" id="confirmBtn" style="display:none;">Confirmar</button>
      </div>
    </div>
  </main>

  <script>
    const video = document.getElementById("video");
    const canvas = document.getElementById("canvas");
    const captureBtn = document.getElementById("captureBtn");
    const confirmBtn = document.getElementById("confirmBtn");

    let stream;

    async function iniciarCamara() {
      try {
        stream = await navigator.mediaDevices.getUserMedia({ video: true });
        video.srcObject = stream;
      } catch (error) {
        alert("No se puede acceder a la cámara.");
      }
    }

    iniciarCamara();

    captureBtn.addEventListener("click", () => {
      const ctx = canvas.getContext("2d");
      canvas.width = video.videoWidth;
      canvas.height = video.videoHeight;

      ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

      video.style.display = "none";
      canvas.style.display = "block";

      captureBtn.style.display = "none";
      confirmBtn.style.display = "inline-block";
    });

    confirmBtn.addEventListener("click", () => {

  const fotoBase64 = canvas.toDataURL("image/jpeg");
  const tipo = new URLSearchParams(window.location.search).get('tipo');

  fetch("/asistencias/foto", {
      method: "POST",
      credentials: "same-origin",
      headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify({ foto: fotoBase64, tipo: tipo })
  })
  .then(r => r.json())
  .then(data => {
      
      window.location.href = "/Empleado/Menu";
  });
});

    

  </script>

</body>
</html>
