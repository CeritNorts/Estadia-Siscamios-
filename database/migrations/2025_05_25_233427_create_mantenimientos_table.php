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
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('camion_id')->constrained('camiones')->onDelete('cascade');

            $table->string('tipo');
            $table->text('descripcion')->nullable();
            $table->date('fecha');
            $table->decimal('costo', 10, 2)->nullable();
            $table->string('proveedor')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Revertir las migraciones.
     */
    public function down(): void
    {
        Schema::dropIfExists('mantenimientos');
    }
};
