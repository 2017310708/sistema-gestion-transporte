<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('conductores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->constrained('usuarios');
            $table->string('nombre', 100);
            $table->string('apellido_paterno', 100);
            $table->string('apellido_materno', 100);
            $table->string('nro_licencia', 20)->unique();
            $table->string('telefono', 15);
            $table->string('email', 100)->unique();
            $table->text('direccion');
            $table->string('tipo_licencia', 10);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('conductores');
    }
}; 