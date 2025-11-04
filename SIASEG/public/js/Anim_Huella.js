const fingerprint = document.getElementById("fingerprint");
const pressAnimation = fingerprint.querySelector(".press-animation");
const status = document.getElementById("status");

let timer;

fingerprint.addEventListener("mousedown", () => {
  status.textContent = "Mantén presionado...";
  pressAnimation.classList.add("active");

  // Tiempo aleatorio de 1 a 3 segundos
  const holdTime = Math.floor(Math.random() * 3) + 1;

  timer = setTimeout(() => {
    status.textContent = "Huella reconocida ✅";
    fingerprint.style.filter = "hue-rotate(100deg)";
    pressAnimation.classList.remove("active");

    // Redirigir después de 1s
    setTimeout(() => {
      window.location.href = "../Formularios/Frm_VistaEmpleados.php"; // Cambia al formulario que necesites
    }, 0);
  }, holdTime * 1000);
});

fingerprint.addEventListener("mouseup", () => {
  clearTimeout(timer);
  pressAnimation.classList.remove("active");
  fingerprint.style.filter = "none";
  status.textContent = "Presión cancelada ❌";
});
