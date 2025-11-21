<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario Administrador
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
        ]);

        // Usuario Vigilante
        User::create([
            'name' => 'Vigilante 1',
            'email' => 'vigilante@vigilante.com',
            'password' => Hash::make('123456'),
            'role' => 'vigilante',
        ]);
    }
}
