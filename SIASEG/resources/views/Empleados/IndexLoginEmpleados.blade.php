<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso al sistema</title>
    <link rel="stylesheet" href="{{ asset('css/style_Login.css')}}">
</head>
<body>

    <!-- 🔹 Barra superior tipo menú -->
    <header class="menu-bar">
        <nav class="menu-buttons">
            {{-- Modificación de rutas al menú  --}}
            <a href="{{ route('Ruta.LoginAdmin')}}" class="menu-btn">Jefe</a>
            <a href="{{ route('Ruta.LoginSecretaria') }}" class="menu-btn">Secretaría</a>
            <a href="{{ route('Ruta.LoginEmpleado') }}" class="menu-btn">Empleado</a>
            <a href="{{ route('Ruta.LoginTranspo') }}" class="menu-btn">Transportistas</a>
        </nav>
    </header>

    <div class="login-container">
        <!-- Lado izquierdo con logo -->
        <div class="login-icon">
            <img src="../Imagenes/Logo.png" alt="Logo del sistema" class="logo">
        </div>

        <!-- Lado derecho con formulario -->
        {{-- Modificaciones --}}
        <form action="{{ route('Empleado.Validate')}}" method="POST">
            @csrf
            <div class="login-form">
            <h2>Acceso al sistema!</h2>
            <p>Bienvenido al acceso de los empleados
            <br>Por favor, ingrese sus datos:</p>

            <label for="usuario">No. Empleado:</label>
            <input type="text" name="no_empleado" placeholder="Ingrese su No. De empleado" required>

            <label for="password">Contraseña:</label>
            <input type="password" name="password" placeholder="Ingrese su contraseña" required>

            <button id="btnIngresar" type="submit">INGRESAR</button>
            </div>
                        {{-- Mostrar algun error, Nenuco dale estilo a este mensaje por fa, en todos los login. --}}
            @if ($errors -> has('login_error'))
                <div class="error-message">
                    {{ $errors -> first('login_error') }}
                </div>
            @endif
        </form>

    </div>

</body>
</html>
