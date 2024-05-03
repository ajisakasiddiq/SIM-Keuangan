<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TahunAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'bendahara-excellent') {
            $jurusan = 'excellent';
        } elseif (Auth::user()->jurusan == 'bendahara-reguller') {
            $jurusan = 'reguller';
        } else {
            $jurusan = 'NULL';
        }
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
        $tahun = TahunAjaran::get();
        return view('pages.data-tahunajaran', compact(
            'tahun',
            'no',
            'trans',
            'totaltransaksi',
        ));
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
            TahunAjaran::create($request->all());
            return redirect()->route('Tahun-Ajaran.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            dd($e);
            // Tangkap pengecualian dan tampilkan pesan kesalahan
            return redirect()->route('Tahun-Ajaran.index')->with('error', 'Key yang anda masukkan tidak ada di saldo mon');
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
        $item = TahunAjaran::findOrFail($id);
        $item->update($data);
        return redirect()->route('Tahun-Ajaran.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = TahunAjaran::findOrFail($id);
        $data->delete();

        return redirect()->route('Tahun-Ajaran.index');
    }
}
