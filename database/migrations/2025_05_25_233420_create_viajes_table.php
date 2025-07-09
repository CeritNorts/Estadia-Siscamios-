<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta las migracones.
     */
    public function up(): void
    {
        Schema::create('viajes', function (Blueprint $table) {
            $table->id();

            // Llaves foráneas
            $table->foreignId('camion_id')->constrained('camiones')->onDelete('cascade');
            $table->foreignId('chofer_id')->constrained('choferes')->onDelete('cascade');
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');

            $table->text('ruta');
            $table->dateTime('fecha_salida');
            $table->dateTime('fecha_llegada');
            $table->string('estado');

            $table->timestamps();
        });
    }

    /**
     * Revertir las migraciones.
     */
    public function down(): void
    {
        Schema::dropIfExists('viajes');
    }
};
