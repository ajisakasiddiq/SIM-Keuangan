<?php

namespace Database\Seeders;

use App\Models\tagihan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriTagihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        tagihan::create([
            'name' => 'SPP'
        ]);
        tagihan::create([
            'name' => 'Daftar Ulang'
        ]);
        tagihan::create([
            'name' => 'Pendaftaran'
        ]);
        tagihan::create([
            'name' => 'Kain Seragam'
        ]);
        tagihan::create([
            'name' => 'Dana Bos'
        ]);
        tagihan::create([
            'name' => 'Lainnya'
        ]);
    }
}
