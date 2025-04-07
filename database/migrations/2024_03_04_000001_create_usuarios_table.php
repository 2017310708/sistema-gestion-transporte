<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('username', 50)->unique();
            $table->string('password');
            $table->string('nombre', 100)->nullable();
            $table->string('apellido_paterno', 100)->nullable();
            $table->string('apellido_materno', 100)->nullable();
            $table->enum('rol', ['A', 'C', 'D', 'S']);
            $table->enum('estado', ['activo', 'inactivo', 'pendiente_confirmacion', 'bloqueado'])
                  ->default('pendiente_confirmacion');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}; 