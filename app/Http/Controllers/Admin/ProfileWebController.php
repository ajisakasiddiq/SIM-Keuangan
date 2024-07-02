<?php

namespace App\Http\Controllers\Admin;

use App\Models\profile;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileWebController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = profile::get();
        // Mendapatkan tanggal hari ini
        // $today = Carbon::now()->toDateString();
        $user = Auth::user();
        if ($user->role == 'bendahara-excellent')
            $jurusan = 'excellent';
        else
            $jurusan = 'reguler';
        // Mengambil transaksi terbaru pada tanggal hari ini
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
        return view('pages.edit-profileweb', compact('profile', 'trans', 'totaltransaksi'));
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
        //
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
        try {
            $item = profile::findOrFail($id);
            $data = $request->all();
            if ($request->hasFile('foto')) {
                // Jika ada file yang diunggah, simpan file baru dan gunakan path yang baru
                $data['foto'] = $request->file('foto')->store('assets/foto', 'public');
            } else {
                // Jika tidak ada file yang diunggah, gunakan foto lama (path yang sudah ada)
                $data['foto'] = $item->foto;
            }


            $item->update($data);

            return redirect()->route('Profile-Web.index')->with('success', 'Data berhasil diperbarui.');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
