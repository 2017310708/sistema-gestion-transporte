@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="max-w-3xl mx-auto">
        <div class="md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    Nuevo Conductor
                </h2>
            </div>
            <div class="mt-4 flex md:mt-0 md:ml-4">
                <a href="{{ route('admin.drivers.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Volver
                </a>
            </div>
        </div>

        <form action="{{ route('admin.drivers.store') }}" method="POST" class="mt-8 space-y-6">
            @csrf

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-1 gap-6">
                        <div class="col-span-1">
                            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('nombre') }}" required>
                            @error('nombre')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-1">
                            <label for="apellido_paterno" class="block text-sm font-medium text-gray-700">Apellido Paterno</label>
                            <input type="text" name="apellido_paterno" id="apellido_paterno" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('apellido_paterno') }}" required>
                            @error('apellido_paterno')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-1">
                            <label for="apellido_materno" class="block text-sm font-medium text-gray-700">Apellido Materno</label>
                            <input type="text" name="apellido_materno" id="apellido_materno" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('apellido_materno') }}" required>
                            @error('apellido_materno')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-1">
                            <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                            <input type="email" name="email" id="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('email') }}" required>
                            @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-1">
                            <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                            <input type="password" name="password" id="password" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-1">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Contraseña</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>

                        <div class="col-span-1">
                            <label for="licencia" class="block text-sm font-medium text-gray-700">Número de Licencia</label>
                            <input type="text" name="licencia" id="licencia" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('licencia') }}" required>
                            @error('licencia')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-1">
                            <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                            <input type="tel" name="telefono" id="telefono" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('telefono') }}" required>
                            @error('telefono')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-1">
                            <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                            <select name="estado" id="estado" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                <option value="disponible" {{ old('estado') == 'disponible' ? 'selected' : '' }}>Disponible</option>
                                <option value="en_ruta" {{ old('estado') == 'en_ruta' ? 'selected' : '' }}>En Ruta</option>
                                <option value="descanso" {{ old('estado') == 'descanso' ? 'selected' : '' }}>Descanso</option>
                            </select>
                            @error('estado')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="fas fa-save mr-2"></i>
                        Guardar Conductor
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection 