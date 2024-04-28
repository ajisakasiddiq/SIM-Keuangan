<?php

namespace App\Http\Controllers\Siswa;

use App\Models\User;
use App\Models\tagihan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PembayaranLainnyaController extends Controller
{
    public function index()
    {
        $user = Auth::id();
        $tagihan = tagihan::get();
        $siswa = User::where('role', 'siswa')->get();
        $transaksi = Transaksi::with('user')
            ->where('tagihan_id', '6')
            ->where('user_id', $user)
            ->get();
        return view('pages.siswa.pembayaran-lainnya', compact('siswa', 'tagihan', 'transaksi'));
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
            Transaksi::create($request->all());
            return redirect()->route('Tagihan-Lainnya.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            // Tangkap pengecualian dan tampilkan pesan kesalahan
            dd($e); // Menampilkan informasi exception ke terminal
            return redirect()->route('Tagihan-Lainnya.index')->with('error', 'Terjadi kesalahan saat menyimpan data.');
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
        return redirect()->route('Tagihan-Lainnya.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Transaksi::findOrFail($id);
        $data->delete();

        return redirect()->route('Tagihan-Lainnya.index');
    }
}
