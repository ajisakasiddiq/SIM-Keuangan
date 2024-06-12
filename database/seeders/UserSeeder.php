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
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'jk' => 'L',
            'role' => 'admin',
            'password' => Hash::make('12345678'),
        ]);
        User::create([
            'name' => 'siswa reguler',
            'email' => 'siswareguler@gmail.com',
            'jk' => 'L',
            'role' => 'siswa',
            'jurusan' => 'reguler',
            'password' => Hash::make('12345678'),
        ]);
        User::create([
            'name' => 'siswa excellent',
            'email' => 'siswaexcellent@gmail.com',
            'jk' => 'L',
            'role' => 'siswa',
            'jurusan' => 'excellent',
            'password' => Hash::make('12345678'),
        ]);
    }
}
