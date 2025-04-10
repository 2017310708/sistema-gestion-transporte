<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::with('user')->get();
        return view('admin.drivers.index', compact('drivers'));
    }

    public function create()
    {
        return view('admin.drivers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'dni' => 'required|unique:drivers',
            'licencia' => 'required|unique:drivers',
            'telefono' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        // Crear usuario
        $user = User::create([
            'nombre' => $validated['nombre'],
            'apellido_paterno' => $validated['apellido_paterno'],
            'apellido_materno' => $validated['apellido_materno'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'rol' => 'conductor',
        ]);

        // Crear conductor
        Driver::create([
            'user_id' => $user->id,
            'dni' => $validated['dni'],
            'licencia' => $validated['licencia'],
            'telefono' => $validated['telefono'],
            'estado' => 'disponible',
        ]);

        return redirect()->route('admin.drivers.index')->with('success', 'Conductor agregado exitosamente');
    }

    public function edit(Driver $driver)
    {
        return view('admin.drivers.edit', compact('driver'));
    }

    public function update(Request $request, Driver $driver)
    {
        $validated = $request->validate([
            'nombre' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'dni' => 'required|unique:drivers,dni,' . $driver->id,
            'licencia' => 'required|unique:drivers,licencia,' . $driver->id,
            'telefono' => 'required',
            'email' => 'required|email|unique:users,email,' . $driver->user_id,
            'password' => 'nullable|min:6',
            'estado' => 'required|in:disponible,en_ruta,descanso',
        ]);

        // Actualizar usuario
        $user = $driver->user;
        $user->nombre = $validated['nombre'];
        $user->apellido_paterno = $validated['apellido_paterno'];
        $user->apellido_materno = $validated['apellido_materno'];
        $user->email = $validated['email'];
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        $user->save();

        // Actualizar conductor
        $driver->update([
            'dni' => $validated['dni'],
            'licencia' => $validated['licencia'],
            'telefono' => $validated['telefono'],
            'estado' => $validated['estado'],
        ]);

        return redirect()->route('admin.drivers.index')->with('success', 'Conductor actualizado exitosamente');
    }

    public function destroy(Driver $driver)
    {
        // Eliminar usuario asociado
        $driver->user->delete();
        
        // Eliminar conductor
        $driver->delete();
        
        return redirect()->route('admin.drivers.index')->with('success', 'Conductor eliminado exitosamente');
    }
}
