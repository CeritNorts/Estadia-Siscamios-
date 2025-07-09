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
        Schema::table('choferes', function (Blueprint $table) {
            // Modificar campos existentes
            $table->string('telefono', 20)->change();
            $table->string('licencia', 100)->unique()->change();
            
            // Agregar nuevos campos
            $table->string('tipo_licencia', 10)->nullable()->after('licencia');
            $table->date('vencimiento_licencia')->nullable()->after('tipo_licencia');
            $table->enum('estado', ['activo', 'inactivo', 'suspendido'])->default('activo')->after('vencimiento_licencia');
        });
    }

    /**
     * Revertir las migraciones.
     */
    public function down(): void
    {
        Schema::table('choferes', function (Blueprint $table) {
            // Remover los campos agregados
            $table->dropColumn(['tipo_licencia', 'vencimiento_licencia', 'estado']);
            
            // Revertir cambios en campos existentes
            $table->dropUnique(['licencia']);
            $table->string('telefono')->change();
            $table->string('licencia')->change();
        });
    }
};