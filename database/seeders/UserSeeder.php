<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed a real user.
        User::create([
            'name'      => 'Administrador',
            'email'     => 'admin@movies.com',
            'password'  =>  bcrypt('123456')
        ])->assignRole('Admin');
    }
}
