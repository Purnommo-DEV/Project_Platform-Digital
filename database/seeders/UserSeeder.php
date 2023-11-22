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
        \App\Models\Role::create([
            'role' => 'Admin'
        ]);

        \App\Models\Role::create([
            'role' => 'Lembaga'
        ]);

        \App\Models\Role::create([
            'role' => 'Entrepreneur'
        ]);

        \App\Models\StatusAkun::create([
            'status' => 'Aktif'
        ]);

        \App\Models\StatusAkun::create([
            'status' => 'Nonaktif'
        ]);

        \App\Models\StatusAkun::create([
            'status' => 'Perlu Perpanjangan'
        ]);

        \App\Models\StatusAkun::create([
            'status' => 'Perlu Konfirmasi'
        ]);

        \App\Models\StatusTransaksi::create([
            'status' => 'Disetujui'
        ]);

        \App\Models\StatusTransaksi::create([
            'status' => 'Dibatalkan'
        ]);

        \App\Models\User::create([
            'kode' => 'ADM-001',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('jakilat2023@IKN'),
            'role_id' => 1
        ]);
    }
}
