<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            "name" => "Julio Veliz",
            "email" => "julio@gmail.com",
            "password" => bcrypt('6223109'),
            "template" => "ADMIN",
        ])->assignRole('Administrador');
    }
}
