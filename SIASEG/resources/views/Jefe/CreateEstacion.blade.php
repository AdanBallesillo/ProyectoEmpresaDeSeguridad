<!DOCTYPE html>
<html lang="es">
  <head>
    <!-- Codificación y configuración de la página -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Título que aparece en la pestaña del navegador -->
    <title>Nueva Estación - Sistema Integral de Gestión</title>

    <!-- Enlace al archivo CSS externo donde está el diseño -->
    <link rel="stylesheet" href="{{ asset('css/style_NuevaEstacion.css') }}" />
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
      <h2>Nueva Estación</h2>
    </div>

      <!-- Tarjeta (card) que contiene todo el formulario -->
      <div class="card">
        <!-- Encabezado dentro de la tarjeta -->
        <div class="card-header">
          <h3>Información de la estación</h3>
        </div>

        <!-- Cuerpo de la tarjeta -->
        <div class="card-body">
          <!-- Formulario para capturar los datos -->
          <form method="POST" action="{{ route('estaciones.store') }}">
            @csrf
            <!-- Estructura en forma de cuadrícula -->
            <div class="form-grid">
              <!-- Cada “form-group” representa un campo con su etiqueta e input -->
              <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre_estacion"/>
              </div>

              <div class="form-group">
                <label for="estado">Estado:</label>
                <input type="text" id="estado" name="estado"/>
              </div>

              <div class="form-group">
                <label for="ciudad">Ciudad:</label>
                <input type="text" id="ciudad" name="ciudad"/>
              </div>

              <div class="form-group">
                <label for="colonia">Colonia:</label>
                <input type="text" id="colonia" name="colonia"/>
              </div>

              <div class="form-group">
                <label for="calle">Calle:</label>
                <input type="text" id="calle" name="calle"/>
              </div>

              <div class="form-group">
                <label for="numero-exterior">Numero Exterior:</label>
                <input type="text" id="numero-exterior" name="n_exterior"/>
              </div>

              <div class="form-group">
                <label for="codigo_postal">Codigo Postal:</label>
                <input type="text" id="codigo_postal" name="codigo_postal" maxlength="6" minlength="5"/>
              </div>

              <div class="form-group">
                <label for="coordenadas">Coordenadas:</label>
                <input type="text" id="coordenadas" name="coordenadas"/>
              </div>

              <div class="form-group">
                <label for="descripcion">Descripcion:</label>
                <input type="text" id="descripcion" name="descripcion"/>
              </div>

              <div class="form-group">
                <label for="tipo">Tipo:</label>
                <select name="tipo" id="tipo">
                    <option value="Estacion">Estacion</option>
                    <option value="Zona">Zona</option>
                </select>
              </div>

              <!-- Campo que ocupa todo el ancho del formulario -->
              <div class="form-group">
                <label for="personal-requerido">Personal Requerido:</label>
                <input type="number" id="personal-requerido" name="p_requerido"/>
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
    </main>
  </body>
</html>
