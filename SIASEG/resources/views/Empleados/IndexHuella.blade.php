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

    /*  Estilo del botón */
    .btn-menu {
        display: inline-block;
        margin-top: 25px;
        padding: 10px 20px;
        background-color: #008cff;
        color: white;
        border-radius: 8px;
        font-size: 16px;
        text-decoration: none;
        transition: 0.25s;
    }
    .btn-menu:hover {
        background-color: #006ad1;
    }
  </style>
</head>

<body>

  <div class="top-bar"></div>

  <div class="container">
    <h2>Tomar asistencia</h2>
    <p>Presiona la huella para continuar.</p>

    <div class="fingerprint" id="fingerprint">
      <div class="press-animation"></div>
    </div>

    <p id="status">Presiona la huella…</p>

    <!--  Botón hacia el menú del empleado -->
    <a href="{{ route('Empleado.Menu') }}" class="btn-menu">
      Ir al menú
    </a>

  </div>

  <div class="bottom-bar"></div>

  <script src="{{ asset('js/Anim_Huella.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>
