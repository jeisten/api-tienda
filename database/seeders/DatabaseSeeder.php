<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Propietario;
use App\Models\Tienda;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Crear usuario administrador
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@tiendas.com',
            'password' => Hash::make('password123')
        ]);

        // Crear propietarios de ejemplo
        $propietario1 = Propietario::create([
            'nombre' => 'Juan Pérez García',
            'direccion' => 'Calle 123 #45-67, Bogotá',
            'telefono' => '3001234567'
        ]);

        $propietario2 = Propietario::create([
            'nombre' => 'María López Rodríguez',
            'direccion' => 'Carrera 15 #32-18, Medellín',
            'telefono' => '3009876543'
        ]);

        // Crear tiendas de ejemplo
        Tienda::create([
            'propietario_id' => $propietario1->id,
            'fecha_permiso' => '2024-12-31',
            'certificado_bomberos' => 'CB-2024-001',
            'sayco_acinpro' => 'SA-2024-001',
            'latitud' => 4.7110,
            'longitud' => -74.0721,
            'direccion_tienda' => 'Carrera 7 #32-16, Centro, Bogotá'
        ]);

        Tienda::create([
            'propietario_id' => $propietario2->id,
            'fecha_permiso' => '2024-11-30',
            'certificado_bomberos' => 'CB-2024-002',
            'sayco_acinpro' => 'SA-2024-002',
            'latitud' => 6.2442,
            'longitud' => -75.5812,
            'direccion_tienda' => 'Calle 50 #70-30, El Poblado, Medellín'
        ]);
    }
}
