<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Modificar Estación - Sistema Integral de Gestión</title>
    <link rel="stylesheet" href="../Estilos/style_ModificarEstacion.css" />
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
      <h2>Modificar Estación</h2>
    </div>

    <!-- Tarjeta (card) que contiene todo el formulario -->
    <div class="card">
      <!-- Encabezado dentro de la tarjeta -->
      <div class="card-header">
        <h3>Información de la estación</h3>
      </div>

      <!-- Cuerpo de la tarjeta -->
      <div class="card-body">
          <form>
            <div class="form-grid">
              <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" value="" />
              </div>
              <div class="form-group">
                <label for="estado">Estado:</label>
                <input type="text" id="estado" value="" />
              </div>
              <div class="form-group">
                <label for="ciudad">Ciudad:</label>
                <input type="text" id="ciudad" value="" />
              </div>
              <div class="form-group">
                <label for="colonia">Colonia:</label>
                <input type="text" id="colonia" value="" />
              </div>
              <div class="form-group">
                <label for="calle">Calle:</label>
                <input type="text" id="calle" value="" />
              </div>
              <div class="form-group">
                <label for="numero-exterior">Numero Exterior:</label>
                <input type="text" id="numero-exterior" value="" />
              </div>
              <div class="form-group full-width">
                <label for="personal-requerido">Personal Requerido:</label>
                <input type="number" id="personal-requerido" value="" />
              </div>
            </div>
            <div class="form-actions">
              <button type="submit" class="btn btn-primary">Guardar</button>
              <button type="button" class="btn btn-secondary">Cancelar</button>
              <button type="button" class="btn btn-tertiary">Limpiar</button>
            </div>
          </form>
        </div>
      </div>
    </main>
  </body>
</html>