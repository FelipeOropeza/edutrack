<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Professor;

class ProfessorSeeder extends Seeder
{
    public function run(): void
    {
        $professores = [
            ['name' => 'Carlos Silva', 'email' => 'carlos@escola.com'],
            ['name' => 'Ana Lima', 'email' => 'ana@escola.com'],
            ['name' => 'João Pedro', 'email' => 'joao@escola.com'],
            ['name' => 'Mariana Costa', 'email' => 'mariana@escola.com'],
            ['name' => 'Lucas Oliveira', 'email' => 'lucas@escola.com'],
        ];

        foreach ($professores as $professor) {
            $user = User::create([
                'name' => $professor['name'],
                'email' => $professor['email'],
                'password' => Hash::make('senha123'),
                'role' => 'professor',
            ]);

            Professor::create([
                'user_id' => $user->id,
            ]);
        }
    }
}
