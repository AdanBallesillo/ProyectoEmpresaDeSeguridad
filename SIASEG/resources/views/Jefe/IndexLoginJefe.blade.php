<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso al sistema</title>
    <link rel="stylesheet" href="../Estilos/style_LoginJefe.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
<!-- Barra de navegación -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Mi Sistema</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
      data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
      <ul class="navbar-nav mb-2 mb-lg-0">

        <li class="nav-item">
          <a class="nav-link active" href="jefe.html">Jefe</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="secretaria.html">Secretaria</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="empleado.html">Empleado</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="transportista.html">Transportista</a>
        </li>

      </ul>
    </div>
  </div>
</nav>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>


    <div class="login-container">
        <!-- Lado izquierdo con logo -->
        <div class="login-icon">
            <img src="../Imagenes/Logo.png" alt="Logo del sistema" class="logo">
        </div>

        <!-- Lado derecho con formulario -->
        <div class="login-form">
            <h2>Acceso al sistema!</h2>
            <p>Bienvenido al acceso del Jefe
                <br>Por favor, ingrese sus datos:</p>

            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" placeholder="Ingrese su usuario">

            <label for="password">Contraseña:</label>
            <input type="password" id="password" placeholder="Ingrese su contraseña">

            <button id="btnIngresar" type="button" onclick="window.location.href='Frm_Huella.php'">INGRESAR</button>
        </div>
    </div>

</body>
</html>
