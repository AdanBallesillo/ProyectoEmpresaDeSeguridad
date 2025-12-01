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
                <span class="user-role"> Bienvenido, {{ Auth::user() -> nombres ?? 'Invitado' }} </span>
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
            <form id="formEmpleado" action="{{ route('empleados.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Mostrar las credenciales del usuario de manera provicional en lo que se compra el dominio, favor de guardarlas o tomar captura --}}
                {{-- @if(session('success'))
                <div class="alert success">
                    {{ session('success') }}
                    <br>
                    Número de control: {{ session('no_empleado') }} <br>
                    Contraseña temporal: {{ session('password') }}
                </div>
                @endif --}}
                <!-- Fila 1 -->
                <div class="row">
                    <label for="nombre">Nombre(s):</label>
                    <input type="text" id="nombre" name="nombres" placeholder="Ingresa el nombre completo" required>

                    <label for="apellidos">Apellidos:</label>
                    <input type="text" id="apellidos" name="apellidos" placeholder="Ingresa los apellidos" required>
                </div>

                <!-- Fila 2 -->
                <div class="row">
                    <label for="curp">CURP:</label>
                    <input type="text" id="curp" name="CURP" placeholder="Ingresa el CURP" required maxlength="18" minlength="18">

                    <label for="rfc">RFC:</label>
                    <input type="text" id="rfc" name="RFC" placeholder="Ingresa el RFC" required maxlength="13" minlength="12">
                </div>

                <!-- Fila 3 -->
                <div class="row">
                    <label for="foto">FOTO:</label>
                    <input type="file" id="foto" name="fotografia" required>

                    <label for="rol">Rol:</label>
                    <select id="rol" name="rol">
                        <option value="Administrador"> Administrador </option>
                        <option value="Empleado"> Empleado </option>
                        <option value="Secretaria"> Secretaria </option>
                        <option value="Transportista"> Transportista </option>
                    </select>
                </div>

                <!-- Sección -->
                <h3 class="seccion">Datos de contacto y Emergencia</h3>

                <!-- Fila 4 -->
                <div class="row">
                    <label for="correo">Correo Electrónico:</label>
                    <input type="email" id="correo" name="correo" placeholder="Ingresa el Correo Electrónico" required>

                    <label for="telefono">Número (Tel):</label>
                    <input type="tel" id="telefono" name="telefono" placeholder="Ingresa el Número" required maxlength="10" minlength="10" inputmode="numeric">
                </div>

                <!-- Botones -->
                <div class="botones">
                    <button type="submit" class="guardar">Guardar</button>
                    <button type="button" class="cancelar"
    onclick="window.location='{{ url()->previous() }}'">
    Regresar
</button>
                    <button type="button" class="limpiar">Limpiar</button>
                </div>
            </form>
        </div>
    </main>

    <script>
        // Guardar: mostrar mensaje emergente
        // document.getElementById('formEmpleado').addEventListener('submit', function(e) {
        //   e.preventDefault(); // Evita el envío real del formulario
        //   alert('¡Empleado guardado correctamente!');
        // });

        // Cancelar: regresar a Frm_VistaPersonal.php
        // document.querySelector('.cancelar').addEventListener('click', function() {
        //     window.location.href = "../Formularios/Frm_VistaPersonal.php";
        // });

        // Limpiar: borrar todos los campos
        document.querySelector('.limpiar').addEventListener('click', function() {
            document.getElementById('formEmpleado').reset();
        });
    </script>
</body>

</html>

@if ($errors->any())
<div style="background:#fdecea;color:#611a15;padding:10px;margin:10px 0">
    <b>Errores al guardar:</b>
    <ul>
        @foreach ($errors->all() as $e)
        <li>{{ $e }}</li>
        @endforeach
    </ul>
</div>
@endif
