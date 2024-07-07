<?php

namespace App\Http\Controllers\Rekap;

use Carbon\Carbon;
use App\Models\User;
use App\Models\tagihan;
use App\Models\Transaksi;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\RekapitulasiExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class RekapitulasiPendapatanController extends Controller
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
        $tagihan = tagihan::whereNotIn('id', ['5'])->get();
        $siswa = User::where('role', 'siswa')->get();
        $tahun = TahunAjaran::where('status', 'aktif')->get();
        $query = Transaksi::select(
            'jenistagihan.name as Namatagihan',
            'transaksi.tagihan_id',
            DB::raw('GROUP_CONCAT(transaksi.keterangan SEPARATOR ", ") as keterangan'),
            DB::raw('SUM(transaksi.total) as total'),
            DB::raw('MIN(transaksi.tgl_pembayaran) as tgl_pembayaran') // Menggunakan MIN untuk tanggal pembayaran pertama
        )
            ->join('jenistagihan', 'jenistagihan.id', '=', 'transaksi.tagihan_id')
            ->where('jenis_transaksi', 'Pendapatan')
            ->where('jurusan', $jurusan);

        if ($tagihanid) {
            $query->where('tagihan_id', $tagihanid);
        }
        if ($selectedyear) {
            $query->whereYear('tgl_pembayaran', $selectedyear);
        }
        if ($bulan) {
            $query->whereMonth('tgl_pembayaran', $bulan);
        }
        if (Auth::user()->role == 'bendahara-excellent') {
            $query->whereNotIn('tagihan_id', ['5']);
        }

        $query->groupBy('transaksi.tagihan_id');
        $data = $query->get();
        $jumlahtotal = $data->sum('total');

        return view('pages.rekapitulasi.rekapitulasi-pendapatan', compact('siswa', 'tagihan', 'no', 'tahun', 'jumlahtotal', 'trans', 'data', 'totaltransaksi', 'listbulan', 'query'));
    }
    public function exportExcel(Request $request)
    {
        Carbon::setLocale('id');
        if (Auth::user()->role == 'bendahara-excellent')
            $jurusan = 'excellent';
        else
            $jurusan = 'reguler';
        $tagihanid = $request->input('tagihan_id');
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');
        $query = Transaksi::select(
            'jenistagihan.name as Namatagihan',
            'transaksi.tagihan_id',
            DB::raw('GROUP_CONCAT(transaksi.keterangan SEPARATOR ", ") as keterangan'),
            DB::raw('SUM(transaksi.total) as total'),
            DB::raw('MIN(transaksi.tgl_pembayaran) as tgl_pembayaran') // Menggunakan MIN untuk tanggal pembayaran pertama
        )
            ->join('jenistagihan', 'jenistagihan.id', '=', 'transaksi.tagihan_id')
            ->where('jenis_transaksi', 'Pendapatan')
            ->where('jurusan', $jurusan);

        if ($tagihanid) {
            $query->where('tagihan_id', $tagihanid);
        }
        if ($tahun) {
            $query->whereYear('tgl_pembayaran', $tahun);
        }
        if ($bulan) {
            $query->whereMonth('tgl_pembayaran', $bulan);
        }
        if (Auth::user()->role == 'bendahara-excellent') {
            $query->whereNotIn('tagihan_id', ['5']);
        }

        $query->groupBy('transaksi.tagihan_id');
        $data = $query->get();
        $jumlahtotal = $data->sum('total');
        $title = 'Pendapatan';

        // Buat nama file berdasarkan ketersediaan bulan dan tahun
        if ($tahun && $bulan) {
            $namaFile = 'Rekapitulasi-Pendapatan_' . $tahun . '_' . Carbon::createFromFormat('m', $bulan)->translatedFormat('F') . '.xlsx';
        } elseif ($tahun) {
            $namaFile = 'Rekapitulasi-Pendapatan_' . $tahun . '.xlsx';
        } else {
            $namaFile = 'Rekapitulasi-Pendapatan.xlsx';
        }
        return Excel::download(new RekapitulasiExport($data, $jumlahtotal, $title, $bulan, $tahun), $namaFile);
    }
}
