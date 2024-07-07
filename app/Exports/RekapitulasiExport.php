<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RekapitulasiExport implements FromView, WithStyles
{
    protected $data;
    protected $jumlahtotal;
    protected $title;
    protected $bulan;
    protected $tahun;

    public function __construct($data, $jumlahtotal, $title, $bulan, $tahun)
    {
        $this->data = $data;
        $this->jumlahtotal = $jumlahtotal;
        $this->title = $title;
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function view(): View
    {
        return view('export.rekap', [
            'data' => $this->data,
            'jumlahtotal' => $this->jumlahtotal,
            'title' => $this->title,
            'bulan' => $this->bulan,
            'tahun' => $this->tahun,
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        // Mengatur lebar kolom agar sesuai dengan konten
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(20);

        // Mengatur header
        $sheet->getStyle('A2:D2')->applyFromArray([
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

        // Mengatur isi tabel
        $highestRow = $sheet->getHighestRow();
        $sheet->getStyle("A3:F$highestRow")->applyFromArray([
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

        // Mengatur gaya judul dan posisinya
        $sheet->mergeCells('A1:D1');

        $titleText = 'Rekapitulasi ' . $this->title;
        if ($this->bulan && $this->tahun) {
            $titleText .= ' Bulan ' . Carbon::createFromFormat('m', $this->bulan)->translatedFormat('F') . ' Tahun ' . $this->tahun;
        }

        $sheet->setCellValue('A1', $titleText);
        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            ]
        ]);

        // Mengatur styling untuk jumlah total
        $sheet->getStyle("F" . ($highestRow + 1))->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
            ]
        ]);
    }
}
