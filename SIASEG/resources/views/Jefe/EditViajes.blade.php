<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Viaje - Sistema Integral</title>

    <link rel="stylesheet" href="{{ asset('css/style.AgregarRuta.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style_Menu.css') }}">

    <style>
        .alert-error {
            background-color: #fee2e2;
            border-left: 4px solid #ef4444;
            color: #b91c1c;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .status-badge-header {
            background-color: #e0e0e0;
            color: #333;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 14px;
            margin-left: 10px;
            font-weight: normal;
        }
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

    <div class="menu-trigger-container">
        <button class="menu-btn-floating" id="menuBtn">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>

    <div class="overlay" id="overlay"></div>
    <div class="menu-container" id="menuContainer">
        <div class="menu-header">
            <div class="arrow" id="closeMenu">→</div>
            <h2>Menú</h2>
        </div>
        <div class="menu-items">
            <div class="menu-item" onclick="window.location.href='{{ url('/dashboard') }}'">
                <div class="icon dashboard">
                    <svg viewBox="0 0 24 24"><rect class="square1" x="3" y="3" width="8" height="8" /><rect class="square2" x="13" y="3" width="8" height="8" /><rect class="square2" x="3" y="13" width="8" height="8" /><rect class="square1" x="13" y="13" width="8" height="8" /></svg>
                </div>
                <span>Dashboard</span>
            </div>
        </div>
        <button class="logout-btn" id="logoutBtn">Cerrar Sesión</button>
    </div>

    <div class="main-content">

        <div class="sub-header">
            <h2>Gestión de Viajes</h2>
        </div>

        <div class="card">

            <div class="card-header">
                <h3>
                    ✏️ Editar Viaje #{{ $viaje->id_viaje }}
                    <span class="status-badge-header">Estado actual: {{ $viaje->estado }}</span>
                </h3>
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

                <form action=" {{ route('viajes.update', $viaje -> id_viaje) }} " method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-grid">

                        <div class="form-group">
                            <label>Chofer Asignado:</label>
                            <select name="id_empleado" required>
                                @foreach($choferes as $chofer)
                                    <option value="{{ $chofer->id_empleado }}"
                                        {{ $viaje->empleado_id == $chofer->id_empleado ? 'selected' : '' }}>
                                        {{ $chofer->nombres }} {{ $chofer->apellidos }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Unidad Asignada:</label>
                            <select name="id_transporte" required>
                                @foreach($unidades as $unidad)
                                    <option value="{{ $unidad->id_transporte }}"
                                        {{ $viaje->transporte_id == $unidad->id_transporte ? 'selected' : '' }}>
                                        {{ $unidad->marca }} [{{ $unidad->placas }}]
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Ruta:</label>
                            <select name="id_ruta" required>
                                @foreach($rutas as $ruta)
                                    <option value="{{ $ruta->id_ruta }}"
                                        {{ $viaje->ruta_id == $ruta->id_ruta ? 'selected' : '' }}>
                                        {{ $ruta->nombre }} ({{ $ruta->destino }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Fecha Programada:</label>
                            <input type="date" name="fecha_programada"
                                   value="{{ $viaje->fecha_programada }}" required>
                        </div>

                        <div class="form-group full-width status-container">
                            <label class="status-title">Estatus del Viaje:</label>

                            <select name="estado" style="max-width: 100%;">
                                <option value="pendiente" {{ $viaje->estado == 'pendiente' ? 'selected' : '' }}>🕒 Pendiente</option>
                                <option value="cancelado" {{ $viaje->estado == 'cancelado' ? 'selected' : '' }} style="color: red; font-weight: bold;">🚫 Cancelar Viaje</option>

                                @if($viaje->estado == 'en_curso')
                                    <option value="en_curso" selected>🚚 En Curso (No modificar manual)</option>
                                @endif
                            </select>

                            <p class="helper-text">* Si cancelas, se liberarán el chofer y la unidad automáticamente.</p>
                        </div>

                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">💾 Guardar Cambios</button>
                        <a href="{{ route('viajes.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>

                </form>
            </div>
        </div>

    </div>

    <script src="{{ asset('js/Anim_Menu.js') }}"></script>
    <script>
        // Lógica del menú
        const menuBtn = document.getElementById('menuBtn');
        const menuContainer = document.getElementById('menuContainer');
        const overlay = document.getElementById('overlay');
        const closeMenu = document.getElementById('closeMenu');

        function toggleMenu() {
            if(menuBtn) menuBtn.classList.toggle('active');
            if(menuContainer) menuContainer.classList.toggle('active');
            if(overlay) overlay.classList.toggle('active');
        }

        if(menuBtn) menuBtn.addEventListener('click', toggleMenu);
        if(closeMenu) closeMenu.addEventListener('click', toggleMenu);
        if(overlay) overlay.addEventListener('click', toggleMenu);
    </script>
</body>
</html>
