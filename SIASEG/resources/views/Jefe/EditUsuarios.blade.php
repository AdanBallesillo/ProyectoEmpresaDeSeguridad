<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar Usuario - Sistema Integral de Gestión</title>
  <link rel="stylesheet" href="{{asset ('css/style_Modificar.css')}}">
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
      <form id="modificarForm" action="{{ route('employed.update', $empleado->id_empleado) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- PROVICIONAL, Mostrar las nuevas credenciales hasta arriba de la view --}}
        @if(session('success'))
            <div class="alert success" style="background: #e6ffed; border: 1px solid #22c55e; padding: 10px; border-radius: 5px; color: #166534; margin-bottom: 15px;">
                <strong>{{ session('success') }}</strong><br>

                @if(session('no_empleado'))
                    Número de control nuevo: <strong>{{ session('no_empleado') }}</strong><br>
                @endif

                @if(session('password'))
                    {{ session('password') }}
                @endif
            </div>
        @endif

        <!-- Fila 1 -->
        <div class="row">
          <label for="nombre">Nombre(s):</label>
          <input type="text" id="nombre" name= "nombres" value= "{{ $empleado->nombres }}" placeholder="Ingresa el nombre completo">

          <label for="apellidos">Apellidos:</label>
          <input type="text" id="apellidos" name="apellidos" value= "{{ $empleado->apellidos }}" placeholder="Ingresa los apellidos">
        </div>

        <!-- Fila 2 -->
        <div class="row">
          <label for="curp">CURP:</label>
          <input type="text" id="curp" name="CURP" value= "{{ $empleado->CURP }}" placeholder="Ingresa el CURP">

          <label for="rfc">RFC:</label>
          <input type="text" id="rfc" name="RFC" value= "{{ $empleado->RFC }}" placeholder="Ingresa el RFC">
        </div>

        <!-- Fila 3 -->
        <div class="row">
          <label for="foto">FOTO:</label>
          <input type="file" id="foto" name="fotografia" value= "{{ $empleado->fotografia }}">

          <label for="rol">Rol:</label>
          <select id="rol" name="rol">
            <option value="admin" {{ $empleado->rol == 'admin' ? 'selected' : '' }}>Administrador</option>
            <option value="empleado" {{ $empleado->rol == 'empleado' ? 'selected' : '' }}>Empleado</option>
          </select>
        </div>

        <!-- Fila 4 -->
        <div class="row">
          <label>Estado:</label>
          <div class="estado-options">
            <label><input type="radio" name="estado" value="activo" {{ $empleado->estado == 'activo' ? 'checked' : '' }} checked> Activo</label>
            <label><input type="radio" name="estado" value="inactivo" {{ $empleado->estado == 'inactivo' ? 'checked' : '' }}> Inactivo</label>
          </div>

          <label for="empleado">N. Empleado:</label>
          <input type="checkbox" id="empleado" name="generar_no_control" >

          <label for="password">Contraseña:</label>
          <input type="checkbox" id="password" name="generar_password" >
        </div>

        <!-- Sección -->
        <h3 class="seccion">Datos de contacto y Emergencia</h3>

        <!-- Fila 5 -->
        <div class="row">
          <label for="correo">Correo Electrónico:</label>
          <input type="email" id="correo" name="correo" value="{{ $empleado->correo }}" placeholder="Ingresa el Correo Electrónico">

          <label for="telefono">Número (Tel):</label>
          <input type="tel" id="telefono" name="telefono" value='{{ $empleado->telefono }}' placeholder="Ingresa el Número">
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

    // // Botón Guardar
    // form.addEventListener('submit', function(e) {
    //   e.preventDefault(); // Evita el envío real
    //   alert('¡Datos guardados correctamente!');
    // });

    // Botón Cancelar
    document.querySelector('.cancelar').addEventListener('click', function() {
      window.location.href = "Frm_VistaPersonal.php"; // Redirige al listado
    });

    // Botón Limpiar
    document.querySelector('.limpiar').addEventListener('click', function() {
      form.reset(); // Limpia todos los campos
    });

    @if (session('success'))
    Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        html: `{!! nl2br(session('success')) !!}`, // SIN 'e()' para no escapar el HTML
        confirmButtonText: 'Aceptar'
    });
    @endif

    @if (session('error'))
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: '{{ session('error') }}',
        confirmButtonText: 'Aceptar'
      });
    @endif
  </script>
</body>
</html>
