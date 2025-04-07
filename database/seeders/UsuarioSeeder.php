<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        // Admin user
        DB::table('usuarios')->insert([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'nombre' => 'Admin',
            'apellido_paterno' => 'Sistema',
            'apellido_materno' => 'Principal',
            'rol' => 'A',
            'estado' => 'activo',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Cliente demo
        DB::table('usuarios')->insert([
            'username' => 'cliente1',
            'password' => Hash::make('cliente123'),
            'nombre' => 'Juan',
            'apellido_paterno' => 'Pérez',
            'apellido_materno' => 'García',
            'rol' => 'C',
            'estado' => 'activo',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Conductor demo
        DB::table('usuarios')->insert([
            'username' => 'conductor1',
            'password' => Hash::make('conductor123'),
            'nombre' => 'Pedro',
            'apellido_paterno' => 'López',
            'apellido_materno' => 'Sánchez',
            'rol' => 'D',
            'estado' => 'activo',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Staff demo
        DB::table('usuarios')->insert([
            'username' => 'staff1',
            'password' => Hash::make('staff123'),
            'nombre' => 'María',
            'apellido_paterno' => 'González',
            'apellido_materno' => 'Rodríguez',
            'rol' => 'S',
            'estado' => 'activo',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
} 