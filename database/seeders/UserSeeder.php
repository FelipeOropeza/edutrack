<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Usuário professor
        User::updateOrCreate(
            ['email' => 'professor@escola.com'],
            [
                'name' => 'Professor João',
                'password' => Hash::make('senha123'), // Senha segura
                'role' => 'professor',
            ]
        );

        // Usuário responsável
        User::updateOrCreate(
            ['email' => 'responsavel@escola.com'],
            [
                'name' => 'Responsável Maria',
                'password' => Hash::make('senha123'),
                'role' => 'responsavel',
            ]
        );
    }
}
