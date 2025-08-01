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
        Schema::create('combustibles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('viaje_id')->constrained('viajes')->onDelete('cascade');

            $table->float('cantidad_litros');
            $table->decimal('costo', 10, 2);
            $table->dateTime('fecha');

            $table->timestamps();
        });
    }

    /**
     * Revertir las migraciones.
     */
    public function down(): void
    {
        Schema::dropIfExists('combustibles');
    }
};
