<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Fuel;
use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FuelController extends Controller
{
    public function create()
    {
        $driver = Driver::where('user_id', Auth::id())->first();
        $vehicles = Vehicle::where('estado', 'activo')->get();
        return view('driver.fuel.create', compact('driver', 'vehicles'));
    }

    public function store(Request $request)
    {
        $driver = Driver::where('user_id', Auth::id())->first();
        
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'cantidad' => 'required|numeric|min:0',
            'costo' => 'required|numeric|min:0',
            'kilometraje' => 'required|integer|min:0',
            'fecha_carga' => 'required|date',
            'tipo_combustible' => 'required|in:gasolina,diesel,gas',
            'estacion_servicio' => 'required|string|max:255',
            'comprobante' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $fuel = new Fuel($validated);
        $fuel->driver_id = $driver->id;

        if ($request->hasFile('comprobante')) {
            $path = $request->file('comprobante')->store('comprobantes', 'public');
            $fuel->comprobante = $path;
        }

        $fuel->save();

        return redirect()->route('driver.fuel.create')
            ->with('success', 'Registro de combustible guardado exitosamente.');
    }
} 