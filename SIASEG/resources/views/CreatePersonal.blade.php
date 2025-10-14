<!DOCTYPE html> 
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema Integral de Gestión</title>
  <link rel="stylesheet" href="{{ asset('css/style_Agregar.css') }}">
</head>
<body>

    <!-- HEADER PRINCIPAL -->
    <header class="header-container">
      <div class="header-content">
        <div class="logo-and-text">
          <div class="logo-placeholder"></div>
          <div class="text-group">
            <h1 class="main-title">Sistema integral de gestion</h1>
            <p class="subtitle">ComadrejasCorp</p>
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
      <h2>Nuevo Empleado</h2>
      <button class="menu-btn" id="menuBtn">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>

  <!-- Contenedor principal -->
  <main>
    <div class="form-container">
      <form id="formEmpleado">
        <!-- Fila 1 -->
        <div class="row">
          <label for="nombre">Nombre(s):</label>
          <input type="text" id="nombre" placeholder="Ingresa el nombre completo">

          <label for="apellidos">Apellidos:</label>
          <input type="text" id="apellidos" placeholder="Ingresa los apellidos">
        </div>

        <!-- Fila 2 -->
        <div class="row">
          <label for="curp">CURP:</label>
          <input type="text" id="curp" placeholder="Ingresa el CURP">

          <label for="rfc">RFC:</label>
          <input type="text" id="rfc" placeholder="Ingresa el RFC">
        </div>

        <!-- Fila 3 -->
        <div class="row">
          <label for="foto">FOTO:</label>
          <input type="file" id="foto">

          <label for="rol">Rol:</label>
          <select id="rol">
            <option value="admin">Administrador</option>
            <option value="empleado">Empleado</option>
          </select>
        </div>

        <!-- Sección -->
        <h3 class="seccion">Datos de contacto y Emergencia</h3>

        <!-- Fila 4 -->
        <div class="row">
          <label for="correo">Correo Electrónico:</label>
          <input type="email" id="correo" placeholder="Ingresa el Correo Electrónico">

          <label for="telefono">Número (Tel):</label>
          <input type="tel" id="telefono" placeholder="Ingresa el Número">
        </div>

        <!-- Botones -->
        <div class="botones">
          <button type="submit" class="guardar">Guardar</button>
          <button type="button" class="cancelar">Cancelar</button>
          <button type="button" class="limpiar">Limpiar</button>
        </div>
      </form>
    </div>
  </main>

  <script>
    // Guardar: mostrar mensaje emergente
    document.getElementById('formEmpleado').addEventListener('submit', function(e) {
      e.preventDefault(); // Evita el envío real del formulario
      alert('¡Empleado guardado correctamente!');
    });

    // Cancelar: regresar a Frm_VistaPersonal.php
    document.querySelector('.cancelar').addEventListener('click', function() {
      window.location.href = "../Formularios/Frm_VistaPersonal.php";
    });

    // Limpiar: borrar todos los campos
    document.querySelector('.limpiar').addEventListener('click', function() {
      document.getElementById('formEmpleado').reset();
    });
  </script>
</body>
</html>
