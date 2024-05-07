<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SiswaImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2; // Mulai dari baris kedua
    }

    public function model(array $row)
    {
        return new User([
            'name' => $row[0],
            'email' => $row[1],
            'nik' => $row[2],
            'alamat' => $row[3],
            'no_hp' => $row[4],
            'tempat_lahir' => $row[5],
            'tgl_lahir' => $row[6],
            'jk' => $row[7],
            'kelas' => $row[8],
            'password' => '12345678',
        ]);
    }
}
