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
            'name' => 'Bendahara Excellent',
            'email' => 'adminkeuanganexcellent@gmail.com',
            'jk' => 'L',
            'role' => 'bendahara-excellent',
            'password' => Hash::make('12345678'),
        ]);
        User::create([
            'name' => 'Bendahara reguler',
            'email' => 'adminkeuanganreguler@gmail.com',
            'jk' => 'L',
            'role' => 'bendahara-reguler',
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
            'name' => 'siswa 3',
            'email' => 'kelastujuh@gmail.com',
            'jk' => 'L',
            'role' => 'siswa',
            'password' => Hash::make('12345678'),
        ]);
        User::create([
            'name' => 'siswa 2',
            'email' => 'kelasdelapan@gmail.com',
            'jk' => 'L',
            'role' => 'siswa',
            'password' => Hash::make('12345678'),
        ]);
        User::create([
            'name' => 'siswa 1',
            'email' => 'kelassembilanq@gmail.com',
            'jk' => 'L',
            'role' => 'siswa',
            'password' => Hash::make('12345678'),
        ]);
    }
}
