
        // Función para alternar visibilidad de la contraseña
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            const eyeSlashIcon = document.getElementById('eyeSlashIcon');
            const toggleBtn = document.getElementById('togglePassword');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.style.display = 'none';
                eyeSlashIcon.style.display = 'block';
            } else {
                passwordInput.type = 'password';
                eyeIcon.style.display = 'block';
                eyeSlashIcon.style.display = 'none';
            }
        }

        // Función para validar campos y acceder
        function validarYAcceder() {
            const usuario = document.getElementById('usuario').value.trim();
            const password = document.getElementById('password').value.trim();
            const notificacion = document.getElementById('notificacion');

            if (usuario === '' || password === '') {
                // Mostrar notificación
                notificacion.style.display = 'block';
                notificacion.style.opacity = '1';
                notificacion.style.transform = 'translateY(0)';

                // Ocultar después de 3 segundos
                setTimeout(() => {
                    notificacion.style.opacity = '0';
                    notificacion.style.transform = 'translateY(-10px)';
                    setTimeout(() => {
                        notificacion.style.display = 'none';
                    }, 300);
                }, 3000);

                return; // No acceder
            }

            // Si todo está bien, redirigir
            window.location.href = '../Formularios/IndexDashboard.blade.php';
        }