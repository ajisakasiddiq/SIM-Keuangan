<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Transaksi;
use App\Exports\DataExport;
use Illuminate\Http\Request;
use App\Exports\LaporanExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class LaporanKeuanganController extends Controller
{
    public function index(Request $request)
    {
        // Ambil nilai bulan dan tahun dari request
        $bulan = $request->input('bulan'); // Misalnya, parameter 'bulan' diambil dari URL atau form
        $tahun = $request->input('tahun');
        if (Auth::user()->role == 'bendahara-excellent')
            $jurusan = 'excellent';
        else
            $jurusan = 'reguler';
        $trans = Transaksi::with(['user', 'jenistagihan'])
            ->where('jurusan', $jurusan)
            ->where('status', '1')
            ->whereNotNull('tgl_pembayaran')
            ->latest()
            ->get();
        $totaltransaksi = Transaksi::where('status', '1')->count();
        $trans->map(function ($item) {
            $item->tgl_pembayaran_formatted = \Carbon\Carbon::parse($item->tgl_pembayaran)->format('F j, Y');
            return $item;
        });
        $no = 1;
        $transactions = Transaksi::select(
            DB::raw('CASE 
            WHEN transaksi.tagihan_id = 6 THEN CONCAT(jenistagihan.name, " (", transaksi.keterangan, ")") 
            ELSE jenistagihan.name 
         END AS nama_tagihan'),
            'transaksi.tagihan_id',
            'transaksi.jenis_transaksi',
            DB::raw('SUM(transaksi.total) AS jumlah')
        )
            ->leftJoin('jenistagihan', 'transaksi.tagihan_id', '=', 'jenistagihan.id')
            ->where('transaksi.status', '2')
            ->where('transaksi.jurusan', $jurusan)
            ->whereYear('transaksi.tgl_pembayaran', $tahun) // Filter berdasarkan tahun
            ->whereMonth('transaksi.tgl_pembayaran', $bulan)
            ->groupBy('transaksi.tagihan_id', 'nama_tagihan', 'transaksi.jenis_transaksi')
            ->get();
        $totalsaldo = Transaksi::where('status', '2')
            ->where('jenis_transaksi', 'pendapatan')
            ->whereYear('tgl_pembayaran', $tahun) // Filter berdasarkan tahun
            ->whereMonth('tgl_pembayaran', $bulan)
            ->sum('total');
        $totalpengeluaran = Transaksi::where('status', '2')
            ->where('jenis_transaksi', 'pengeluaran')
            ->whereYear('tgl_pembayaran', $tahun) // Filter berdasarkan tahun
            ->whereMonth('tgl_pembayaran', $bulan)
            ->sum('total');

        // ->get();

        $listbulan = [
            '1' => 'Januari',
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni',
            '7' => 'Juli',
            '8' => 'Agustus',
            '9' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        return view('pages.data-transaksi', compact('listbulan', 'totalsaldo', 'transactions', 'no', 'trans', 'totaltransaksi', 'bulan', 'tahun', 'totalpengeluaran'));
    }

    public function exportData(Request $request)
    {
        Carbon::setLocale('id');
        $bulan = $request->query('bulan'); // Ambil nilai bulan dari query string
        $tahun = $request->query('tahun');
        if (Auth::user()->role == 'bendahara-excellent')
            $jurusan = 'excellent';
        else
            $jurusan = 'reguler';
        // Contoh query untuk mengambil data yang ingin diekspor
        $transactions = Transaksi::select(
            DB::raw('CASE 
            WHEN transaksi.tagihan_id = 6 THEN CONCAT(jenistagihan.name, " (", transaksi.keterangan, ")") 
            ELSE jenistagihan.name 
         END AS nama_tagihan'),
            'transaksi.tagihan_id',
            'transaksi.jenis_transaksi',
            DB::raw('SUM(transaksi.total) AS jumlah')
        )
            ->leftJoin('jenistagihan', 'transaksi.tagihan_id', '=', 'jenistagihan.id')
            ->where('transaksi.status', '2')
            ->where('transaksi.jurusan', $jurusan)
            ->whereYear('transaksi.tgl_pembayaran', $tahun) // Filter berdasarkan tahun
            ->whereMonth('transaksi.tgl_pembayaran', $bulan)
            ->groupBy('transaksi.tagihan_id', 'nama_tagihan', 'transaksi.jenis_transaksi')
            ->get();
        $totalsaldo = Transaksi::where('status', '2')
            ->where('jenis_transaksi', 'pendapatan')
            ->whereYear('tgl_pembayaran', $tahun) // Filter berdasarkan tahun
            ->whereMonth('tgl_pembayaran', $bulan)
            ->sum('total');
        $totalpengeluaran = Transaksi::where('status', '2')
            ->where('jenis_transaksi', 'pengeluaran')
            ->whereYear('tgl_pembayaran', $tahun) // Filter berdasarkan tahun
            ->whereMonth('tgl_pembayaran', $bulan)
            ->sum('total');
        // dd($bulan);
        // Panggil class ekspor (ganti dengan nama class export yang sesuai)
        $namaFile = 'laporanKeuangan_' . $tahun . '_' . Carbon::createFromFormat('m', $bulan)->translatedFormat('F') . '.xlsx';
        return Excel::download(new LaporanExport($transactions, $totalsaldo, $bulan, $tahun, $totalpengeluaran), $namaFile);
    }
}
