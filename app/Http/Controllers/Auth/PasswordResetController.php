<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function showResetForm()
    {
        return view('auth.password-reset');
    }

    public function verifyIdentity(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'tipo_usuario' => 'required|in:cliente,conductor',
        ]);

        $user = User::where('email', $request->email)
            ->where('rol', $request->tipo_usuario)
            ->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'No se encontró un usuario con ese correo electrónico y tipo de usuario.',
            ]);
        }

        if ($request->tipo_usuario === 'cliente') {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'apellido_paterno' => 'required|string|max:255',
                'apellido_materno' => 'required|string|max:255',
            ]);

            if ($user->nombre !== $request->nombre ||
                $user->apellido_paterno !== $request->apellido_paterno ||
                $user->apellido_materno !== $request->apellido_materno) {
                return back()->withErrors([
                    'nombre' => 'Los datos proporcionados no coinciden con nuestros registros.',
                ]);
            }
        } else {
            $request->validate([
                'dni' => 'required|string|size:8',
                'licencia' => 'required|string|max:20',
                'telefono' => 'required|string|max:20',
            ]);

            $driver = Driver::where('user_id', $user->id)
                ->where('dni', $request->dni)
                ->where('licencia', $request->licencia)
                ->where('telefono', $request->telefono)
                ->first();

            if (!$driver) {
                return back()->withErrors([
                    'dni' => 'Los datos proporcionados no coinciden con nuestros registros.',
                ]);
            }
        }

        // Generate a random token
        $token = Str::random(60);
        
        // Store the token in the password_reset_tokens table
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            ['token' => $token, 'created_at' => now()]
        );

        return redirect()->route('password.reset.form', ['token' => $token, 'email' => $user->email]);
    }

    public function showResetPasswordForm(Request $request)
    {
        return view('auth.reset-password', [
            'token' => $request->token,
            'email' => $request->email,
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $reset = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$reset) {
            return back()->withErrors([
                'email' => 'El token de restablecimiento no es válido.',
            ]);
        }

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete the token
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Tu contraseña ha sido restablecida exitosamente.');
    }
} 