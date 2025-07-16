<?php

namespace Database\Seeders;

use App\Models\User; 
use App\Models\Role; 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; 

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Llama al RoleSeeder primero para asegurar que los roles existan
        $this->call(RoleSeeder::class);

        // 2. Crear el usuario Administrador
        $adminRole = Role::where('nombre', 'Administrador')->first();

        if ($adminRole) {
            User::firstOrCreate(
                ['email' => 'admin@admin.com'],
                [
                    'name' => 'Administrador',
                    'password' => Hash::make('admin'), 
                    'role_id' => $adminRole->id, 
                    'email_verified_at' => now(), 
                ]
            );
            $this->command->info('Usuario administrador (admin@admin.com) creado/actualizado.');
        } else {
            $this->command->warn('Advertencia: El rol "Administrador" no fue encontrado. Asegúrate de que RoleSeeder se ejecuta correctamente.');
        }

        // 3. Crear el usuario de prueba (el que ya tenías)
        // Puedes mantenerlo o eliminarlo si no lo necesitas
        User::firstOrCreate(
            ['email' => 'usuario@usuario.com'],
            [
                'name' => 'Usuaeio',
                'password' => Hash::make('usuario'), // Contraseña por defecto
                'role_id' => Role::where('nombre', 'Chofer')->first()->id ?? null, // Asigna el rol Chofer si existe
                'email_verified_at' => now(),
            ]
        );
        $this->command->info('Usuario de prueba (usuario@usuario.com) creado/actualizado.');



    }
}