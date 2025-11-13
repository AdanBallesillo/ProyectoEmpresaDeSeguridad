<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Integral de Gestión</title>
    <link rel="stylesheet" href="{{ asset('css/style_Agregar.css') }}" />
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
        <h2>Nuevo Usuario</h2>
    </div>

    <!-- Contenedor principal -->
    <main>
        <div class="form-container">

            {{-- MENSAJES --}}
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}<br>
                @if (session('no_empleado'))
                <strong>No. Empleado:</strong> {{ session('no_empleado') }}<br>
                @endif
                @if (session('password'))
                <strong>Contraseña temporal:</strong> {{ session('password') }}
                @endif
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- FORMULARIO REAL DE LARAVEL --}}
            <form id="formEmpleado"
                action="{{ route('empleados.store') }}"
                method="POST"
                enctype="multipart/form-data">
                @csrf

                <!-- Fila 1 -->
                <div class="row">
                    <label for="nombres">Nombre(s):</label>
                    <input type="text"
                        id="nombres"
                        name="nombres"
                        value="{{ old('nombres') }}"
                        placeholder="Ingresa el nombre completo"
                        required>

                    <label for="apellidos">Apellidos:</label>
                    <input type="text"
                        id="apellidos"
                        name="apellidos"
                        value="{{ old('apellidos') }}"
                        placeholder="Ingresa los apellidos"
                        required>
                </div>

                <!-- Fila 2 -->
                <div class="row">
                    <label for="CURP">CURP:</label>
                    <input type="text"
                        id="CURP"
                        name="CURP"
                        value="{{ old('CURP') }}"
                        placeholder="Ingresa el CURP"
                        required>

                    <label for="RFC">RFC:</label>
                    <input type="text"
                        id="RFC"
                        name="RFC"
                        value="{{ old('RFC') }}"
                        placeholder="Ingresa el RFC"
                        required>
                </div>

                <!-- Fila 3 -->
                <div class="row">
                    <label for="fotografia">FOTO:</label>
                    <input type="file"
                        id="fotografia"
                        name="fotografia"
                        accept="image/*">

                    <label for="rol">Rol:</label>
                    <select id="rol" name="rol" required>
                        <option value="">Seleccione un rol</option>
                        <option value="Empleado" {{ old('rol') == 'Empleado' ? 'selected' : '' }}>Empleado</option>
                        <option value="Secretaria" {{ old('rol') == 'Secretaria' ? 'selected' : '' }}>Secretaria</option>
                        <option value="Transportista" {{ old('rol') == 'Transportista' ? 'selected' : '' }}>Transportista</option>
                        <option value="Administrador" {{ old('rol') == 'Administrador' ? 'selected' : '' }}>Administrador</option>
                    </select>
                </div>

                <!-- Sección -->
                <h3 class="seccion">Datos de contacto y Emergencia</h3>

                <!-- Fila 4 -->
                <div class="row">
                    <label for="correo">Correo Electrónico:</label>
                    <input type="email"
                        id="correo"
                        name="correo"
                        value="{{ old('correo') }}"
                        placeholder="Ingresa el Correo Electrónico"
                        required>

                    <label for="telefono">Número (Tel):</label>
                    <input type="tel"
                        id="telefono"
                        name="telefono"
                        value="{{ old('telefono') }}"
                        placeholder="Ingresa el Número"
                        required>
                </div>

                <!-- Botones -->
                <div class="botones">
                    <button type="submit" class="btn btn-primary guardar">Guardar</button>

                    <!-- BOTÓN CANCELAR CORREGIDO -->
                    <button type="button"
                        class="btn btn-secondary cancelar"
                        onclick="window.location.href='{{ route('mostrarempleados') }}'">
                        Cancelar
                    </button>




                    <button type="button" class="btn btn-tertiary limpiar">Limpiar</button>
                </div>

            </form>
        </div>
    </main>

</body>

</html>