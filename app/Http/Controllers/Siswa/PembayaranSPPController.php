<?php

namespace App\Http\Controllers\Siswa;

use Carbon\Carbon;
use App\Models\User;
use App\Models\tagihan;
use App\Models\Rekening;
use App\Models\Transaksi;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PembayaranSPPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil nilai tahun_pelajaran dari permintaan GET
        $tahunajar = $request->query('tahun_pelajaran');
        $tahun = TahunAjaran::get();
        $user = Auth::id();
        $tagihan = tagihan::get();
        $siswa = User::where('role', 'siswa')->get();
        $trans = Transaksi::with(['user', 'jenistagihan'])
            ->where('status', '0')
            ->where('user_id', $user)
            ->latest()
            ->get();
        $totaltransaksi = Transaksi::where('status', '0')->count();
        $trans->map(function ($item) {
            $item->tgl_pembayaran_formatted = \Carbon\Carbon::parse($item->tgl_pembayaran)->format('F j, Y');
            return $item;
        });
        $transaksi = Transaksi::with('user')
            ->where('tagihan_id', '1')
            ->where('tahunajar', $tahunajar)
            ->where('user_id', $user)
            ->get();
        $userjurusan = Auth::user()->jurusan;
        $rekening = Rekening::where('jurusan', $userjurusan)->get();
        return view('pages.siswa.pembayaran-spp', compact('siswa', 'tagihan', 'transaksi', 'tahun', 'trans', 'totaltransaksi', 'rekening'));
    }

    public function cetak($id)
    {
        Carbon::setLocale('id');
        $transaksi = Transaksi::with('user')
            ->where('tagihan_id', '1')
            ->where('id', $id)
            ->get();
        return view('pages.cetak.cetak-spp', compact('transaksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $data['bukti_transaksi'] = $request->file('bukti_transaksi')->store('assets/bukti_transaksi', 'public');
            // Simpan data ke database
            Transaksi::create($data);
            return redirect()->route('Tagihan-spp.index')->with('success', 'Pembayaran Sukses, tunggu konfirmasi.');
        } catch (\Exception $e) {
            // Tangkap pengecualian dan tampilkan pesan kesalahan
            dd($e); // Menampilkan informasi exception ke terminal
            return redirect()->route('Tagihan-spp.index')->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $data['bukti_transaksi'] = $request->file('bukti_transaksi')->store('assets/bukti_transaksi', 'public');
        $item = Transaksi::findOrFail($id);
        $item->update($data);
        return redirect()->route('Tagihan-spp.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Transaksi::findOrFail($id);
        $data->delete();

        return redirect()->route('Tagihan-spp.index');
    }
}
