<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Asignar Viaje - Sistema Integral</title>

    <link rel="stylesheet" href="{{ asset('css/style.AgregarRuta.css') }}">

    <style>
        .alert-error {
            background-color: #fee2e2;
            border-left: 4px solid #ef4444;
            color: #b91c1c;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .text-danger { color: #dc2626; font-size: 0.9em; font-weight: bold; margin-top: 5px; display: block; }
    </style>
</head>
<body>

    <header class="header-container">
        <div class="header-content">
            <div class="logo-and-text">
                <div class="logo-placeholder"></div>
                <div class="text-group">
                    <h1 class="main-title">Sistema Integral de Gestión</h1>
                    <p class="subtitle">Logística y Envíos</p>
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
            <h2>Asignar Nuevo Viaje</h2>
        </div>

        <div class="card">

            <div class="card-header">
                <h3>📋 Programación de Ruta</h3>
            </div>

            <div class="card-body">

                @if ($errors->any())
                    <div class="alert-error">
                        <ul style="margin: 0; padding-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('viajes.store') }}" method="POST">
                    @csrf

                    <div class="form-grid">

                        <div class="form-group">
                            <label for="chofer">👨‍✈️ Chofer Disponible:</label>
                            <select name="id_empleado" id="chofer" required>
                                <option value="" disabled selected>-- Selecciona un conductor --</option>
                                @forelse($transportistas as $chofer)
                                    <option value="{{ $chofer->id_empleado }}">
                                        {{ $chofer->nombres }} {{ $chofer->apellidos }} (No. {{ $chofer->no_empleado }})
                                    </option>
                                @empty
                                    <option disabled>❌ No hay choferes disponibles</option>
                                @endforelse
                            </select>

                            @if($transportistas->isEmpty())
                                <small class="text-danger">¡Alerta! Todos los choferes están ocupados.</small>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="unidad">🚛 Unidad Disponible:</label>
                            <select name="id_transporte" id="unidad" required>
                                <option value="" disabled selected>-- Selecciona un vehículo --</option>
                                @forelse($unidades as $unidad)
                                    <option value="{{ $unidad->id_transporte }}">
                                        {{ $unidad->marca }} {{ $unidad->modelo }} [{{ $unidad->placas }}]
                                    </option>
                                @empty
                                    <option disabled>❌ No hay unidades disponibles</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="ruta">📍 Ruta de Destino:</label>
                            <select name="id_ruta" id="ruta" required>
                                <option value="" disabled selected>-- Selecciona el destino --</option>
                                @foreach($rutas as $ruta)
                                    <option value="{{ $ruta->id_ruta }}">
                                        {{ $ruta->nombre }} ({{ $ruta->origen }} ➝ {{ $ruta->destino }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="fecha">📅 Fecha de Salida:</label>
                            <input type="date" id="fecha" name="fecha_programada"
                                   value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}" required>
                        </div>

                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary"
                            @if($transportistas->isEmpty() || $unidades->isEmpty())
                                disabled style="opacity: 0.6; cursor: not-allowed;"
                            @endif>
                            💾 Confirmar Asignación
                        </button>

                        {{-- <a href="{{ route('viajes.index') }}" class="btn btn-secondary">Cancelar</a> --}}
                    </div>

                </form>
            </div>
        </div>

    </main>

</body>
</html>
