<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConductorSeeder extends Seeder
{
    public function run()
    {
        // Get the conductor user ID
        $conductorUserId = DB::table('usuarios')
            ->where('username', 'conductor1')
            ->value('id');

        if ($conductorUserId) {
            DB::table('conductores')->insert([
                'id_usuario' => $conductorUserId,
                'nombre' => 'Pedro',
                'apellido_paterno' => 'López',
                'apellido_materno' => 'Sánchez',
                'nro_licencia' => 'Q12345678',
                'telefono' => '987654321',
                'email' => 'pedro.lopez@example.com',
                'direccion' => 'Av. Los Conductores 123, Lima',
                'tipo_licencia' => 'A-III',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
} 