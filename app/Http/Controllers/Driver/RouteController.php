<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Route;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RouteController extends Controller
{
    public function current()
    {
        $driver = Driver::where('user_id', Auth::id())->first();
        $routes = Route::where('driver_id', $driver->id)
            ->whereIn('estado', ['programada', 'en_curso'])
            ->with(['vehicle'])
            ->orderBy('fecha_salida')
            ->get();

        return view('driver.routes.current', compact('routes'));
    }

    public function history()
    {
        $driver = Driver::where('user_id', Auth::id())->first();
        $routes = Route::where('driver_id', $driver->id)
            ->whereIn('estado', ['completada', 'cancelada'])
            ->with(['vehicle'])
            ->orderBy('fecha_salida', 'desc')
            ->get();

        return view('driver.routes.history', compact('routes'));
    }

    public function show(Route $route)
    {
        $driver = Driver::where('user_id', Auth::id())->first();
        if ($route->driver_id !== $driver->id) {
            return redirect()->route('driver.routes.current')
                ->with('error', 'No tienes permiso para ver esta ruta.');
        }

        return view('driver.routes.show', compact('route'));
    }

    public function updateStatus(Request $request, Route $route)
    {
        $driver = Driver::where('user_id', Auth::id())->first();
        if ($route->driver_id !== $driver->id) {
            return redirect()->route('driver.routes.current')
                ->with('error', 'No tienes permiso para actualizar esta ruta.');
        }

        $validated = $request->validate([
            'estado' => 'required|in:programada,en_curso,completada,cancelada',
        ]);

        $route->update($validated);

        return redirect()->route('driver.routes.current')
            ->with('success', 'Estado de la ruta actualizado exitosamente.');
    }
} 