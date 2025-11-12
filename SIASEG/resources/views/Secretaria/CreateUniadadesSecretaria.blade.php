<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nuevas Unidades - Sistema Integral de Gestión</title>
    <link rel="stylesheet" href="../Estilos/style_NuevasUnidades.css" />
  </head>
  <body>
    <!-- HEADER PRINCIPAL -->
    <header class="header-container">
      <div class="header-content">
        <div class="logo-and-text">
          <div class="logo-placeholder"></div>
          <div class="text-group">
            <h1 class="main-title">Sistema integral de gestión</h1>
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
      <h2>Nueva Unidad</h2>
    </div>

    <div class="card">
      <div class="card-header">
        <h3>Información de las Unidades</h3>
      </div>
      <div class="card-body">
        <form>
          <div class="form-grid">
            <div class="form-group">
              <label for="modelo">Modelo:</label>
              <input type="text" id="modelo" />
            </div>
            <div class="form-group">
              <label for="placas">Placas:</label>
              <input type="text" id="placas" />
            </div>
            <div class="form-group">
              <label for="anio">Año:</label>
              <input type="number" id="anio" />
            </div>
            <div class="form-group">
              <label for="niv">NIV:</label>
              <input type="text" id="niv" />
            </div>
            <div class="form-group">
              <label for="marca">Marca:</label>
              <input type="text" id="marca" />
            </div>
            <div class="form-group">
              <label for="tipo">Tipo:</label>
              <input type="text" id="tipo" />
            </div>
            <div class="form-group">
              <label for="capacidad">Capacidad de carga:</label>
              <input type="text" id="capacidad" />
            </div>
            <br><br><br>
            <div class="form-group">
              <label for="fechaAdquisicion">Fecha de adquisición:</label>
              <input type="date" id="fechaAdquisicion" class="input-date" />
            </div>
            <div class="form-group">
              <label>Status:</label>
              <div class="radio-group">
                <label><input type="radio" name="status" value="Activo" /> Activo</label>
                <label><input type="radio" name="status" value="Mantenimiento" /> Mantenimiento</label>
                <label><input type="radio" name="status" value="Baja" /> Baja</label>
              </div>
            </div>
            <div class="form-group full-width">
              <label for="comentarios">Comentarios:</label>
              <input type="text" id="comentarios" />
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
  </body>
</html>
