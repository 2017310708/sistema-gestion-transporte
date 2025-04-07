@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="max-w-3xl mx-auto">
        <div class="md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    Registrar Carga de Combustible
                </h2>
            </div>
            <div class="mt-4 flex md:mt-0 md:ml-4">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Volver al Dashboard
                </a>
            </div>
        </div>

        @if(session('success'))
        <div class="rounded-md bg-green-50 p-4 mt-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-400"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
        @endif

        <div class="mt-8 bg-white shadow overflow-hidden sm:rounded-lg">
            <form action="{{ route('driver.fuel.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 p-6">
                @csrf

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label for="vehicle_id" class="block text-sm font-medium text-gray-700">Vehículo</label>
                        <select name="vehicle_id" id="vehicle_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            <option value="">Seleccione un vehículo</option>
                            @foreach($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                {{ $vehicle->placa }} - {{ $vehicle->marca }} {{ $vehicle->modelo }}
                            </option>
                            @endforeach
                        </select>
                        @error('vehicle_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="fecha_carga" class="block text-sm font-medium text-gray-700">Fecha de Carga</label>
                        <input type="datetime-local" name="fecha_carga" id="fecha_carga" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_carga') }}" required>
                        @error('fecha_carga')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="cantidad" class="block text-sm font-medium text-gray-700">Cantidad (Litros/Galones)</label>
                        <input type="number" step="0.01" name="cantidad" id="cantidad" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('cantidad') }}" required>
                        @error('cantidad')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="costo" class="block text-sm font-medium text-gray-700">Costo Total</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">S/</span>
                            </div>
                            <input type="number" step="0.01" name="costo" id="costo" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md" value="{{ old('costo') }}" required>
                        </div>
                        @error('costo')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="kilometraje" class="block text-sm font-medium text-gray-700">Kilometraje Actual</label>
                        <input type="number" name="kilometraje" id="kilometraje" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('kilometraje') }}" required>
                        @error('kilometraje')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tipo_combustible" class="block text-sm font-medium text-gray-700">Tipo de Combustible</label>
                        <select name="tipo_combustible" id="tipo_combustible" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            <option value="">Seleccione un tipo</option>
                            <option value="gasolina" {{ old('tipo_combustible') == 'gasolina' ? 'selected' : '' }}>Gasolina</option>
                            <option value="diesel" {{ old('tipo_combustible') == 'diesel' ? 'selected' : '' }}>Diesel</option>
                            <option value="gas" {{ old('tipo_combustible') == 'gas' ? 'selected' : '' }}>Gas</option>
                        </select>
                        @error('tipo_combustible')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="estacion_servicio" class="block text-sm font-medium text-gray-700">Estación de Servicio</label>
                        <input type="text" name="estacion_servicio" id="estacion_servicio" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('estacion_servicio') }}" required>
                        @error('estacion_servicio')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="comprobante" class="block text-sm font-medium text-gray-700">Comprobante</label>
                        <input type="file" name="comprobante" id="comprobante" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" accept=".pdf,.jpg,.jpeg,.png">
                        <p class="mt-2 text-sm text-gray-500">PDF, JPG, JPEG o PNG. Máximo 2MB.</p>
                        @error('comprobante')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="fas fa-save mr-2"></i>
                        Guardar Registro
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 