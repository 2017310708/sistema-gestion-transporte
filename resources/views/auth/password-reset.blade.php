<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña - Sistema de Gestión de Transporte</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full space-y-8 p-8 bg-white rounded-lg shadow-lg">
            <div class="text-center">
                <a href="/" class="flex items-center justify-center mb-6">
                    <i class="fas fa-truck text-4xl text-indigo-600 mr-2"></i>
                    <span class="text-2xl font-bold text-gray-900">GesTran</span>
                </a>
                <h2 class="text-3xl font-extrabold text-gray-900">
                    Restablecer Contraseña
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Por favor, selecciona tu tipo de usuario y proporciona los datos solicitados.
                </p>
            </div>

            @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">
                            {{ $errors->first() }}
                        </p>
                    </div>
                </div>
            </div>
            @endif

            <form class="mt-8 space-y-6" action="{{ route('password.verify') }}" method="POST">
                @csrf
                <div class="rounded-md shadow-sm space-y-4">
                    <div>
                        <label for="tipo_usuario" class="block text-sm font-medium text-gray-700">
                            Tipo de Usuario
                        </label>
                        <select id="tipo_usuario" name="tipo_usuario" required
                            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            onchange="toggleFields()">
                            <option value="">Selecciona un tipo</option>
                            <option value="cliente">Cliente</option>
                            <option value="conductor">Conductor</option>
                        </select>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Correo Electrónico
                        </label>
                        <input id="email" name="email" type="email" required 
                            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="ejemplo@correo.com">
                    </div>

                    <!-- Campos para Cliente -->
                    <div id="cliente-fields" class="hidden space-y-4">
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-gray-700">
                                Nombre
                            </label>
                            <input id="nombre" name="nombre" type="text"
                                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                placeholder="Tu nombre">
                        </div>
                        <div>
                            <label for="apellido_paterno" class="block text-sm font-medium text-gray-700">
                                Apellido Paterno
                            </label>
                            <input id="apellido_paterno" name="apellido_paterno" type="text"
                                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                placeholder="Tu apellido paterno">
                        </div>
                        <div>
                            <label for="apellido_materno" class="block text-sm font-medium text-gray-700">
                                Apellido Materno
                            </label>
                            <input id="apellido_materno" name="apellido_materno" type="text"
                                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                placeholder="Tu apellido materno">
                        </div>
                    </div>

                    <!-- Campos para Conductor -->
                    <div id="conductor-fields" class="hidden space-y-4">
                        <div>
                            <label for="dni" class="block text-sm font-medium text-gray-700">
                                DNI
                            </label>
                            <input id="dni" name="dni" type="text"
                                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                placeholder="Tu número de DNI">
                        </div>
                        <div>
                            <label for="licencia" class="block text-sm font-medium text-gray-700">
                                Número de Licencia
                            </label>
                            <input id="licencia" name="licencia" type="text"
                                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                placeholder="Tu número de licencia">
                        </div>
                        <div>
                            <label for="telefono" class="block text-sm font-medium text-gray-700">
                                Teléfono
                            </label>
                            <input id="telefono" name="telefono" type="text"
                                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                placeholder="Tu número de teléfono">
                        </div>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-lock text-indigo-500 group-hover:text-indigo-400"></i>
                        </span>
                        Verificar Identidad
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleFields() {
            const tipoUsuario = document.getElementById('tipo_usuario').value;
            const clienteFields = document.getElementById('cliente-fields');
            const conductorFields = document.getElementById('conductor-fields');

            clienteFields.classList.add('hidden');
            conductorFields.classList.add('hidden');

            if (tipoUsuario === 'cliente') {
                clienteFields.classList.remove('hidden');
            } else if (tipoUsuario === 'conductor') {
                conductorFields.classList.remove('hidden');
            }
        }
    </script>
</body>
</html> 