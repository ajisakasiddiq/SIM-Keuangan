<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class SiswaImport implements ToModel, WithStartRow
{
    protected $jurusan;
    public function startRow(): int
    {
        return 2; // Mulai dari baris kedua
    }
    public function __construct($jurusan)
    {
        $this->jurusan = $jurusan;
    }
    public function model(array $row)
    {
        // Konversi format tanggal dari "30/05/2024" menjadi "2024-05-30"
        // dd($row[6]);
        // $tgl_lahir = Carbon::createFromFormat('d/m/Y', $row[6])->format('Y-m-d');


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
            'password' => '12345678',
            'role' => 'siswa',
            'jurusan' => $this->jurusan,
        ]);
    }
}
