<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style_Reportes.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style_Menu.css') }}">
    <title>Reportes y Análisis</title>
</head>
<body>

    <!-- Encabezado principal -->
    <header class="header-container">
        <div class="header-content">
            <div class="logo-and-text">
                <div class="logo-placeholder"></div>
                <div class="text-group">
                    <h1 class="main-title">Sistema integral de gestión</h1>
                    <p class="subtitle">Control de Personal y Asistencia</p>
                </div>
            </div>
            <div class="user-info">
                <span class="user-role">Admin Usuario</span>
                <div class="user-icon"></div>
            </div>
        </div>
    </header>

<!-- Menú hamburguesa -->
<div class="menu-container" id="menuContainer">
    <div class="menu-header">
        <div class="arrow" id="closeMenu">→</div>
        <h2>Menú</h2>
    </div>
    <div class="menu-items">
        <div class="menu-item" data-link="../Formularios/IndexDashboard.php">
            <div class="icon dashboard">
                <svg viewBox="0 0 24 24">
                    <rect x="3" y="3" width="8" height="8"/>
                    <rect x="13" y="3" width="8" height="8"/>
                    <rect x="3" y="13" width="8" height="8"/>
                    <rect x="13" y="13" width="8" height="8"/>
                </svg>
            </div>
            <span>Dashboard</span>
        </div>
        <div class="menu-item" data-link="../Formularios/IndexAsistencia.blade.php">
            <div class="icon">
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" fill="none" stroke="#FF8B00" stroke-width="2"/>
                    <polyline points="12,6 12,12 16,14" fill="none" stroke="#FF8B00" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>
            <span>Asistencia</span>
        </div>
        <div class="menu-item" data-link="../Formularios/IndexPersonal.blade.php">
            <div class="icon">
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="7" r="4"/>
                    <path d="M5,21 C5,16.5 8,14 12,14 C16,14 19,16.5 19,21"/>
                </svg>
            </div>
            <span>Personal</span>
        </div>
        <div class="menu-item" data-link="../Formularios/IndexEstaciones.blade.php">
            <div class="icon">
                <svg viewBox="0 0 24 24">
                    <path d="M12 2L2 7v3c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
                    <path d="M12 7c-2.21 0-4 1.79-4 4h2c0-1.1.9-2 2-2s2 .9 2 2c0 2-3 1.75-3 5h2c0-2.25 3-2.5 3-5 0-2.21-1.79-4-4-4z" fill="#7D848C"/>
                    <circle cx="12" cy="17" r="1" fill="#7D848C"/>
                </svg>
            </div>
            <span>Estaciones</span>
        </div>
        <div class="menu-item" data-link="../Formularios/IndexUnidades.blade.php">
            <div class="icon">
                <svg viewBox="0 0 24 24">
                    <path d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4z"/>
                    <circle cx="6" cy="17" r="2" fill="#7D848C"/>
                    <circle cx="18" cy="17" r="2" fill="#7D848C"/>
                    <path d="M17 8V4l3 4h-3z" fill="#7D848C"/>
                </svg>
            </div>
            <span>Unidades</span>
        </div>
        <div class="menu-item" data-link="../Formularios/IndexReportes.blade.php">
            <div class="icon">
                <svg viewBox="0 0 24 24">
                    <rect x="5" y="4" width="14" height="17" rx="1"/>
                    <line x1="9" y1="8" x2="15" y2="8" stroke="#7D848C" stroke-width="1.5"/>
                    <line x1="9" y1="12" x2="15" y2="12" stroke="#7D848C" stroke-width="1.5"/>
                    <line x1="9" y1="16" x2="13" y2="16" stroke="#7D848C" stroke-width="1.5"/>
                </svg>
            </div>
            <span>Reportes</span>
        </div>
    </div>
    <button class="logout-btn" id="logoutBtn">Cerrar Sesión</button>
