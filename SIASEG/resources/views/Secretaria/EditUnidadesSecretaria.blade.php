<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Modificar Unidades - Sistema Integral de Gestión</title>
    <link rel="stylesheet" href="../Estilos/style_ModificarUnidades.css" />
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
      <h2>Modificar Unidades</h2>
    </div>

    <!-- Tarjeta (card) que contiene todo el formulario -->
    <div class="card">
      <!-- Encabezado dentro de la tarjeta -->
      <div class="card-header">
        <h3>Información de las Unidades</h3>
      </div>

      <!-- Cuerpo de la tarjeta -->
      <div class="card-body">
        <!-- Formulario para capturar los datos -->
        <form>
          <!-- Estructura en forma de cuadrícula -->
          <div class="form-grid">
            <!-- Cada "form-group" representa un campo con su etiqueta e input -->
            <div class="form-group">
              <label for="modelo">Modelo:</label>
              <input type="text" id="modelo" value="" />
            </div>
            <div class="form-group">
              <label for="placas">Placas:</label>
              <input type="text" id="placas" value="" />
            </div>
            <div class="form-group">
              <label for="anio">Año:</label>
              <input type="number" id="anio" value="" />
            </div>
            <div class="form-group">
              <label for="niv">NIV:</label>
              <input type="text" id="niv" value="" />
            </div>
            <div class="form-group">
              <label for="color">Color:</label>
              <input type="text" id="color" value="" />
            </div>
          </div>

          <!-- Sección inferior del formulario con los botones -->
          <div class="form-actions">
            <!-- Botón principal (naranja) -->
            <button type="submit" class="btn btn-primary">Guardar</button>

            <!-- Botón secundario (azul oscuro) -->
            <button type="button" class="btn btn-secondary">Cancelar</button>

            <!-- Botón terciario (azul oscuro, usado para limpiar) -->
            <button type="button" class="btn btn-tertiary">Limpiar</button>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>