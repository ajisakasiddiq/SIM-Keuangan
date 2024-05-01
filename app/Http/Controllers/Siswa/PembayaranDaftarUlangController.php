<?php

namespace App\Http\Controllers\Siswa;

use App\Models\User;
use App\Models\Cicilan;
use App\Models\tagihan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PembayaranDaftarUlangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::id();
        $no = 1;
        $tagihan = tagihan::get();
        $siswa = User::where('role', 'siswa')->get();
        $transaksi = Transaksi::with('user')
            ->where('tagihan_id', '2')
            ->where('user_id', $user)
            ->get();
        $total = Transaksi::selectRaw('user_id, tagihan_id, SUM(total) as total_sum')
            ->where('tagihan_id', '2') // Filter berdasarkan tagihan_id tertentu
            ->where('user_id', $user) // Filter berdasarkan user_id tertentu
            ->groupBy('user_id', 'tagihan_id') // Kelompokkan berdasarkan user_id dan tagihan_id
            ->get();
        $totalcicilan = Cicilan::selectRaw('user_id, tagihan_id, SUM(total) as total_sum')
            ->where('tagihan_id', '2') // Filter berdasarkan tagihan_id tertentu
            ->where('user_id', $user) // Filter berdasarkan user_id tertentu
            ->groupBy('user_id', 'tagihan_id') // Kelompokkan berdasarkan user_id dan tagihan_id
            ->get();
        $cicilan = Cicilan::where('tagihan_id', '2')
            ->where('user_id', $user)
            ->get();

        return view('pages.siswa.pembayaran-daftarulang', compact('no', 'total', 'siswa', 'tagihan', 'transaksi', 'cicilan', 'totalcicilan'));
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
            // Simpan data ke database
            $data = $request->all();
            $data['bukti_pembayaran'] = $request->file('bukti_pembayaran')->store('assets/bukti_transaksi', 'public');
            Cicilan::create($data);
            return redirect()->route('Tagihan-DaftarUlang.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            // Tangkap pengecualian dan tampilkan pesan kesalahan
            dd($e); // Menampilkan informasi exception ke terminal
            return redirect()->route('Tagihan-DaftarUlang.index')->with('error', 'Terjadi kesalahan saat menyimpan data.');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
