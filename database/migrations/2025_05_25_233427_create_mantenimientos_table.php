<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('camion_id')->constrained('camiones')->onDelete('cascade');

            $table->string('tipo');
            $table->text('descripcion');
            $table->dateTime('fecha');
            $table->decimal('costo', 10, 2); // Precisión 10, escala 2 para dinero
            $table->string('proveedor');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mantenimientos');
    }
};
