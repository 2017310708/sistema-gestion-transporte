<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('route_id')->nullable()->constrained()->onDelete('set null');
            $table->string('origen');
            $table->string('destino');
            $table->text('descripcion');
            $table->enum('estado', ['pendiente', 'asignado', 'en_ruta', 'entregado', 'cancelado']);
            $table->datetime('fecha_solicitud');
            $table->datetime('fecha_entrega')->nullable();
            $table->decimal('peso', 8, 2)->nullable(); // en kg
            $table->decimal('volumen', 8, 2)->nullable(); // en m³
            $table->text('instrucciones_especiales')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}; 