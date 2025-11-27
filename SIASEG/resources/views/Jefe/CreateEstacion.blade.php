<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Nueva Estación - Sistema Integral de Gestión</title>

    <link rel="stylesheet" href="{{ asset('css/style_NuevaEstacion.css') }}" />

    <!-- 👉 Ajuste de layout del formulario -->
    <style>
        .form-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px 24px;
            align-items: flex-start;
        }

        .form-group label {
            display: block;
            margin-bottom: 4px;
            font-weight: 600;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 6px 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        /* Campos que deben ocupar toda la fila */
        .form-group.full {
            grid-column: 1 / -1;
        }

        /* Campos que ocupan 2 columnas (para que no se vea chueco) */
        .form-group.span-2 {
            grid-column: span 2;
        }
    </style>
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

    <!-- TARJETA PRINCIPAL -->
    <div class="card">
        <div class="card-header">
            <h3>Información de la estación</h3>
        </div>

        <div class="card-body">

            {{-- Mensajes de error --}}
            @if ($errors->any())
            <div style="background:#ffdddd; padding:12px; margin-bottom:15px; border-left:4px solid #ff4444;">
                <strong>Corrige los siguientes errores:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if (session('error'))
            <div style="background:#ffdddd; padding:12px; margin-bottom:15px; border-left:4px solid #ff4444;">
                {{ session('error') }}
            </div>
            @endif

            <form method="POST" action="{{ route('estaciones.store') }}">
                @csrf

                <div class="form-grid">

                    <!-- FILA 1 -->
                    <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" name="nombre_estacion" value="{{ old('nombre_estacion') }}">
                    </div>

                    <div class="form-group">
                        <label>Estado:</label>
                        <input type="text" name="estado" value="{{ old('estado') }}">
                    </div>

                    <div class="form-group">
                        <label>Ciudad:</label>
                        <input type="text" name="ciudad" value="{{ old('ciudad') }}">
                    </div>

                    <div class="form-group">
                        <label>Colonia:</label>
                        <input type="text" name="colonia" value="{{ old('colonia') }}">
                    </div>

                    <!-- FILA 2 -->
                    <div class="form-group">
                        <label>Calle:</label>
                        <input type="text" name="calle" value="{{ old('calle') }}">
                    </div>

                    <div class="form-group">
                        <label>Número Exterior:</label>
                        <input type="text" name="n_exterior" value="{{ old('n_exterior') }}">
                    </div>

                    <div class="form-group">
                        <label>Latitud:</label>
                        <input type="text" name="latitud" value="{{ old('latitud') }}">
                    </div>

                    <div class="form-group">
                        <label>Longitud:</label>
                        <input type="text" name="longitud" value="{{ old('longitud') }}">
                    </div>

                    <!-- FILA 3 (Descripción a lo ancho) -->
                    <div class="form-group full">
                        <label>Descripción:</label>
                        <input type="text" name="descripcion" value="{{ old('descripcion') }}">
                    </div>

                    <!-- FILA 4 -->
                    <div class="form-group">
                        <label>Tipo:</label>
                        <select name="tipo">
                            <option value="Estacion" {{ old('tipo') == 'Estacion' ? 'selected' : '' }}>Estación</option>
                            <option value="Zona" {{ old('tipo') == 'Zona' ? 'selected' : '' }}>Zona</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Personal Requerido:</label>
                        <input type="number" min="0" name="p_requerido" value="{{ old('p_requerido') }}">
                    </div>

                    <div class="form-group span-2">
                        <label>Estado de la estación:</label>
                        <select name="status">
                            <option value="Activo" {{ old('status', 'Activo') == 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="Inactivo" {{ old('status') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>

                </div>

                <!-- BOTONES -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Guardar</button>

                    <button type="button" class="btn btn-secondary"
                        onclick="window.location='{{ route('estaciones.index') }}'">
                        Cancelar
                    </button>

                    <button type="reset" class="btn btn-tertiary">Limpiar</button>
                </div>

            </form>
        </div>
    </div>

</body>

</html>