<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Cria um usuário Administrador para testes
        User::create([
            'name' => 'Admin Nail',
            'email' => 'admin@nail.com',
            'password' => Hash::make('12345678'),
            'type' => 'admin',
        ]);

        // 2. Cria alguns serviços padrão de Nail Designer
        Service::create([
            'name' => 'Alongamento em Fibra de Vidro',
            'duration' => 120, // 2 horas
            'price' => 150.00,
            'active' => true
        ]);

        Service::create([
            'name' => 'Manutenção de Fibra',
            'duration' => 90, // 1 hora e meia
            'price' => 90.00,
            'active' => true
        ]);

        Service::create([
            'name' => 'Banho de Gel',
            'duration' => 60, // 1 hora
            'price' => 70.00,
            'active' => true
        ]);
    }
}