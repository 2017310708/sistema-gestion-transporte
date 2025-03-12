@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-gray-900">Editar Ruta</h1>
        <p class="mt-2 text-sm text-gray-700">Modifique los detalles de la ruta.</p>
    </div>

    <div class="bg-white shadow sm:rounded-lg">
        <form action="{{ route('admin.routes.update', $route) }}" method="POST" class="space-y-6 p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                <div>
                    <label for="origen" class="block text-sm font-medium text-gray-700">Origen</label>
                    <div class="mt-1">
                        <input type="text" name="origen" id="origen" value="{{ old('origen', $route->origen) }}" required
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                    </div>
                    @error('origen')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="destino" class="block text-sm font-medium text-gray-700">Destino</label>
                    <div class="mt-1">
                        <input type="text" name="destino" id="destino" value="{{ old('destino', $route->destino) }}" required
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                    </div>
                    @error('destino')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="driver_id" class="block text-sm font-medium text-gray-700">Conductor</label>
                    <div class="mt-1">
                        <select name="driver_id" id="driver_id" required
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            <option value="">Seleccione un conductor</option>
                            @foreach($drivers as $driver)
                            <option value="{{ $driver->id }}" {{ (old('driver_id', $route->driver_id) == $driver->id) ? 'selected' : '' }}>
                                {{ $driver->user->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @error('driver_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="vehicle_id" class="block text-sm font-medium text-gray-700">Vehículo</label>
                    <div class="mt-1">
                        <select name="vehicle_id" id="vehicle_id" required
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            <option value="">Seleccione un vehículo</option>
                            @foreach($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}" {{ (old('vehicle_id', $route->vehicle_id) == $vehicle->id) ? 'selected' : '' }}>
                                {{ $vehicle->placa }} - {{ $vehicle->marca }} {{ $vehicle->modelo }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @error('vehicle_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="fecha_salida" class="block text-sm font-medium text-gray-700">Fecha de Salida</label>
                    <div class="mt-1">
                        <input type="datetime-local" name="fecha_salida" id="fecha_salida" 
                            value="{{ old('fecha_salida', $route->fecha_salida->format('Y-m-d\TH:i')) }}" required
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                    </div>
                    @error('fecha_salida')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="fecha_llegada" class="block text-sm font-medium text-gray-700">Fecha de Llegada</label>
                    <div class="mt-1">
                        <input type="datetime-local" name="fecha_llegada" id="fecha_llegada" 
                            value="{{ old('fecha_llegada', $route->fecha_llegada->format('Y-m-d\TH:i')) }}" required
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                    </div>
                    @error('fecha_llegada')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                    <div class="mt-1">
                        <select name="estado" id="estado" required
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            <option value="programada" {{ (old('estado', $route->estado) == 'programada') ? 'selected' : '' }}>Programada</option>
                            <option value="en_curso" {{ (old('estado', $route->estado) == 'en_curso') ? 'selected' : '' }}>En Curso</option>
                            <option value="completada" {{ (old('estado', $route->estado) == 'completada') ? 'selected' : '' }}>Completada</option>
                            <option value="cancelada" {{ (old('estado', $route->estado) == 'cancelada') ? 'selected' : '' }}>Cancelada</option>
                        </select>
                    </div>
                    @error('estado')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end space-x-3 mt-6">
                <a href="{{ route('admin.routes.index') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Cancelar
                </a>
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Actualizar Ruta
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
