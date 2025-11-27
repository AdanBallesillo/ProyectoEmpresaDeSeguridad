<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modificar Ruta - Sistema Integral</title>

    <link rel="stylesheet" href="{{ asset('css/style.AgregarRuta.css') }}">
</head>
<body>

    <header class="header-container">
        <div class="header-content">
            <div class="logo-and-text">
                <div class="logo-placeholder"></div>
                <div class="text-group">
                    <h1 class="main-title">Sistema Integral de Gestión</h1>
                    <p class="subtitle">Logística y Rutas</p>
                </div>
            </div>
            <div class="user-info">
                <span class="user-role">Admin Usuario</span>
                <div class="user-icon"></div>
            </div>
        </div>
    </header>

    <main class="main-content">

        <div class="sub-header">
            <h2>Modificar Ruta</h2>
        </div>

        <div class="card">

            <div class="card-header">
                <h3>Editar Información de la Ruta</h3>
            </div>

            <div class="card-body">
<form action="{{ route('rutas.update', $ruta->id_ruta) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-grid">

        <div class="form-group full-width">
            <label for="nombre">Nombre de la Ruta:</label>
            <input type="text" id="nombre" name="nombre" value="{{ $ruta->nombre }}" required>
        </div>

        <div class="form-group">
            <label for="origen">Punto de Origen:</label>
            <select id="origen" name="origen" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">

                @foreach($estaciones as $estacion)
                    <option value="{{ $estacion->nombre_estacion }}"
                        {{-- Lógica: Si el nombre guardado coincide con esta opción, ponle 'selected' --}}
                        {{ $ruta->origen == $estacion->nombre_estacion ? 'selected' : '' }}>

                        📍 {{ $estacion->nombre_estacion }}
                    </option>
                @endforeach

            </select>
        </div>

        <div class="form-group">
            <label for="destino">Punto de Destino:</label>
            <select id="destino" name="destino" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">

                @foreach($estaciones as $estacion)
                    <option value="{{ $estacion->nombre_estacion }}"
                        {{-- Lógica: Lo mismo para el destino --}}
                        {{ $ruta->destino == $estacion->nombre_estacion ? 'selected' : '' }}>

                        🏁 {{ $estacion->nombre_estacion}}
                    </option>
                @endforeach

            </select>
        </div>

        <div class="form-group full-width status-container">
            <label class="status-title">Estatus de la Ruta:</label>

            <div class="radio-options">
                <label class="radio-label active-option">
                    <input type="radio" name="status" value="Activo"
                        {{ $ruta->status == 'Activo' ? 'checked' : '' }}>
                    <span>Activo</span>
                </label>

                <label class="radio-label inactive-option">
                    <input type="radio" name="status" value="Inactivo"
                        {{ $ruta->status == 'Inactivo' ? 'checked' : '' }}>
                    <span>Inactivo</span>
                </label>
            </div>

            <p class="helper-text">
                * Si marcas "Inactivo", esta ruta no aparecerá para asignar nuevos viajes.
            </p>
        </div>

    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Actualizar Ruta</button>
        <a href="{{ route('rutas.index') }}" class="btn btn-secondary">Cancelar</a>
    </div>

</form>
            </div>
        </div>

    </main>

</body>
</html>
