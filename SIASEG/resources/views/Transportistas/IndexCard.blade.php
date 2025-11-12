<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card</title>
    <link rel="stylesheet" href="../Estilos/style_Card.css">
</head>
<body>
    <div class="route-card-wrapper">
    <header class="route-header-card">
        <h1 class="route-title-card">Ruta</h1>
        <div class="route-header-info">
            <span class="date-card">Lunes, 24 de Septiembre del 2025</span>
            <span class="time-card">11:20:23</span>
        </div>
    </header>

    <div class="route-progress-container">
        <div class="route-point-card start">
            <span class="point-label-card">Inicio de la ruta</span>
            <div class="point-details">
                <span class="point-name-card">Almacén 1</span>
            </div>
            <p class="point-time-card">7:00 AM</p>
        </div>

        <div class="route-direction-card">
            <div class="arrow-line">
                <svg width="100%" height="20" viewBox="0 0 100 20" xmlns="http://www.w3.org/2000/svg">
                    <line x1="0" y1="10" x2="90" y2="10" stroke="#333" stroke-width="2" />
                    <polygon points="90,5 100,10 90,15" fill="#333" />
                </svg>
            </div>
        </div>

        <div class="route-point-card end">
            <span class="point-label-card">Fin de la ruta</span>
            <div class="point-details">
                <span class="point-name-card">Almacén 2</span>
            </div>
            <p class="point-time-card">10:00 AM</p>
        </div>
    </div>
    
    <div class="route-actions-card">
        <button class="action-btn-card start-btn-card">Iniciar</button>
        <button class="action-btn-card finish-btn-card" onclick="cerrarRuta()">Finalizar</button>
    </div>
    </div>
    <script src="../Java/js.js"></script>
</body>
</html>