<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create(['nombre' => 'Administrador', 'descripcion' => 'Acceso total al sistema']);
        Role::create(['nombre' => 'Supervisor', 'descripcion' => 'Puede gestionar módulos y reportes']);
        Role::create(['nombre' => 'Chofer', 'descripcion' => 'Acceso limitado para ver viajes y entregas']);
    }
}
