<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alta de Nueva Ruta - Sistema Integral</title>

    <link rel="stylesheet" href="{{ asset('css/style.AgregarRuta.css') }}">
</head>
<body>

    <header class="header-container">
        <div class="header-content">
            <div class="logo-and-text">
                <div class="logo-placeholder"></div> <div class="text-group">
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
            <h2>Alta de Nueva Ruta</h2>
        </div>

        <div class="card">

            <div class="card-header">
                <h3>📍 Información de la Ruta</h3>
            </div>

            <div class="card-body">
<form action="{{ route('rutas.store') }}" method="POST">
    @csrf

    <div class="form-grid">

        <div class="form-group full-width">
            <label for="nombre">Nombre de la Ruta:</label>
            <input type="text" id="nombre" name="nombre" placeholder="Ej: Ruta 4 - Parque Industrial" required>
        </div>

        <div class="form-group">
            <label for="origen">Punto de Origen:</label>
            <select id="origen" name="origen" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                <option value="" disabled selected>-- Selecciona una estación --</option>

                @foreach($estaciones as $estacion)
                    {{-- Guardamos el NOMBRE como valor para tu base de datos --}}
                    <option value="{{ $estacion->nombre_estacion}}">
                        📍 {{ $estacion->nombre_estacion}}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="destino">Punto de Destino:</label>
            <select id="destino" name="destino" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                <option value="" disabled selected>-- Selecciona una estación --</option>

                @foreach($estaciones as $estacion)
                    <option value="{{ $estacion->nombre_estacion}}">
                        🏁 {{ $estacion->nombre_estacion }}
                    </option>
                @endforeach
            </select>
        </div>

    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Guardar Ruta</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
    </div>

</form>
            </div>
        </div>

    </main>

</body>
</html>
