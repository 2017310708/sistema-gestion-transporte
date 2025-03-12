<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('admin.vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('admin.vehicles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'placa' => 'required|unique:vehicles',
            'marca' => 'required',
            'modelo' => 'required',
            'año' => 'required|integer',
            'capacidad' => 'required|numeric',
            'estado' => 'required|in:activo,mantenimiento,inactivo',
        ]);

        Vehicle::create($validated);
        return redirect()->route('admin.vehicles.index')->with('success', 'Vehículo agregado exitosamente');
    }

    public function edit(Vehicle $vehicle)
    {
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'placa' => 'required|unique:vehicles,placa,' . $vehicle->id,
            'marca' => 'required',
            'modelo' => 'required',
            'año' => 'required|integer',
            'capacidad' => 'required|numeric',
            'estado' => 'required|in:activo,mantenimiento,inactivo',
        ]);

        $vehicle->update($validated);
        return redirect()->route('admin.vehicles.index')->with('success', 'Vehículo actualizado exitosamente');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('admin.vehicles.index')->with('success', 'Vehículo eliminado exitosamente');
    }
}
