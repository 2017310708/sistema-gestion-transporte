<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function showClientRegistrationForm()
    {
        return view('auth.register-client');
    }

    public function showDriverRegistrationForm()
    {
        return view('auth.register-driver');
    }

    public function registerClient(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'nombre' => $request->nombre,
                'apellido_paterno' => $request->apellido_paterno,
                'apellido_materno' => $request->apellido_materno,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'rol' => 'cliente'
            ]);

            DB::commit();
            auth()->login($user);
            return redirect()->route('client.dashboard')->with('success', '¡Registro exitoso!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error al registrar. Por favor, inténtelo de nuevo.');
        }
    }

    public function registerDriver(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'dni' => 'required|string|size:8|unique:drivers',
            'licencia' => 'required|string|max:20|unique:drivers',
            'telefono' => 'required|string|max:20',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'nombre' => $request->nombre,
                'apellido_paterno' => $request->apellido_paterno,
                'apellido_materno' => $request->apellido_materno,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'rol' => 'conductor'
            ]);

            Driver::create([
                'user_id' => $user->id,
                'dni' => $request->dni,
                'licencia' => $request->licencia,
                'telefono' => $request->telefono,
                'estado' => 'activo'
            ]);

            DB::commit();
            auth()->login($user);
            return redirect()->route('driver.dashboard')->with('success', '¡Registro exitoso!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error al registrar. Por favor, inténtelo de nuevo.');
        }
    }
} 