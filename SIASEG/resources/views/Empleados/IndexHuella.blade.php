<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tomar asistencia</title>
  <link rel="stylesheet" href="{{ asset('css/style_Huella.css') }}">
</head>
<body>
  <!-- Barra superior con menú -->
  <div class="top-bar"></div>

  <!-- Contenido principal -->
  <div class="container">
    <h2>Tomar asistencia</h2>
    <p>Primero revisa si tienes otros asuntos.</p>

    <div class="fingerprint" id="fingerprint">
      <div class="press-animation"></div>
    </div>
    <p id="status"></p>
  </div>

  <!-- Barra inferior -->
  <div class="bottom-bar"></div>

  <script src="{{ asset('js/Anim_Huella.js') }}"></script>
</body>
</html>
