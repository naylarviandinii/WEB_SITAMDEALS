<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat Akun Admin
        User::create([
            'name' => 'Owner Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'), // Password otomatis di-hash aman
            'role' => 'admin',
        ]);

        // Buat Akun Kasir
        User::create([
            'name' => 'Staf Kasir',
            'email' => 'kasir@gmail.com',
            'password' => Hash::make('kasir123'),
            'role' => 'kasir',
        ]);
    }
}