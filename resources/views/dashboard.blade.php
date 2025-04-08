<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema de Gestión de Transporte</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-indigo-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-truck text-white text-2xl"></i>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <a href="#" class="text-white px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                            @if($role === 'admin')
                            <a href="{{ route('admin.users.index') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Usuarios</a>
                            <a href="{{ route('admin.vehicles.index') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Vehículos</a>
                            <a href="{{ route('admin.drivers.index') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Conductores</a>
                            <a href="{{ route('admin.routes.index') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Rutas</a>
                            <a href="{{ route('admin.orders.index') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Pedidos</a>
                            @elseif($role === 'conductor')
                            <a href="{{ route('driver.routes.current') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Mis Rutas</a>
                            <a href="{{ route('driver.incidents.create') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Reportar Incidente</a>
                            <a href="{{ route('driver.fuel.create') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Registrar Combustible</a>
                            @elseif($role === 'cliente')
                            <a href="{{ route('client.orders.index') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Mis Pedidos</a>
                            <a href="{{ route('client.orders.create') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Nuevo Pedido</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="ml-4 flex items-center md:ml-6">
                        <button class="p-1 rounded-full text-gray-200 hover:text-white focus:outline-none">
                            <i class="fas fa-bell"></i>
                        </button>
                        <div class="ml-3 relative">
                            <div class="flex items-center">
                                <span class="text-white mr-2">{{ $user->nombre }} {{ $user->apellido_paterno }} {{ $user->apellido_materno }}</span>
                                <form action="{{ route('logout') }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-gray-300 hover:text-white">
                                        <i class="fas fa-sign-out-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">
                Dashboard
                <span class="text-sm font-normal text-gray-500 ml-2">({{ ucfirst($role) }})</span>
            </h1>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        @if(Auth::user()->rol === 'admin')
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-2xl font-semibold mb-6">Panel de Administración</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Gestión de Vehículos -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                                    <i class="fas fa-truck text-white text-2xl"></i>
                                </div>
                                <div class="ml-5">
                                    <h3 class="text-lg font-medium text-gray-900">Vehículos</h3>
                                    <p class="text-sm text-gray-500">Gestionar flota de vehículos</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('admin.vehicles.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200">
                                    Administrar
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Gestión de Conductores -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                    <i class="fas fa-users text-white text-2xl"></i>
                                </div>
                                <div class="ml-5">
                                    <h3 class="text-lg font-medium text-gray-900">Conductores</h3>
                                    <p class="text-sm text-gray-500">Gestionar conductores</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('admin.drivers.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200">
                                    Administrar
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Gestión de Rutas -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                                    <i class="fas fa-route text-white text-2xl"></i>
                                </div>
                                <div class="ml-5">
                                    <h3 class="text-lg font-medium text-gray-900">Rutas</h3>
                                    <p class="text-sm text-gray-500">Gestionar rutas de transporte</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('admin.routes.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-yellow-700 bg-yellow-100 hover:bg-yellow-200">
                                    Administrar
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Gestión de Pedidos -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                                    <i class="fas fa-box text-white text-2xl"></i>
                                </div>
                                <div class="ml-5">
                                    <h3 class="text-lg font-medium text-gray-900">Pedidos</h3>
                                    <p class="text-sm text-gray-500">Gestionar pedidos de clientes</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-purple-700 bg-purple-100 hover:bg-purple-200">
                                    Administrar
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Gestión de Usuarios -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                    <i class="fas fa-users text-white text-2xl"></i>
                                </div>
                                <div class="ml-5">
                                    <h3 class="text-lg font-medium text-gray-900">Usuarios</h3>
                                    <p class="text-sm text-gray-500">Gestionar usuarios del sistema</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200">
                                    Administrar
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 mt-6">
            @if($role === 'admin')
                <!-- Admin Stats -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-truck text-indigo-600 text-2xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Vehículos</dt>
                                    <dd class="text-3xl font-semibold text-gray-900" title="Total de vehículos registrados">{{ number_format($totalVehiculos) }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-users text-indigo-600 text-2xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Conductores</dt>
                                    <dd class="text-3xl font-semibold text-gray-900" title="Total de conductores activos">{{ number_format($totalConductores) }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-route text-indigo-600 text-2xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Rutas</dt>
                                    <dd class="text-3xl font-semibold text-gray-900" title="Total de rutas registradas">{{ number_format($totalRutas) }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($role === 'conductor')
                <!-- Conductor Stats -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-route text-indigo-600 text-2xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Rutas Asignadas</dt>
                                    <dd class="text-3xl font-semibold text-gray-900">{{ $rutasAsignadas }}</dd>
                                </dl>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('driver.routes.current') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                Ver rutas <span aria-hidden="true">&rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-truck text-indigo-600 text-2xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Vehículo Asignado</dt>
                                    <dd class="text-3xl font-semibold text-gray-900">{{ $vehiculoAsignado }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-clock text-indigo-600 text-2xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Entregas Pendientes</dt>
                                    <dd class="text-3xl font-semibold text-gray-900">{{ $entregasPendientes }}</dd>
                                </dl>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('driver.routes.current') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                Ver entregas <span aria-hidden="true">&rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>
            @elseif($role === 'cliente')
                <!-- Cliente Stats -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-box text-indigo-600 text-2xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Pedidos Activos</dt>
                                    <dd class="text-3xl font-semibold text-gray-900">{{ $pedidosActivos }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-history text-indigo-600 text-2xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Últimos Pedidos</dt>
                                    <dd class="text-3xl font-semibold text-gray-900">{{ $ultimosPedidos }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-route text-indigo-600 text-2xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Rutas en Curso</dt>
                                    <dd class="text-3xl font-semibold text-gray-900">{{ $rutasEnCurso }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Quick Actions -->
        <div class="mt-8">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Acciones Rápidas</h2>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @if($role === 'admin')
                    <a href="{{ route('admin.vehicles.create') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-md transition-shadow duration-300 flex items-center">
                        <i class="fas fa-plus-circle text-indigo-600 text-xl mr-3"></i>
                        <span class="text-gray-700">Agregar Vehículo</span>
                    </a>
                    <a href="{{ route('admin.drivers.create') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-md transition-shadow duration-300 flex items-center">
                        <i class="fas fa-user-plus text-indigo-600 text-xl mr-3"></i>
                        <span class="text-gray-700">Registrar Conductor</span>
                    </a>
                    <a href="{{ route('admin.routes.create') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-md transition-shadow duration-300 flex items-center">
                        <i class="fas fa-map-marked-alt text-indigo-600 text-xl mr-3"></i>
                        <span class="text-gray-700">Crear Nueva Ruta</span>
                    </a>
                @elseif($role === 'conductor')
                    <a href="{{ route('driver.routes.current') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-md transition-shadow duration-300 flex items-center">
                        <i class="fas fa-route text-indigo-600 text-xl mr-3"></i>
                        <span class="text-gray-700">Ver Ruta Actual</span>
                    </a>
                    <a href="{{ route('driver.incidents.create') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-md transition-shadow duration-300 flex items-center">
                        <i class="fas fa-clipboard-list text-indigo-600 text-xl mr-3"></i>
                        <span class="text-gray-700">Reportar Incidente</span>
                    </a>
                    <a href="{{ route('driver.fuel.create') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-md transition-shadow duration-300 flex items-center">
                        <i class="fas fa-gas-pump text-indigo-600 text-xl mr-3"></i>
                        <span class="text-gray-700">Registrar Combustible</span>
                    </a>
                @elseif($role === 'cliente')
                    <a href="{{ route('client.orders.create') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-md transition-shadow duration-300 flex items-center">
                        <i class="fas fa-plus-circle text-indigo-600 text-xl mr-3"></i>
                        <span class="text-gray-700">Nuevo Pedido</span>
                    </a>
                    <a href="{{ route('client.orders.track') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-md transition-shadow duration-300 flex items-center">
                        <i class="fas fa-search text-indigo-600 text-xl mr-3"></i>
                        <span class="text-gray-700">Rastrear Pedido</span>
                    </a>
                    <a href="{{ route('client.orders.history') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-md transition-shadow duration-300 flex items-center">
                        <i class="fas fa-history text-indigo-600 text-xl mr-3"></i>
                        <span class="text-gray-700">Historial de Pedidos</span>
                    </a>
                @endif
            </div>
        </div>
    </main>
</body>
</html>
