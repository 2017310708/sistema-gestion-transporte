@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="md:flex md:items-center md:justify-between">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Editar Pedido #{{ $order->id }}
            </h2>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4">
            <a href="{{ route('admin.orders.show', $order) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <i class="fas fa-arrow-left mr-2"></i>
                Volver
            </a>
        </div>
    </div>

    <div class="mt-8">
        <form action="{{ route('admin.orders.update', $order) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                            <select name="estado" id="estado" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="pendiente" {{ $order->estado === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="asignado" {{ $order->estado === 'asignado' ? 'selected' : '' }}>Asignado</option>
                                <option value="en_ruta" {{ $order->estado === 'en_ruta' ? 'selected' : '' }}>En Ruta</option>
                                <option value="entregado" {{ $order->estado === 'entregado' ? 'selected' : '' }}>Entregado</option>
                                <option value="cancelado" {{ $order->estado === 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                            </select>
                        </div>

                        <div>
                            <label for="route_id" class="block text-sm font-medium text-gray-700">Ruta Asignada</label>
                            <select name="route_id" id="route_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="">Seleccione una ruta</option>
                                @foreach($routes as $route)
                                    <option value="{{ $route->id }}" {{ $order->route_id === $route->id ? 'selected' : '' }}>
                                        {{ $route->origen }} → {{ $route->destino }} 
                                        (Conductor: {{ $route->driver->user->nombre }} {{ $route->driver->user->apellido_paterno }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="fecha_entrega" class="block text-sm font-medium text-gray-700">Fecha de Entrega</label>
                            <input type="datetime-local" name="fecha_entrega" id="fecha_entrega" 
                                value="{{ $order->fecha_entrega->format('Y-m-d\TH:i') }}"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <div>
                            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                            <textarea name="descripcion" id="descripcion" rows="3" 
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ $order->descripcion }}</textarea>
                        </div>

                        <div>
                            <label for="instrucciones_especiales" class="block text-sm font-medium text-gray-700">Instrucciones Especiales</label>
                            <textarea name="instrucciones_especiales" id="instrucciones_especiales" rows="3" 
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ $order->instrucciones_especiales }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Guardar Cambios
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection 