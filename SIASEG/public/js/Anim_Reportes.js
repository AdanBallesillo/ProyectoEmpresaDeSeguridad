const menuBtn = document.getElementById('menuBtn');
const menuContainer = document.getElementById('menuContainer');
const overlay = document.getElementById('overlay');
const closeMenu = document.getElementById('closeMenu');
const logoutBtn = document.getElementById('logoutBtn');
const transition = document.getElementById('page-transition');

function toggleMenu() {
  menuBtn.classList.toggle('active');
  menuContainer.classList.toggle('active');
  overlay.classList.toggle('active');
}

menuBtn.addEventListener('click', toggleMenu);
overlay.addEventListener('click', toggleMenu);
closeMenu.addEventListener('click', toggleMenu);

// Transición al cambiar de página
document.querySelectorAll('.menu-item').forEach(item => {
  item.addEventListener('click', function() {
    const destino = this.getAttribute('data-link');
    transition.classList.add('active');
    setTimeout(() => {
      window.location.href = destino;
    }, 500);
  });
});

// Botón de cierre de sesión
logoutBtn.addEventListener('click', () => {
  transition.classList.add('active');
  setTimeout(() => {
    window.location.href = "login.html";
  }, 500);
});

// Evita scroll del body cuando el menú está abierto
menuBtn.addEventListener('click', function() {
  document.body.style.overflow = menuContainer.classList.contains('active') ? 'hidden' : 'auto';
});
overlay.addEventListener('click', function() {
  document.body.style.overflow = 'auto';
});

// ------------------------------
// Tipos de reporte como radio buttons
// ------------------------------
const reportOptions = document.querySelectorAll(".report-option");

reportOptions.forEach(option => {
  option.addEventListener("click", () => {
    // Quitar 'active' de todos
    reportOptions.forEach(o => o.classList.remove("active"));
    // Activar solo el seleccionado
    option.classList.add("active");

    const tipo = option.getAttribute("data-value");
    console.log("Reporte seleccionado:", tipo);

    // Aquí podrías actualizar contenido dinámico según el tipo de reporte
  });
});