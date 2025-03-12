<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@transgest.com',
            'password' => Hash::make('admin123'),
            'rol' => 'admin',
        ]);

        // Conductor user
        User::create([
            'name' => 'Juan Conductor',
            'email' => 'conductor@transgest.com',
            'password' => Hash::make('conductor123'),
            'rol' => 'conductor',
        ]);

        // Cliente user
        User::create([
            'name' => 'María Cliente',
            'email' => 'cliente@transgest.com',
            'password' => Hash::make('cliente123'),
            'rol' => 'cliente',
        ]);

        // Personal user
        User::create([
            'name' => 'Pedro Personal',
            'email' => 'personal@transgest.com',
            'password' => Hash::make('personal123'),
            'rol' => 'personal',
        ]);
    }
}