</div>


    <!-- Encabezado página -->
    <div class="page-header">
        <div class="page-header-content">
            <div class="title-group">
                <h2 class="page-title">Reportes y análisis</h2>
                <p class="page-subtitle">Generación automática de reportes en Excel y PDF con análisis detallado</p>
            </div>
            <button class="menu-btn" id="menuBtn">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>

    <!-- Dashboard -->
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-section">
                <h3 class="section-title">Tipos de reporte</h3>
                <div class="report-options-group">
                    <div class="report-option active" data-value="asistencia">
                        <div class="icon-placeholder orange"></div>
                        <span>Asistencia y Puntualidad</span>
                    </div>
                </div>
            </div>

            <div class="sidebar-section">
                <h3 class="section-title">Periodo</h3>
                <div class="period-select-container">
                    <select class="period-select" id="selectPeriodo" name="periodo">
                        <option value="Semana" {{ $periodo === 'Semana' ? 'selected' : '' }}>Semana</option>
                        <option value="Mes"    {{ $periodo === 'Mes' ? 'selected' : '' }}>Mes</option>
                        <option value="Año"    {{ $periodo === 'Año' ? 'selected' : '' }}>Año</option>
                    </select>
                </div>
            </div>

            <div class="sidebar-buttons">
                <button class="export-btn pdf" id="btnPDF">Exportar en PDF</button>
                <button class="export-btn excel" id="btnExcel">Exportar en Excel</button>
            </div>
        </aside>

        <!-- Main -->
        <main class="main-content">
            <h2 class="main-content-title">Resumen de Asistencia</h2>
            <div class="summary-cards">
                <div class="summary-card">
                    <div class="card-value"> {{ $presentes }} </div>
                    <div class="card-label">Presentes</div>
                </div>
                <div class="summary-card">
                    <div class="card-value"> {{ $tardanzas }} </div>
                    <div class="card-label">Tardanzas</div>
                </div>
                <div class="summary-card">
                    <div class="card-value"> {{ $ausentes }} </div>
                    <div class="card-label">Ausentes</div>
                </div>
                <div class="summary-card">
                    <div class="card-value"> {{ $puntualidad }}% </div>
                    <div class="card-label">Puntualidad</div>
                </div>
            </div>

            <div class="employee-table-container">
                <table class="employee-table">
                    <thead>
                        <tr>
                            <th>Empleado</th>
                            <th>Entrada</th>
                            <th>Salida</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($asistencia as $row)
                            <tr>
                                <td>
                                    <div class="employee-info">
                                        <div class="profile-pic"></div>
                                        {{ $row->nombres }} {{ $row->apellidos }}
                                    </div>
                                </td>

                                <td>{{ $row->hora_entrada ?? '---' }}</td>
                                <td>{{ $row->hora_salida ?? '---' }}</td>

                                <td class="status-cell">
                                    <div class="status-container">

                                        @if ($row->status_asistencia === 'Tarde')
                                            <span class="status red-x">Tarde</span>

                                        @elseif ($row->status_asistencia === 'Falta')
                                            <span class="status red-x">Falta</span>

                                        @elseif ($row->status_asistencia === 'A tiempo')
                                            <span class="status green-check">A tiempo</span>

                                        @else
                                            <span class="status">{{ $row->status_asistencia }}</span>
                                        @endif

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <div id="overlay" class="overlay"></div>
    <div id="page-transition" class="page-transition"></div>

    <!-- JS -->
    <script src="{{ asset('js/Anim_Menu.js') }}"></script>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const selectPeriodo = document.getElementById("selectPeriodo");

        // Recargar dashboard al cambiar periodo
        selectPeriodo.addEventListener("change", function () {
            const periodo = selectPeriodo.value;
            window.location.href = `/reportes?periodo=${periodo}`;
        });

        // Botón PDF
        document.getElementById("btnPDF").addEventListener("click", function () {
            const periodo = selectPeriodo.value;
            window.location.href = `/reportes/pdf/${periodo}`;
        });

        // Botón Excel
        document.getElementById("btnExcel").addEventListener("click", function () {
            const periodo = selectPeriodo.value;
            window.location.href = `/reportes/excel/${periodo}`;
        });
    });
</script>


</html>
