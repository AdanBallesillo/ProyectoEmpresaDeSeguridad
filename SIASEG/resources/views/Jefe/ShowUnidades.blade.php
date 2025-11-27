<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset ('css/style_Personal.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/style_Menu.css') }}">
    <title>Control de Unidades</title>
</head>

<body>

    <!-- HEADER -->
    <header class="header-container" style="position: relative;">
        <div class="header-content">
            <div class="logo-and-text">
                <div class="logo-placeholder"></div>
                <div class="text-group">
                    <h1 class="main-title">Sistema integral de gestión</h1>
                    <p class="subtitle">Control de Unidades</p>
                </div>
            </div>
            <div class="user-info">
                <span class="user-role">Admin Usuario</span>
                <div class="user-icon"></div>
            </div>
        </div>
    </header>


    <!-- SUBHEADER -->
    <div class="sub-header" style="display: flex; justify-content: right; padding: 1rem;">
        <button class="menu-btn" id="menuBtn">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
    {{-- @include('menu') --}}

    <!-- CONTENIDO PRINCIPAL -->
    <div class="main-content">

        <div class="top-bar">
            <div class="title-group">
                <h2 class="page-title">Control de Unidades</h2>
                <p class="page-subtitle">Listado general de unidades registradas</p>
            </div>

            <button class="new-employee-button" id="btnNuevaUnidad">Nueva Unidad</button>
        </div>



        <!-- Barra de búsqueda -->
        <div class="search-bar" style="margin-bottom: 20px;  display: flex; justify-content: center; width: 100%; ">
            <form action="{{ route('mostrartodasunidades') }}" method="GET" style="display: flex; width: 100%; max-width: 700px; gap: 10px;">
                <input type="text" name="busqueda" placeholder="Buscar unidad..."
                    value="{{ request('busqueda') }}"
                    style="flex: 1; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
                <button type="submit" style="padding: 10px 20px; border: none; background: #FF8B00; color: white; border-radius: 5px;">
                    Buscar
                </button>
            </form>
        </div>

        <!-- Tabla -->
        <div class="table-container">
            <table class="personnel-table">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Placas</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Año</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($unidades as $u)
                    <tr>
                        <td>{{ $u->tipo }}</td>
                        <td>{{ $u->placas }}</td>
                        <td>{{ $u->marca }}</td>
                        <td>{{ $u->modelo }}</td>
                        <td>{{ $u->anio }}</td>
                        <td>{{ $u->status }}</td>

                        <td class="actions-cell">
                            <button class="action-button modify-button"
                                data-id="{{ $u->id_transporte }}">
                                Modificar
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align:center;">No hay unidades registradas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Paginación --}}
            <div class="pagination-container" style="margin-top: 15px; text-align:center; margin-bottom: 10px;">
                <div style="margin-bottom: 5px; margin-left: 5px; font-size: 14px; color: #555;">
                    Mostrando página {{ $unidades->currentPage() }} de {{ $unidades->lastPage() }}
                    ( Total: {{ $unidades->total() }} registros )
                </div>

                {{ $unidades->appends(['busqueda' => request('busqueda')])->onEachSide(1)->links('pagination::simple-tailwind') }}
            </div>
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('Java/Anim_Menu.js') }}"></script>

    <script>
        // Redirigir a crear nueva unidad
        document.getElementById('btnNuevaUnidad').addEventListener('click', function() {
            window.location.href = "{{ route('nuevasunidades') }}";
        });

        // Botón modificar
        document.querySelectorAll('.modify-button').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.dataset.id;
                const url = "{{ route('unidades.edit', ['id' => ':id']) }}".replace(':id', id);
                window.location.href = url;
            });
        });
    </script>

</body>

</html>