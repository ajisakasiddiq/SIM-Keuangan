<?php

namespace App\Http\Controllers;

use App\Models\profile;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $tanggalHariIni = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
        // dd($tanggalHariIni);
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
        $userid = Auth::user()->id;
        $totaltransaksi = Transaksi::where('status', '1')->count();
        $trans->map(function ($item) {
            $item->tgl_pembayaran_formatted = \Carbon\Carbon::parse($item->tgl_pembayaran)->format('F j, Y');
            return $item;
        });

        $pendapatanBulanan = Transaksi::select(
            DB::raw('DATE_FORMAT(tgl_pembayaran, "%m") as bulan'),
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
            ->where('tgl_pembayaran', $tanggalHariIni)
            ->where('jurusan', $jurusan)
            ->where('status', '2')
            ->sum('total');
        // dd($pendapatan);
        $pengeluaran = Transaksi::where('jenis_transaksi', 'Pengeluaran')
            ->where('jurusan', $jurusan)
            ->where('status', '2')
            ->sum('total');
        $tagihanberjalan = Transaksi::where('user_id', $userid)
            ->where('status', '0')->count();
        $tagihanpending = Transaksi::where('user_id', $userid)
            ->where('status', '1')->count();
        $tagihanlunas = Transaksi::where('user_id', $userid)
            ->where('status', '2')->count();


        $pendapatanbulan = Transaksi::where('jenis_transaksi', 'Pendapatan')
            ->where('jurusan', $jurusan)
            ->where('status', '2')
            ->sum('total');
        // dd($pendapatan);
        $pengeluaranbulan = Transaksi::where('jenis_transaksi', 'Pengeluaran')
            ->where('jurusan', $jurusan)
            ->sum('total');

        $siswaexcellent = User::where('role', 'siswa')
            ->where('jurusan', 'excellent')->get()->count();
        $siswareguler = User::where('role', 'siswa')
            ->where('jurusan', 'reguler')->get()->count();
        $profile = profile::get();
        return view('dashboard', compact('siswaexcellent', 'profile', 'siswareguler', 'pengeluaran', 'pengeluaranbulan', 'pendapatanbulan', 'pendapatan', 'totalpending', 'total', 'pendapatanBulanan', 'trans', 'totaltransaksi', 'tagihanberjalan', 'tagihanpending', 'tagihanlunas'));
        // $pendapatan akan berisi nilai total pendapatan berdasarkan jenis_transaksi dan jurusan

    }
}
