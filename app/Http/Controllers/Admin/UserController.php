<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('rol', '!=', 'admin')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'rol' => 'required|in:cliente,conductor',
            'dni' => 'required_if:rol,conductor|string|size:8|unique:drivers,dni',
            'licencia' => 'required_if:rol,conductor|string|max:20|unique:drivers,licencia',
            'telefono' => 'required_if:rol,conductor|string|max:20',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'nombre' => $request->nombre,
                'apellido_paterno' => $request->apellido_paterno,
                'apellido_materno' => $request->apellido_materno,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'rol' => $request->rol
            ]);

            if ($request->rol === 'conductor') {
                Driver::create([
                    'user_id' => $user->id,
                    'dni' => $request->dni,
                    'licencia' => $request->licencia,
                    'telefono' => $request->telefono,
                    'estado' => 'activo'
                ]);
            }

            DB::commit();
            return redirect()->route('admin.users.index')->with('success', 'Usuario creado exitosamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error al crear el usuario. ' . $e->getMessage());
        }
    }

    public function edit(User $user)
    {
        $user->load('driver');
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'dni' => 'required_if:rol,conductor|string|size:8|unique:drivers,dni,' . optional($user->driver)->id,
            'licencia' => 'required_if:rol,conductor|string|max:20|unique:drivers,licencia,' . optional($user->driver)->id,
            'telefono' => 'required_if:rol,conductor|string|max:20',
        ]);

        DB::beginTransaction();
        try {
            $userData = [
                'nombre' => $request->nombre,
                'apellido_paterno' => $request->apellido_paterno,
                'apellido_materno' => $request->apellido_materno,
                'email' => $request->email,
            ];

            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            $user->update($userData);

            if ($user->rol === 'conductor') {
                if ($user->driver) {
                    $user->driver->update([
                        'dni' => $request->dni,
                        'licencia' => $request->licencia,
                        'telefono' => $request->telefono,
                    ]);
                } else {
                    Driver::create([
                        'user_id' => $user->id,
                        'dni' => $request->dni,
                        'licencia' => $request->licencia,
                        'telefono' => $request->telefono,
                        'estado' => 'activo'
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado exitosamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error al actualizar el usuario: ' . $e->getMessage());
        }
    }

    public function destroy(User $user)
    {
        try {
            if ($user->rol === 'conductor') {
                $user->driver()->delete();
            }
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado exitosamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar el usuario.');
        }
    }
} 