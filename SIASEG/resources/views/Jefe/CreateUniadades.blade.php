<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nuevas Unidades - Sistema Integral de Gestión</title>
    <link rel="stylesheet" href="{{ asset('css/style_NuevasUnidades.css') }}" />

    <style>
        /* Solo layout: forzamos 4 columnas y spans */
        .form-grid {
            grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
        }

        .col-span-2 {
            grid-column: span 2;
        }

        .col-span-4 {
            grid-column: 1 / -1;
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
                    <h1 class="main-title">Sistema integral de gestión</h1>
                    <p class="subtitle">ComadrejasCorp</p>
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
        <h2>Nueva Unidad</h2>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>Información de las Unidades</h3>
        </div>

        @if ($errors->any())
        <div style="background:#fde8e8;color:#991b1b;padding:10px 14px;border-radius:8px;margin:14px;">
            <ul style="margin:0;padding-left:18px;">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card-body">
            <form action="{{ route('unidades.store') }}" method="POST">
                @csrf

                <div class="form-grid">
                    <div class="form-group col-span-2">
                        <label for="modelo">Modelo:</label>
                        <input type="text" id="modelo" name="modelo" required maxlength="50" minlength="2" value="{{ old('modelo') }}" />
                    </div>

                    <div class="form-group col-span-2">
                        <label for="placas">Placas:</label>
                        <input type="text" id="placas" name="placas" required maxlength="15" minlength="10" value="{{ old('placas') }}" />
                    </div>

                    <div class="form-group">
                        <label for="anio">Año:</label>
                        <input type="number" id="anio" name="anio" required value="{{ old('anio') }}" />
                    </div>

                    <div class="form-group">
                        <label for="niv">NIV:</label>
                        <input type="text" id="niv" name="numero_serie" maxlength="50" minlength="2" value="{{ old('numero_serie') }}" />
                    </div>

                    <div class="form-group col-span-2">
                        <label for="marca">Marca:</label>
                        <input type="text" id="marca" name="marca" maxlength="50" minlength="2" value="{{ old('marca') }}" />
                    </div>

                    <div class="form-group col-span-2">
                        <label for="tipo">Tipo:</label>
                        <input type="text" id="tipo" name="tipo" maxlength="50" minlength="2" value="{{ old('tipo') }}" />
                    </div>

                    <div class="form-group">
                        <label for="capacidad">Capacidad de carga:</label>
                        <input type="text" id="capacidad" name="capacidad_carga" value="{{ old('capacidad_carga') }}" />
                    </div>

                    <div class="form-group">
                        <label for="fechaAdquisicion">Fecha de adquisición:</label>
                        <input type="date" id="fechaAdquisicion" class="input-date" name="fecha_adquisicion" value="{{ old('fecha_adquisicion') }}" />
                    </div>

                    <div class="form-group col-span-2">
                        <label>Status:</label>
                        <div class="radio-group">
                            <label><input type="radio" name="status" value="Activo" {{ old('status','Activo')=='Activo' ? 'checked' : '' }} /> Activo</label>
                            <label><input type="radio" name="status" value="En mantenimiento" {{ old('status')=='En mantenimiento' ? 'checked' : '' }} /> En mantenimiento</label>
                            <label><input type="radio" name="status" value="Baja" {{ old('status')=='Baja' ? 'checked' : '' }} /> Baja</label>
                        </div>
                    </div>

                    <div class="form-group col-span-4">
                        <label for="comentarios">Comentarios:</label>
                        <input type="text" id="comentarios" name="comentarios" maxlength="255" minlength="1" value="{{ old('comentarios') }}" />
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('jefe.unidades') }}'">Cancelar</button>
                    <button type="reset" class="btn btn-tertiary">Limpiar</button>
                </div>

            </form>
        </div>
    </div>

    @if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
    @endif

    @if(session('error'))
    <script>
        alert("{{ session('error') }}");
    </script>
    @endif
</body>

</html>