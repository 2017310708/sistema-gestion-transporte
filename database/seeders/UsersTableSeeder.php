<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Driver;
use App\Models\Vehicle;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'nombre' => 'Administrador',
            'apellido_paterno' => 'Sistema',
            'apellido_materno' => 'Principal',
            'email' => 'admin@transgest.com',
            'password' => Hash::make('admin123'),
            'rol' => 'admin',
        ]);

        // Conductor user
        User::create([
            'nombre' => 'Juan',
            'apellido_paterno' => 'Conductor',
            'apellido_materno' => 'Pérez',
            'email' => 'conductor@transgest.com',
            'password' => Hash::make('conductor123'),
            'rol' => 'conductor',
        ]);

        // Cliente user
        User::create([
            'nombre' => 'María',
            'apellido_paterno' => 'Cliente',
            'apellido_materno' => 'García',
            'email' => 'cliente@transgest.com',
            'password' => Hash::make('cliente123'),
            'rol' => 'cliente',
        ]);

        // Personal user
        User::create([
            'nombre' => 'Pedro',
            'apellido_paterno' => 'Personal',
            'apellido_materno' => 'López',
            'email' => 'personal@transgest.com',
            'password' => Hash::make('personal123'),
            'rol' => 'personal',
        ]);

        // Crear conductor
        $user = User::where('email', 'conductor@transgest.com')->first();
        $driver = Driver::create([
            'user_id' => $user->id,
            'dni' => '12345678',
            'licencia' => 'A12345',
            'telefono' => '987654321',
            'estado' => 'disponible',
        ]);

        // Crear vehículo para el conductor
        Vehicle::create([
            'placa' => 'ABC-123',
            'marca' => 'Toyota',
            'modelo' => 'Hilux',
            'año' => 2023,
            'capacidad' => 2.5,
            'estado' => 'activo',
            'driver_id' => $driver->id,
        ]);
    }
}
