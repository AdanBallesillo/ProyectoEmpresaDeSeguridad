<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambio de Contraseña - SIASEG</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">

        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Bienvenido a SIASEG</h2>
            <p class="text-sm text-gray-600 mt-2">
                Por seguridad, necesitas configurar una nueva contraseña personal para continuar.
            </p>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 relative">
                <strong class="font-bold">¡Ups!</strong>
                <ul class="list-disc pl-5 mt-1 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('first-login.update') }}" method="POST">
            @csrf <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Nueva Contraseña
                </label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500"
                    placeholder="Mínimo 8 caracteres"
                    required
                >
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">
                    Confirmar Nueva Contraseña
                </label>
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500"
                    placeholder="Repite la contraseña"
                    required
                >
                <p class="text-xs text-gray-500 mt-1">Asegúrate de que coincidan.</p>
            </div>

            <div class="flex items-center justify-between">
                <button
                    type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300"
                >
                    Guardar y Entrar
                </button>
            </div>
        </form>

    </div>

</body>
</html>
