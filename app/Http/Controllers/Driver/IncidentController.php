<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Incident;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncidentController extends Controller
{
    public function create()
    {
        $driver = Driver::where('user_id', Auth::id())->first();
        return view('driver.incidents.create', compact('driver'));
    }

    public function store(Request $request)
    {
        $driver = Driver::where('user_id', Auth::id())->first();
        
        $validated = $request->validate([
            'tipo' => 'required|in:accidente,averia,otro',
            'descripcion' => 'required|string|max:500',
            'ubicacion' => 'required|string|max:255',
        ]);

        $incident = new Incident();
        $incident->driver_id = $driver->id;
        $incident->tipo = $validated['tipo'];
        $incident->descripcion = $validated['descripcion'];
        $incident->ubicacion = $validated['ubicacion'];
        $incident->save();

        return redirect()->route('driver.incidents.create')
            ->with('success', 'Incidente reportado exitosamente.');
    }
} 