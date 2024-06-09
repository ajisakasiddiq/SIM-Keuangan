<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class UsersRegulerImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2; // Mulai dari baris kedua
    }
    public function model(array $row)
    {

        Log::info('Row data: ' . json_encode($row));
        return new User([
            'name' => $row[0],
            'email' => $row[1],
            'nik' => $row[2],
            'alamat' => $row[3],
            'no_hp' => $row[4],
            'tempat_lahir' => $row[5],
            'tgl_lahir' => Date::excelToDateTimeObject($row[6])->format('Y-m-d'), // Tanggal lahir dalam format "YYYY-MM-DD"
            'jk' => $row[7],
            'kelas' => $row[8],
            'password' => bcrypt('12345678'),
            'role' => 'siswa',
            'jurusan' => 'reguler',
        ]);
    }
}
