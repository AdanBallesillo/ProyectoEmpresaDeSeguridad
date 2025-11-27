<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Modificar Estación - Sistema Integral de Gestión</title>
    <link rel="stylesheet" href="{{ asset('css/style_ModificarEstacion.css') }}" />
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
        <h2>Modificar Estación</h2>
    </div>

    <!-- TARJETA -->
    <div class="card">
        <div class="card-header">
            <h3>Información de la estación</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('estaciones.update', $estacion->id_estacion) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-grid">

                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre"
                            name="nombre_estacion"
                            value="{{ $estacion->nombre_estacion }}"
                            required />
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado:</label>
                        <input type="text" id="estado"
                            name="estado"
                            value="{{ $estacion->estado }}"
                            required />
                    </div>

                    <div class="form-group">
                        <label for="ciudad">Ciudad:</label>
                        <input type="text" id="ciudad"
                            name="ciudad"
                            value="{{ $estacion->ciudad }}"
                            required />
                    </div>

                    <div class="form-group">
                        <label for="colonia">Colonia:</label>
                        <input type="text" id="colonia"
                            name="colonia"
                            value="{{ $estacion->colonia }}"
                            required />
                    </div>

                    <div class="form-group">
                        <label for="calle">Calle:</label>
                        <input type="text" id="calle"
                            name="calle"
                            value="{{ $estacion->calle }}"
                            required />
                    </div>

                    <div class="form-group">
                        <label for="numero-exterior">Número Exterior:</label>
                        <input type="text" id="numero-exterior"
                            name="n_exterior"
                            value="{{ $estacion->n_exterior }}"
                            required />
                    </div>

                    <div class="form-group">
                        <label for="personal-requerido">Personal Requerido:</label>
                        <input type="number" id="personal-requerido"
                            name="p_requerido"
                            value="{{ $estacion->p_requerido }}"
                            min="0"
                            required />
                    </div>

                    <div class="form-group">
                        <label for="tipo">Tipo:</label>
                        <select id="tipo" name="tipo">
                            <option value="Estacion" {{ $estacion->tipo == 'Estacion' ? 'selected' : '' }}>Estacion</option>
                            <option value="Zona" {{ $estacion->tipo == 'Zona'     ? 'selected' : '' }}>Zona</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <input type="text" id="descripcion"
                            name="descripcion"
                            value="{{ $estacion->descripcion }}"
                            required />
                    </div>

                    {{-- ⚠️ NUEVOS CAMPOS: Latitud y Longitud separados --}}
                    <div class="form-group">
                        <label for="latitud">Latitud:</label>
                        <input type="text" id="latitud"
                            name="latitud"
                            value="{{ $estacion->latitud }}"
                            required />
                    </div>

                    <div class="form-group">
                        <label for="longitud">Longitud:</label>
                        <input type="text" id="longitud"
                            name="longitud"
                            value="{{ $estacion->longitud }}"
                            required />
                    </div>

                    <div class="form-group">
                        <label>Status:</label>
                        <div class="status-options">
                            <label>
                                <input type="radio" name="status" value="Activo"
                                    {{ $estacion->status == 'Activo' ? 'checked' : '' }}>
                                Activo
                            </label>
                            <label>
                                <input type="radio" name="status" value="Inactivo"
                                    {{ $estacion->status == 'Inactivo' ? 'checked' : '' }}>
                                Inactivo
                            </label>
                        </div>
                    </div>

                </div> <!-- /.form-grid -->

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Guardar</button>

                    <button type="button"
                        class="btn btn-secondary"
                        onclick="window.history.back()">
                        Cancelar
                    </button>

                    <button type="reset" class="btn btn-tertiary">Limpiar</button>
                </div>

            </form>
        </div>
    </div>
</body>

</html>