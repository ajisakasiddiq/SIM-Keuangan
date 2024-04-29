<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $tanggalHariIni = Carbon::today()->format('Y-m-d');
        // dd($tanggalHariIni);
        if (Auth::user()->role == 'bendahara-excellent')
            $jurusan = 'excellent';
        else
            $jurusan = 'reguler';

        $pendapatanBulanan = Transaksi::select(
            DB::raw('DATE_FORMAT(tgl_pembayaran, "%Y-%m") as bulan'),
            DB::raw('SUM(total) as total_pendapatan')
        )
            ->where('jenis_transaksi', 'Pendapatan')
            ->where('status', '2')
            ->groupBy('bulan')
            ->get();

        $total = Transaksi::where('jenis_transaksi', 'Pendapatan')
            ->where('status', '2')
            ->where('jurusan', $jurusan)
            ->sum('total');
        $totalpending = Transaksi::where('jenis_transaksi', 'Pendapatan')
            ->whereIn('status', ['0', '1']) // Menggunakan kondisi whereIn untuk status 0 atau 1
            ->where('jurusan', $jurusan)
            ->sum('total');

        $pendapatan = Transaksi::where('jenis_transaksi', 'Pendapatan')
            ->where('tgl_pembayaran', $tanggalHariIni)
            ->where('jurusan', $jurusan)
            ->where('status', '2')
            ->sum('total');
        // dd($pendapatan);
        $pengeluaran = Transaksi::where('jenis_transaksi', 'Pengeluaran')
            ->where('tgl_pembayaran', $tanggalHariIni)
            ->where('jurusan', $jurusan)
            ->where('status', '2')
            ->sum('total');
        return view('dashboard', compact('pengeluaran', 'pendapatan', 'totalpending', 'total', 'pendapatanBulanan'));
        // $pendapatan akan berisi nilai total pendapatan berdasarkan jenis_transaksi dan jurusan

    }
}
