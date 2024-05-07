<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Transaksi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanExport implements FromView, WithStyles

{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $transactions;

    public function __construct($transactions)
    {
        $this->transactions = $transactions;
    }

    public function view(): View
    {
        return view('export.laporan', [
            'transactions' => $this->transactions
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        // Atur styling untuk header tabel
        $sheet->getStyle('A1:D2')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'B0E57C']],
            'alignment' => ['horizontal' => 'center']
        ]);

        // Atur styling untuk isi tabel
        $sheet->getStyle('A3:D' . (count($this->transactions) + 2))->applyFromArray([
            'alignment' => ['horizontal' => 'center']
        ]);
    }
}
