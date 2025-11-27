const fingerprint = document.getElementById("fingerprint");
const pressAnimation = fingerprint.querySelector(".press-animation");
const status = document.getElementById("status");

let timer;

fingerprint.addEventListener("mousedown", () => {

    status.textContent = "Verificando...";
    pressAnimation.classList.add("active");

    const holdTime = Math.floor(Math.random() * 3) + 1;

    timer = setTimeout(() => {

        fetch("/asistencias/verificarT", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(r => r.json())
        .then(data => {

            if (data.accion === "espera") {
                Swal.fire({
                    icon: "info",
                    title: "Espera un momento",
                    text: `Debes esperar 3 minutos para registrar salida.`,
                    confirmButtonColor: "#1e40af"
                });
                return;
            }

            if (data.accion === "entrada") {
                window.location.href = "/asistencias/camaraT?tipo=entrada";
                return;
            }

            if (data.accion === "salida") {
                window.location.href = "/asistencias/camaraT?tipo=salida";
                return;
            }

            if (data.accion === "terminado") {
                Swal.fire({
                    icon: "warning",
                    title: "Ya registraste asistencia",
                    text: "Hoy ya se registró entrada y salida.",
                    confirmButtonColor: "#1e40af"
                });
            }

        });

    }, holdTime * 1000);
});

fingerprint.addEventListener("mouseup", () => {
    clearTimeout(timer);
    pressAnimation.classList.remove("active");
});
