<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nuevas Unidades - Sistema Integral de Gestión</title>
    <link rel="stylesheet" href="{{ asset('css/style_NuevasUnidades.css') }}" />
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
        <form action="{{ route('unidades.store') }}" method="POST">
          @csrf
          <div class="form-grid">
            <div class="form-group">
              <label for="modelo">Modelo:</label>
              <input type="text" id="modelo" name="modelo" required maxlength="50" minlength="2"/>
            </div>

            <div class="form-group">
              <label for="placas">Placas:</label>
              <input type="text" id="placas" name="placas" required maxlength="15" minlength="10"/>
            </div>

            <div class="form-group">
              <label for="anio">Año:</label>
              <input type="number" id="anio" name="anio" required />
            </div>

            <div class="form-group">
              <label for="niv">NIV:</label>
              <input type="text" id="niv" name="numero_serie" maxlength="50" minlength="2"/>
            </div>

            <div class="form-group">
              <label for="marca">Marca:</label>
              <input type="text" id="marca" name="marca" maxlength="50" minlength="2"/>
            </div>

            <div class="form-group">
              <label for="tipo">Tipo:</label>
              <input type="text" id="tipo" name="tipo" maxlength="50" minlength="2"/>
            </div>

            <div class="form-group">
              <label for="capacidad">Capacidad de carga:</label>
              <input type="text" id="capacidad" name="capacidad_carga" />
            </div>

            <div class="form-group">
              <label for="fechaAdquisicion">Fecha de adquisición:</label>
              <input type="date" id="fechaAdquisicion" name="fecha_adquisicion" />
            </div>

            <div class="form-group">
              <label>Status:</label>
              <div class="radio-group">
                <label><input type="radio" name="status" value="Activo" checked /> Activo</label>
                <label><input type="radio" name="status" value="En mantenimiento" /> En mantenimiento</label>
                <label><input type="radio" name="status" value="Baja" /> Baja</label>
              </div>
            </div>

            <div class="form-group full-width">
              <label for="comentarios">Comentarios:</label>
              <input type="text" id="comentarios" name="comentarios" maxlength="255" minlength="1"/>
            </div>
          </div>

          <div class="form-actions">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="button" class="btn btn-secondary" onclick="window.location.reload()">Cancelar</button>
            <button type="reset" class="btn btn-tertiary">Limpiar</button>
          </div>
        </form>
      </div>
    </div>

    @if(session('success'))
      <script>alert("{{ session('success') }}");</script>
    @endif

    @if(session('error'))
      <script>alert("{{ session('error') }}");</script>
    @endif
  </body>
</html>
