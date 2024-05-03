<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        $no = 1;
        $transactions = Transaksi::select(
            DB::raw('CASE WHEN transaksi.tagihan_id = 6 THEN transaksi.keterangan ELSE jenistagihan.name END AS nama_tagihan'),
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
        $bulan = [
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

        return view('pages.data-transaksi', compact('bulan', 'transactions', 'no'));
    }
}
