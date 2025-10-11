<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso al sistema</title>
    <link rel="stylesheet" href="../../css/style_Login.css">
</head>
<body>
    <div class="login-container">
        <!-- Lado izquierdo con logo -->
        <div class="login-icon">
            <!-- Aquí colocas tu logo -->
            <img src="../Imagenes/Logo.png" alt="Logo del sistema" class="logo">
        </div>

        <!-- Lado derecho con formulario -->
        <div class="login-form">
            <h2>Acceso al sistema!</h2>
            <p>Por favor, ingrese sus datos:</p>

            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" placeholder="Ingrese su usuario">

            <label for="password">Contraseña:</label>
            <input type="password" id="password" placeholder="Ingrese su contraseña">

            <button id="btnIngresar" type="button" onclick="window.location.href='Frm_Huella.php'">INGRESAR</button>
        </div>
    </div>
</body>
</html>
