<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Modificar Unidades - Sistema Integral de Gestión</title>
    <link rel="stylesheet" href="{{ asset('css/style_ModificarUnidades.css') }}" />
  </head>
  <body>
    <!-- HEADER PRINCIPAL -->
    <header class="header-container">
      <div class="header-content">
        <div class="logo-and-text">
          <div class="logo-placeholder"></div>
          <div class="text-group">
            <h1 class="main-title">Sistema integral de gestión</h1>
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
      <div class="card-header">
        <h3>Información de las Unidades</h3>
      </div>

      <div class="card-body">

@if(session('success'))
    <div id="successMessage" class="alert-success">
        {{ session('success') }}
    </div>
@endif

        <!-- FORMULARIO FUNCIONAL -->
        <form action="{{ route('unidades.update', $unidad->id_transporte) }}" method="POST">

          @csrf
          @method('PUT')

          <div class="form-grid">
            <div class="form-group">
              <label for="modelo">Modelo:</label>
              <input type="text" id="modelo" name="modelo" value="{{ $unidad->modelo }}" required />
            </div>

            <div class="form-group">
              <label for="placas">Placas:</label>
              <input type="text" id="placas" name="placas" value="{{ $unidad->placas }}" required />
            </div>

            <div class="form-group">
              <label for="anio">Año:</label>
              <input type="number" id="anio" name="anio" value="{{ $unidad->anio }}" required />
            </div>

            <div class="form-group">
              <label for="niv">NIV:</label>
              <input type="text" id="niv" name="numero_serie" value="{{ $unidad->numero_serie }}" />
            </div>

            <div class="form-group">
              <label for="marca">Marca:</label>
              <input type="text" id="marca" name="marca" value="{{ $unidad->marca }}" required />
            </div>

            <div class="form-group">
              <label for="tipo">Tipo:</label>
              <input type="text" id="tipo" name="tipo" value="{{ $unidad->tipo }}" required />
            </div>

            <div class="form-group">
              <label for="capacidad">Capacidad de carga:</label>
              <input type="text" id="capacidad" name="capacidad_carga" value="{{ $unidad->capacidad_carga }}" />
            </div>

            <br><br><br>

            <div class="form-group">
              <label for="fechaAdquisicion">Fecha de adquisición:</label>
              <input type="date" id="fechaAdquisicion" name="fecha_adquisicion" class="input-date"
                     value="{{ $unidad->fecha_adquisicion ? \Carbon\Carbon::parse($unidad->fecha_adquisicion)->format('Y-m-d') : '' }}" />
            </div>

            <div class="form-group">
  <label>Status:</label>
  <div class="radio-group">
    <label>
      <input type="radio" name="status" value="Activo"
        {{ old('status', $unidad->status) == 'Activo' ? 'checked' : '' }}>
      Activo
    </label>

    <label>
      <input type="radio" name="status" value="En mantenimiento"
        {{ old('status', $unidad->status) == 'En mantenimiento' ? 'checked' : '' }}>
      En mantenimiento
    </label>

    <label>
      <input type="radio" name="status" value="Baja"
        {{ old('status', $unidad->status) == 'Baja' ? 'checked' : '' }}>
      Baja
    </label>
  </div>
</div>

            <div class="form-group full-width">
              <label for="comentarios">Comentarios:</label>
              <input type="text" id="comentarios" name="comentarios" value="{{ $unidad->comentarios }}" />
            </div>
          </div>

          <div class="form-actions">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('mostrartodasunidades') }}" class="btn btn-secondary">Cancelar</a>
            <button type="reset" class="btn btn-tertiary">Limpiar</button>
          </div>
        </form>
      </div>
    </div>
    <script>
document.addEventListener("DOMContentLoaded", function() {
    const successMessage = document.getElementById('successMessage');
    if (successMessage) {
        // Desvanece el mensaje después de 3 segundos
        setTimeout(() => {
            successMessage.style.opacity = '0';
            setTimeout(() => successMessage.remove(), 1000);
        }, 3000);

        // Limpia los campos del formulario
        const form = document.querySelector('form');
        if (form) {
            form.reset();
        }
    }
});
</script>

  </body>
</html>
