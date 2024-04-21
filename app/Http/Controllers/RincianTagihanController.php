<?php

namespace App\Http\Controllers;

use App\Models\Rincian;
use App\Models\tagihan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RincianTagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $id)
    {
        $no = 1;
        $tagihan = tagihan::findOrFail($id);
        $rincian = Rincian::where('tagihan_id', $id)->get();
        return view('pages.data-rincian-tagihan', compact('no', 'tagihan', 'rincian'));
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
            Rincian::create($request->all());
            return redirect()->route('data-rincian-tagihan.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            // Tangkap pengecualian dan tampilkan pesan kesalahan
            return redirect()->route('data-rincian-tagihan.index')->with('error', 'Key yang anda masukkan tidak ada di saldo mon');
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
        $data = Rincian::findOrFail($id);
        $data->delete();

        return redirect()->route('data-rincian-tagihan.index');
    }
}
