<?php

namespace App\Http\Controllers;

use App\Models\Rekening;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $no = 1;
        $tagihan = Rekening::get();
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
        return view('pages.data-rekening', compact(
            'tagihan',
            'no',
            'trans',
            'totaltransaksi',
            'jurusan'
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
            Rekening::create($request->all());
            return redirect()->route('data-rekening.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            dd($e);
            // Tangkap pengecualian dan tampilkan pesan kesalahan
            return redirect()->route('data-rekening.index')->with('error', 'Key yang anda masukkan tidak ada di saldo mon');
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
        $item = Rekening::findOrFail($id);
        $item->update($data);
        return redirect()->route('data-rekening.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Rekening::findOrFail($id);
        $data->delete();

        return redirect()->route('data-rekening.index');
    }
}
