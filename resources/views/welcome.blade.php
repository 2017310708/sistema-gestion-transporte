<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Transporte</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <nav class="bg-indigo-600 text-white shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-truck text-2xl mr-3"></i>
                    <span class="text-xl font-bold">GesTran</span>
                </div>
                @if (Route::has('login'))
                    <div class="hidden md:flex space-x-6">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="hover:text-gray-200">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="hover:text-gray-200">Iniciar Sesión</a>
                            <a href="{{ route('register.client') }}" class="hover:text-gray-200">Registrarse como Cliente</a>
                            <a href="{{ route('register.driver') }}" class="hover:text-gray-200">Registrarse como Conductor</a>
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <div class="relative bg-gradient-to-r from-indigo-600 to-indigo-800">
        <div class="max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">Sistema de Gestión de Transporte</h1>
            <p class="mt-6 text-xl text-indigo-100 max-w-3xl">
                Optimiza tus operaciones de transporte con nuestra plataforma integral. Gestiona flotas, rutas y personal de manera eficiente.
            </p>
            <div class="mt-10 space-x-4">
                <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-white hover:bg-indigo-50">
                    Iniciar Sesión
                    <i class="fas fa-sign-in-alt ml-3"></i>
                </a>
                <a href="{{ route('register.client') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-600">
                    Registrarse como Cliente
                    <i class="fas fa-user-plus ml-3"></i>
                </a>
                <a href="{{ route('register.driver') }}" class="inline-flex items-center px-6 py-3 border border-white text-base font-medium rounded-md text-white hover:bg-indigo-700">
                    Registrarse como Conductor
                    <i class="fas fa-truck ml-3"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Características</h2>
                <p class="mt-2 text-3xl font-extrabold text-gray-900 sm:text-4xl">Todo lo que necesitas para gestionar tu flota</p>
            </div>

            <div class="mt-16">
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="p-6">
                            <div class="text-center">
                                <div class="h-12 w-12 rounded-md bg-indigo-500 text-white inline-flex items-center justify-center mb-4">
                                    <i class="fas fa-truck-moving text-xl"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900">Gestión de Flota</h3>
                                <p class="mt-2 text-base text-gray-500">
                                    Monitoreo en tiempo real de tu flota de vehículos. Control de mantenimiento y rendimiento.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="p-6">
                            <div class="text-center">
                                <div class="h-12 w-12 rounded-md bg-indigo-500 text-white inline-flex items-center justify-center mb-4">
                                    <i class="fas fa-route text-xl"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900">Optimización de Rutas</h3>
                                <p class="mt-2 text-base text-gray-500">
                                    Planificación inteligente de rutas para maximizar la eficiencia y reducir costos.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="p-6">
                            <div class="text-center">
                                <div class="h-12 w-12 rounded-md bg-indigo-500 text-white inline-flex items-center justify-center mb-4">
                                    <i class="fas fa-users text-xl"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900">Gestión de Personal</h3>
                                <p class="mt-2 text-base text-gray-500">
                                    Control de conductores, horarios y asignaciones de manera eficiente.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-indigo-800">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:py-16 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
                <div class="text-center">
                    <p class="text-5xl font-extrabold text-white">100+</p>
                    <p class="mt-2 text-lg font-medium text-indigo-100">Vehículos Gestionados</p>
                </div>
                <div class="text-center">
                    <p class="text-5xl font-extrabold text-white">1000+</p>
                    <p class="mt-2 text-lg font-medium text-indigo-100">Rutas Optimizadas</p>
                </div>
                <div class="text-center">
                    <p class="text-5xl font-extrabold text-white">50+</p>
                    <p class="mt-2 text-lg font-medium text-indigo-100">Clientes Satisfechos</p>
                </div>
                <div class="text-center">
                    <p class="text-5xl font-extrabold text-white">24/7</p>
                    <p class="mt-2 text-lg font-medium text-indigo-100">Soporte Disponible</p>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-gray-900">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">Contacto</h3>
                    <p class="text-gray-400">
                        <i class="fas fa-envelope mr-2"></i> info@GesTran.com<br>
                        <i class="fas fa-phone mr-2"></i> +51 123 456 789<br>
                        <i class="fas fa-map-marker-alt mr-2"></i> Lima, Perú
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">Enlaces Rápidos</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Inicio</a></li>
                        <li><a href="#" class="hover:text-white">Servicios</a></li>
                        <li><a href="#" class="hover:text-white">Nosotros</a></li>
                        <li><a href="#" class="hover:text-white">Contacto</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">Síguenos</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white text-2xl">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white text-2xl">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white text-2xl">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white text-2xl">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
