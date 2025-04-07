<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fuels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->constrained()->onDelete('cascade');
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
            $table->decimal('cantidad', 8, 2); // Litros o galones
            $table->decimal('costo', 10, 2);
            $table->integer('kilometraje');
            $table->datetime('fecha_carga');
            $table->enum('tipo_combustible', ['gasolina', 'diesel', 'gas']);
            $table->string('estacion_servicio');
            $table->string('comprobante')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fuels');
    }
}; 