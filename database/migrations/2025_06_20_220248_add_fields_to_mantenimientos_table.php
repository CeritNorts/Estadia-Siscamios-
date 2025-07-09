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
        Schema::table('mantenimientos', function (Blueprint $table) {
            // Agregar campo estado
            $table->enum('estado', ['programado', 'en_proceso', 'completado', 'urgente'])
                  ->default('programado')
                  ->after('proveedor');
            
            // Agregar campo kilometraje
            $table->integer('kilometraje')->nullable()->after('fecha');
            
            // Agregar fechas adicionales
            $table->date('fecha_inicio')->nullable()->after('fecha');
            $table->date('fecha_fin')->nullable()->after('fecha_inicio');
            
            // Agregar observaciones
            $table->text('observaciones')->nullable()->after('descripcion');
        });
    }

    /**
     * Revertir las migraciones.
     */
    public function down(): void
    {
        Schema::table('mantenimientos', function (Blueprint $table) {
            $table->dropColumn([
                'estado', 
                'kilometraje', 
                'fecha_inicio', 
                'fecha_fin', 
                'observaciones'
            ]);
        });
    }
};