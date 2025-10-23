<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar Usuario - Sistema Integral de Gestión</title>
  <link rel="stylesheet" href="../Estilos/style_Modificar.css">
</head>
<body>
  <!-- HEADER PRINCIPAL -->
  <header class="header-container">
    <div class="header-content">
      <div class="logo-and-text">
        <div class="logo-placeholder"></div>
        <div class="text-group">
          <h1 class="main-title">Sistema integral de gestion</h1>
          <p class="subtitle">Control de Personal y Asistencia</p>
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
    <h2>Modificar Usuario</h2>
  </div>

  <!-- Contenedor principal -->
  <main>
    <div class="form-container">
      <form id="modificarForm">
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
        
        <!-- Fila 4 -->
        <div class="row">
          <label>Estado:</label>
          <div class="estado-options">
            <label><input type="radio" name="estado" value="activo" checked> Activo</label>
            <label><input type="radio" name="estado" value="inactivo"> Inactivo</label>
          </div>
          
          <label for="empleado">N. Empleado:</label>
          <input type="checkbox" id="empleado">
          
          <label for="password">Contraseña:</label>
          <input type="checkbox" id="password">
        </div>
        
        <!-- Sección -->
        <h3 class="seccion">Datos de contacto y Emergencia</h3>
        
        <!-- Fila 5 -->
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
  
  <!-- Script funcionalidad botones -->
  <script>
    const form = document.getElementById('modificarForm');
    
    // Botón Guardar
    form.addEventListener('submit', function(e) {
      e.preventDefault(); // Evita el envío real
      alert('¡Datos guardados correctamente!');
    });
    
    // Botón Cancelar
    document.querySelector('.cancelar').addEventListener('click', function() {
      window.location.href = "Frm_VistaPersonal.php"; // Redirige al listado
    });
    
    // Botón Limpiar
    document.querySelector('.limpiar').addEventListener('click', function() {
      form.reset(); // Limpia todos los campos
    });
  </script>
</body>
</html>
