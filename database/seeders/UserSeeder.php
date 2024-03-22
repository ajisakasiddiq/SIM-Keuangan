<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::create([
            'name' => 'admin keuangan',
            'email' => 'adminkeuangan@gmail.com',
            'jk' => 'L',
            'role' => 'admin-keuangan',
            'password' => Hash::make('12345678'),
        ]);
        User::create([
            'name' => 'admin TU',
            'email' => 'admintu@gmail.com',
            'jk' => 'L',
            'role' => 'admin-tu',
            'password' => Hash::make('12345678'),
        ]);
        User::create([
            'name' => 'siswa',
            'email' => 'kelastujuh@gmail.com',
            'jk' => 'L',
            'role' => 'siswa',
            'password' => Hash::make('12345678'),
        ]);
        User::create([
            'name' => 'siswa',
            'email' => 'kelasdelapan@gmail.com',
            'jk' => 'L',
            'role' => 'siswa',
            'password' => Hash::make('12345678'),
        ]);
        User::create([
            'name' => 'siswa',
            'email' => 'kelassembilanq@gmail.com',
            'jk' => 'L',
            'role' => 'siswa',
            'password' => Hash::make('12345678'),
        ]);
    }
}
