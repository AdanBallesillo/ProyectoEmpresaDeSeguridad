<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Credenciales de acceso</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f8f8f8; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: white; padding: 20px; border-radius: 10px;">
        <h2 style="color: #FF8B00; text-align: center;">Bienvenido a SIASEG</h2>
        <p>Hola <strong>{{ $nombre }}</strong>,</p>
        <p>Tu registro ha sido procesado correctamente. A continuación, te compartimos tus credenciales de acceso:</p>

        <table style="width: 100%; margin-top: 10px; border-collapse: collapse;">
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd;">Número de control:</td>
                <td style="padding: 8px; border: 1px solid #ddd;"><strong>{{ $noEmpleado }}</strong></td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd;">Contraseña:</td>
                <td style="padding: 8px; border: 1px solid #ddd;"><strong>{{ $password }}</strong></td>
            </tr>
        </table>

        <p style="margin-top: 20px;">Por favor, utiliza estas credenciales para <a href="siaseg.site"> iniciar sesión en el sistema.</a></p>

        <p style="margin-top: 30px; text-align: center;">Atentamente,<br>Equipo de SIASEG</p>
    </div>
</body>
</html>
