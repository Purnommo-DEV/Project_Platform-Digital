<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       

        \App\Models\User::create([
            'kode' => 'ADM-001',
            'name' => 'Admin2',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('jakilat2023@IKN'),
            'role_id' => 1
        ]);

     
    }
}
