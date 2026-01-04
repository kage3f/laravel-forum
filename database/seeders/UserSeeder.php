<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Tiago',
            'username' => 'tiago',
            'email' => 'tiago@example.com',
            'password' => Hash::make('password'),
            'bio' => 'Desenvolvedor Full Stack apaixonado por tecnologia.',
            'location' => 'São Paulo, BR',
        ]);

        User::create([
            'name' => 'Alex Dev',
            'username' => 'alex_dev',
            'email' => 'alex@example.com',
            'password' => Hash::make('password'),
            'bio' => 'Full Stack Developer | Open Source Enthusiast',
            'location' => 'São Paulo, BR',
        ]);
    }
}
