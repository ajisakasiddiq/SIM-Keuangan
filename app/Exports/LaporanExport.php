<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanExport implements FromView, WithStyles
{
    protected $transactions;
    protected $totalsaldo;
    protected $bulan;
    protected $tahun;
    protected $totalpengeluaran;

    public function __construct($transactions, $totalsaldo, $bulan, $tahun, $totalpengeluaran)
    {
        $this->transactions = $transactions;
        $this->totalsaldo = $totalsaldo;
        $this->bulan = $bulan;
        $this->tahun = $tahun;
        $this->totalpengeluaran = $totalpengeluaran;
    }

    public function view(): View
    {
        return view('export.laporan', [
            'transactions' => $this->transactions,
            'totalsaldo' => $this->totalsaldo,
            'bulan' => $this->bulan,
            'tahun' => $this->tahun,
            'totalpengeluaran' => $this->totalpengeluaran,
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        // Atur styling untuk header tabel
        $sheet->getStyle('A2:D2')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'B0E57C']],
            'alignment' => ['horizontal' => 'center']
        ]);

        // Atur styling untuk isi tabel
        $sheet->getStyle('A3:D' . (count($this->transactions) + 3))->applyFromArray([
            'alignment' => ['horizontal' => 'center']
        ]);

        // Mengatur header
        $sheet->getStyle('A1:D1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => '000000']
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'F2F2F2']
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => 'DDDDDD']
                ]
            ]
        ]);

        // Atur lebar kolom
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(20);

        // Atur tinggi baris
        $sheet->getRowDimension('2')->setRowHeight(25);
        for ($row = 3; $row <= count($this->transactions) + 3; $row++) {
            $sheet->getRowDimension($row)->setRowHeight(20);
        }
    }
}
