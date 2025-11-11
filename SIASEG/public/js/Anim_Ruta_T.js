// ======================================================================
// 1. LÓGICA DE ANIMACIÓN DE PÁGINA
// ======================================================================

document.addEventListener('DOMContentLoaded', () => {
    // Remover fade-out al cargar la página (efecto fade-in)
    document.body.classList.remove('fade-out');

    // Inicia el reloj
    actualizarReloj();
    setInterval(actualizarReloj, 1000);
});

// ======================================================================
// 2. LÓGICA DEL RELOJ
// ======================================================================

function actualizarReloj() {
    const now = new Date();

    // Formato hora
    const timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
    const timeText = now.toLocaleTimeString('es-MX', timeOptions);

    // Formato fecha
    const dayOfWeek = now.toLocaleDateString('es-MX', { weekday: 'long' });
    const dayOfMonth = now.toLocaleDateString('es-MX', { day: 'numeric' });
    const month = now.toLocaleDateString('es-MX', { month: 'long' });
    const year = now.toLocaleDateString('es-MX', { year: 'numeric' });

    const finalDate = 
        dayOfWeek.charAt(0).toUpperCase() + dayOfWeek.slice(1) +
        `, ${dayOfMonth} de ${month} del ${year}`;

    // Actualiza en index.html
    const timeElementIndex = document.querySelector('.time');
    const dateElementIndex = document.querySelector('.date');

    if (timeElementIndex && dateElementIndex) {
        timeElementIndex.textContent = timeText;
        dateElementIndex.textContent = finalDate;
    }

    // Actualiza en card.blade.php si el modal está abierto
    const timeElementCard = document.querySelector('.time-card');
    const dateElementCard = document.querySelector('.date-card');

    if (timeElementCard && dateElementCard) {
        timeElementCard.textContent = timeText;
        dateElementCard.textContent = finalDate;
    }
}

// ======================================================================
// 3. LÓGICA DEL MODAL PARA CARD
// ======================================================================

// Abrir modal
function abrirModal() {
    const modal = document.getElementById('modalCard');
    const modalBody = document.getElementById('modal-body');

    // Traer contenido de card.blade.php
    fetch('../Formularios/IndexCard.blade.php')
        .then(response => response.text())
        .then(html => {
            modalBody.innerHTML = html;
            modal.style.display = 'block';
        })
        .catch(err => console.error('Error al cargar el formulario:', err));
}

// Cerrar modal
function cerrarModal() {
    const modal = document.getElementById('modalCard');
    const modalBody = document.getElementById('modal-body');
    modal.style.display = 'none';
    modalBody.innerHTML = ''; // Limpiar contenido
}

// Cerrar modal si se hace clic fuera del contenido
window.onclick = function(event) {
    const modal = document.getElementById('modalCard');
    if (event.target === modal) {
        cerrarModal();
    }
}

// ======================================================================
// 4. ANIMACIÓN FADE-OUT (opcional si quieres cerrar página con efecto)
// ======================================================================

function fadeOutYRedir(url) {
    document.body.classList.add('fade-out');
    setTimeout(() => {
        window.location.href = url;
    }, 400); // Coincide con la transición CSS
}
