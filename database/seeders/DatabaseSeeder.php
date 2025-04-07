<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsuarioSeeder::class,
            ConductorSeeder::class,
            UsersTableSeeder::class,
            // Add other seeders here as we create them
        ]);
    }
}
