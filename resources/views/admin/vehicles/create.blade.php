@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="max-w-3xl mx-auto">
        <div class="md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    Nuevo Vehículo
                </h2>
            </div>
            <div class="mt-4 flex md:mt-0 md:ml-4">
                <a href="{{ route('admin.vehicles.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Volver
                </a>
            </div>
        </div>

        <form action="{{ route('admin.vehicles.store') }}" method="POST" class="mt-8 space-y-6">
            @csrf

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-1 gap-6">
                        <div class="col-span-1">
                            <label for="placa" class="block text-sm font-medium text-gray-700">Placa</label>
                            <input type="text" name="placa" id="placa" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('placa') }}" required>
                            @error('placa')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-1">
                            <label for="marca" class="block text-sm font-medium text-gray-700">Marca</label>
                            <input type="text" name="marca" id="marca" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('marca') }}" required>
                            @error('marca')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-1">
                            <label for="modelo" class="block text-sm font-medium text-gray-700">Modelo</label>
                            <input type="text" name="modelo" id="modelo" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('modelo') }}" required>
                            @error('modelo')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-1">
                            <label for="anio" class="block text-sm font-medium text-gray-700">Año</label>
                            <input type="number" name="anio" id="anio" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('anio') }}" required>
                            @error('anio')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-1">
                            <label for="capacidad" class="block text-sm font-medium text-gray-700">Capacidad (kg)</label>
                            <input type="number" name="capacidad" id="capacidad" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('capacidad') }}" required>
                            @error('capacidad')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-1">
                            <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                            <select name="estado" id="estado" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                                <option value="mantenimiento" {{ old('estado') == 'mantenimiento' ? 'selected' : '' }}>En Mantenimiento</option>
                                <option value="inactivo" {{ old('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            @error('estado')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-1">
                            <label for="observaciones" class="block text-sm font-medium text-gray-700">Observaciones</label>
                            <textarea name="observaciones" id="observaciones" rows="3" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('observaciones') }}</textarea>
                            @error('observaciones')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="fas fa-save mr-2"></i>
                        Guardar Vehículo
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
