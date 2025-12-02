<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambio de Contraseña - SIASEG</title>
    <!-- Iconos Material Design -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        /* =========================================
           1. ESTILOS GENERALES DEL SISTEMA (SIASEG)
           ========================================= */
        body {
            font-family: Arial, sans-serif;
            background-color: #0d284e; /* Tu azul institucional de fondo */
            margin: 0;
            padding: 0;
            color: #333;
            /* Centrado específico para esta página */
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        /* Contenedor Blanco Principal */
        .page-container {
            background-color: #fff;
            padding: 45px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 500px; /* Limitamos el ancho para que parezca tarjeta de login */
            box-sizing: border-box; /* Asegura que el padding no rompa el ancho */
        }

        /* Encabezado */
        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 20px;
            border-bottom: 2px solid #e1e1e1;
            margin-bottom: 20px;
        }

        .header-title {
            font-size: 1.8rem; /* Ajustado ligeramente para el login */
            font-weight: bold;
            color: #0d284e;
            margin: 0;
        }

        /* Texto descriptivo */
        .description-text {
            margin-top: 20px;
            color: #666;
            line-height: 1.5;
            font-size: 0.95rem;
        }

        /* =========================================
           2. ESTILOS ESPECÍFICOS DEL FORMULARIO
           ========================================= */

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            color: #0d284e;
            font-weight: bold;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .form-input {
            width: 100%;
            padding: 12px;
            border: 2px solid #e6eef6; /* Tu gris claro de tablas */
            border-radius: 5px;
            font-size: 1rem;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        .form-input:focus {
            outline: none;
            border-color: #0d284e; /* Azul institucional al enfocar */
            background-color: #f9fbff;
        }

        .form-hint {
            font-size: 0.8rem;
            color: #888;
            margin-top: 5px;
        }

        /* Botón Principal */
        .btn-submit {
            width: 100%;
            background-color: #0d284e;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            transition: background 0.3s;
            margin-top: 30px;
        }

        .btn-submit:hover {
            background-color: #153e75; /* Un tono más claro al pasar el mouse */
        }

        /* Alertas de Error */
        .alert-error {
            background-color: #ffebee;
            border-left: 5px solid #F43D3D; /* Tu rojo de notificación grave */
            color: #c62828;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        .alert-error ul {
            padding-left: 20px;
            margin: 5px 0 0 0;
        }

        /* Ajuste responsivo para celulares */
        @media (max-width: 600px) {
            .page-container {
                margin: 20px;
                padding: 30px;
            }
            .header-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>

    <!-- Contenedor de la tarjeta -->
    <div class="page-container">

        <!-- Encabezado -->
        <div class="content-header">
            <h1 class="header-title">Bienvenido a SIASEG</h1>
            <div>
                <span class="material-icons" style="color: #0d284e; font-size: 32px;">security</span>
            </div>
        </div>

        <p class="description-text">
            Por motivos de seguridad, es necesario que actualices tu contraseña temporal para poder acceder al sistema.
        </p>

        <!-- Mensajes de Error -->
        @if ($errors->any())
            <div class="alert-error">
                <strong>¡Atención!</strong> Por favor corrige los siguientes errores:
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario -->
        <form action="{{ route('primer-login.update') }}" method="POST">
            @csrf

            <!-- Campo Password -->
            <div class="form-group">
                <label class="form-label" for="password">Nueva Contraseña</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-input"
                    placeholder="Ingresa tu nueva contraseña"
                    required
                >
                <p class="form-hint">Mínimo 8 caracteres.</p>
            </div>

            <!-- Campo Confirmación -->
            <div class="form-group">
                <label class="form-label" for="password_confirmation">Confirmar Contraseña</label>
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    class="form-input"
                    placeholder="Vuelve a escribir la contraseña"
                    required
                >
            </div>

            <!-- Botón de Acción -->
            <button type="submit" class="btn-submit">
                <span class="material-icons">save</span>
                GUARDAR Y ENTRAR
            </button>
        </form>

    </div>

</body>
</html>
