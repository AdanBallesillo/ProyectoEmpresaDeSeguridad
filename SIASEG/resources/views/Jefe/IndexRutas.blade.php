<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style_Personal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style_Menu.css') }}">
    <title>Gestión de Rutas - Sistema Integral</title>
</head>
<body>
    <header class="header-container" style="position: relative">
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

            <div class="sub-header">
                <button class="menu-btn" id="menuBtn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </header>

    <div class="overlay" id="overlay"></div>

    <div class="menu-container" id="menuContainer">
      <div class="menu-header">
        <div class="arrow" id="closeMenu">→</div>
        <h2>Menú</h2>
      </div>

      <div class="menu-items">
        <div class="menu-item" onclick="window.location.href='{{ url('/dashboard') }}'">
          <div class="icon dashboard">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <rect class="square1" x="3" y="3" width="8" height="8" />
              <rect class="square2" x="13" y="3" width="8" height="8" />
              <rect class="square2" x="3" y="13" width="8" height="8" />
              <rect class="square1" x="13" y="13" width="8" height="8" />
            </svg>
          </div>
          <span>Dashboard</span>
        </div>

        <div class="menu-item" onclick="window.location.href='{{ route('rutas.index') }}'">
            <div class="icon">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" fill="#7D848C"/>
                </svg>
            </div>
            <span>Rutas</span>
        </div>
      </div>

      <button class="logout-btn" id="logoutBtn">Cerrar Sesión</button>
    </div>

    <div class="main-content">
        <div class="top-bar">
            <div class="title-group">
                <h2 class="page-title">Gestión de Rutas</h2>
                <p class="page-subtitle">Administración de trayectos y distancias</p>
            </div>
            <td class="actions-cell">
            <a href="{{ route('rutas.create') }}" class="action-button modify-button" style="text-decoration: none; display: inline-block; text-align: center;">
                Nueva Ruta
            </a>
        </div>

        <div class="table-container">

            <div class="search-bar" style="margin-bottom: 20px; display: flex; justify-content: center; width: 100%; ">
                <form action="{{ route('rutas.index') }}" method="GET" style="display: flex; width: 100%; max-width: 700px; gap: 10px;">
                    <input type="text" name="busqueda" placeholder="Buscar por nombre, origen o destino..."
                        value="{{ request('busqueda') }}"
                        style="flex: 1; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
                    <button type="submit" style="padding: 10px 20px; border: none; background: #FF8B00; color: white; border-radius: 5px; cursor: pointer;">
                        Buscar
                    </button>
                    @if(request('busqueda'))
                        <a href="{{ route('rutas.index') }}" style="padding: 10px 20px; text-decoration: none; background: #0d284e; color: white; border-radius: 5px;">Limpiar</a>
                    @endif
                </form>
            </div>

            <table class="personnel-table">
                <thead>
                    <tr>
                        <th>Nombre de Ruta</th>
                        <th>Origen</th>
                        <th>Destino</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rutas as $ruta)
                        <tr>
                            <td>{{ $ruta->nombre }}</td>
                            <td>{{ $ruta->origen }}</td>
                            <td>{{ $ruta->destino }}</td>
                            <td class="actions-cell">
                                <a href="{{ route('rutas.edit', $ruta->id_ruta) }}" class="action-button modify-button" style="text-decoration: none; display: inline-block; text-align: center;">
                                    Modificar
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center; padding: 20px;">No se encontraron rutas registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Paginación --}}
            <div class="pagination-container" style="margin-top: 15px; margin-bottom: 10px;">
                <div style="margin-bottom: 5px; font-size: 14px; color: #555; text-align: center;">
                    Mostrando página {{ $rutas->currentPage() }} de {{ $rutas->lastPage() }}
                    ( Total: {{ $rutas->total() }} registros )
                </div>

                <div class="pagination-container">
                    {{ $rutas->appends(['busqueda' => request('busqueda')])->links('pagination::simple-tailwind') }}
                </div>
            </div>

        </div>
    </div>

    <script src="{{ asset('js/Anim_Menu.js') }}"></script>
</body>
</html>
