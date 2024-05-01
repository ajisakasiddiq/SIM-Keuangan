<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $no = 1;
        $tahun = TahunAjaran::get();
        return view('pages.data-tahunajaran', compact(
            'tahun',
            'no',
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
