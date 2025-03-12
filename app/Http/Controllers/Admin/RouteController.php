<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Route;
use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index()
    {
        $routes = Route::with(['driver', 'vehicle'])->get();
        return view('admin.routes.index', compact('routes'));
    }

    public function create()
    {
        $drivers = Driver::whereHas('user')->with('user')->get();
        $vehicles = Vehicle::where('estado', 'activo')->get();
        return view('admin.routes.create', compact('drivers', 'vehicles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'origen' => 'required',
            'destino' => 'required',
            'fecha_salida' => 'required|date',
            'fecha_llegada' => 'required|date|after:fecha_salida',
            'driver_id' => 'required|exists:drivers,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'estado' => 'required|in:programada,en_curso,completada,cancelada',
            'descripcion' => 'nullable',
        ]);

        Route::create($validated);
        return redirect()->route('admin.routes.index')->with('success', 'Ruta agregada exitosamente');
    }

    public function edit(Route $route)
    {
        $drivers = Driver::whereHas('user')->with('user')->get();
        $vehicles = Vehicle::where('estado', 'activo')->get();
        return view('admin.routes.edit', compact('route', 'drivers', 'vehicles'));
    }

    public function update(Request $request, Route $route)
    {
        $validated = $request->validate([
            'origen' => 'required',
            'destino' => 'required',
            'fecha_salida' => 'required|date',
            'fecha_llegada' => 'required|date|after:fecha_salida',
            'driver_id' => 'required|exists:drivers,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'estado' => 'required|in:programada,en_curso,completada,cancelada',
            'descripcion' => 'nullable',
        ]);

        $route->update($validated);
        return redirect()->route('admin.routes.index')->with('success', 'Ruta actualizada exitosamente');
    }

    public function destroy(Route $route)
    {
        $route->delete();
        return redirect()->route('admin.routes.index')->with('success', 'Ruta eliminada exitosamente');
    }
}
