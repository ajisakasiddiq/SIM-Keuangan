<?php

namespace App\Http\Controllers\Rekap;

use App\Models\User;
use App\Models\tagihan;
use App\Models\Transaksi;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class RekapitulasiPengeluaranController extends Controller
{

    public function index(Request $request)
    {
        $bulan = $request->query('bulan'); // Ambil nilai bulan dari query string
        $selectedyear = $request->query('tahun');
        $tagihanid = $request->query('tagihan_id');
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
        $tagihan = tagihan::whereNotIn('id', [1, 2, 3, 4, 5, 6])->get();
        $siswa = User::where('role', 'siswa')->get();
        $tahun = TahunAjaran::where('status', 'aktif')->get();
        $query = Transaksi::with('jenistagihan')
            ->where('jenis_transaksi', 'Pengeluaran');

        if ($tagihanid) {
            $query->where('tagihan_id', $tagihanid);
        }
        if ($selectedyear) {
            $query->whereYear('tgl_pembayaran', $selectedyear);
        }
        if ($bulan) {
            $query->whereMonth('tgl_pembayaran', $bulan);
        }

        $data = $query->get();


        return view('pages.rekapitulasi.rekapitulasi-pengeluaran', compact('siswa', 'tagihan', 'no', 'tahun', 'trans', 'data', 'totaltransaksi', 'listbulan', 'query'));
    }
}
