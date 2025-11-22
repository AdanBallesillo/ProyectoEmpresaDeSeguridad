<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Modificar Estación - Sistema Integral de Gestión</title>
    <link rel="stylesheet" href=" {{ asset ('css/style_ModificarEstacion.css') }} " />
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
          <form action="{{ route('estaciones.update', $estacion->id_estacion) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-grid">
              <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" value="{{ $estacion->nombre_estacion }}" name="nombre_estacion"/>
              </div>
              <div class="form-group">
                <label for="estado">Estado:</label>
                <input type="text" id="estado" value="{{ $estacion->estado }}" name="estado"/>
              </div>
              <div class="form-group">
                <label for="ciudad">Ciudad:</label>
                <input type="text" id="ciudad" value="{{ $estacion->ciudad }}" name="ciudad"/>
              </div>
              <div class="form-group">
                <label for="colonia">Colonia:</label>
                <input type="text" id="colonia" value="{{ $estacion->colonia }}" name="colonia"/>
              </div>
              <div class="form-group">
                <label for="calle">Calle:</label>
                <input type="text" id="calle" value="{{ $estacion->calle }}" name="calle"/>
              </div>
              <div class="form-group">
                <label for="numero-exterior">Numero Exterior:</label>
                <input type="text" id="numero-exterior" value="{{ $estacion->n_exterior }}" name="n_exterior"/>
              </div>
              <div class="form-group">
                <label for="personal-requerido">Personal Requerido:</label>
                <input type="number" id="personal-requerido" value="{{ $estacion->p_requerido }}" name="p_requerido"/>
              </div>
              <div class="form-group">
                <label for="codigo_postal">Codigo Postal:</label>
                <input type="text" id="codigo_postal" value="{{ $estacion->codigo_estacion }}" name="codigo_estacion" maxlength="6" minlength="5"/>
              </div>
              <div class="form-group">
                <label for="tipo">Tipo:</label>
                <select id="tipo" name="tipo">
                        <option value="Estacion" {{ $estacion->tipo == 'Estacion' ? 'selected' : '' }}> Estacion </option>
                        <option value="Zona" {{ $estacion->tipo == 'Zona' ? 'selected' : '' }}> Zona </option>
                    </select>
              </div>
              <div class="form-group">
                <label for="descripcion">Descripcion:</label>
                <input type="text" id="descripcion" value="{{ $estacion->descripcion }}" name="descripcion"/>
              </div>
              <div class="form-group">
                <label for="coordenadas">Coordenadas:</label>
                <input type="text" id="coordenadas" value="{{ $estacion->latitud . ', ' . $estacion->longitud }}" name="coordenadas"/>
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
