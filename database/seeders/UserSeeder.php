<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
       User::updateOrCreate(
            ['email' => 'diretoria@escola.com'],
            [
                'name' => 'Diretoria',
                'password' => Hash::make('senha123'),
                'role' => 'diretoria',
            ]
        );
    }
}
