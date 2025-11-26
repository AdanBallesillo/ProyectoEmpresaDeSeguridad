const fingerprint = document.getElementById("fingerprint");
const pressAnimation = fingerprint.querySelector(".press-animation");
const status = document.getElementById("status");

let timer;

fingerprint.addEventListener("mousedown", () => {
    status.textContent = "Mantén presionado...";
    pressAnimation.classList.add("active");

    const holdTime = Math.floor(Math.random() * 3) + 1;

    timer = setTimeout(() => {
        status.textContent = "Huella reconocida ✅";
        pressAnimation.classList.remove("active");
        fingerprint.style.filter = "hue-rotate(100deg)";

        fetch("/asistencias/registrar", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            status.textContent = data.mensaje;
        })
        .catch(() => {
            status.textContent = "Error al registrar asistencia ❌";
        });

    }, holdTime * 1000);
});

fingerprint.addEventListener("mouseup", () => {
    clearTimeout(timer);
    pressAnimation.classList.remove("active");
    fingerprint.style.filter = "none";
    status.textContent = "Presión cancelada ❌";
});
