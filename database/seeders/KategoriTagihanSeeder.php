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
            'name' => '1.1. SPP'
        ]);
        tagihan::create([
            'name' => '1.2. Daftar Ulang'
        ]);
        tagihan::create([
            'name' => '1.3. Pendaftaran'
        ]);
        tagihan::create([
            'name' => '1.4. Kain Seragam'
        ]);
        tagihan::create([
            'name' => '1.5. Dana Bos'
        ]);
        tagihan::create([
            'name' => '1.6. Lainnya'
        ]);
    }
}
