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
        // $no = 1;
        $tagihan = tagihan::get();
        if (request()->ajax()) {
            $query = Rincian::query();
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    // $barcode = DNS1D::getBarcodeHTML($item->id, 'C128', 2, 50);
                    return '
                    <div class="btn-group">
                      <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">Aksi</button>
                        <div class="dropdown-menu">
                        <button class="dropdown-item" 
                        data-id="' . $item->id . '" 
                        data-name="' . $item->name . '" 
                        data-email="' . $item->email . '" 
                        data-nik="' . $item->nik . '" 
                        data-no_hp="' . $item->no_hp . '" 
                        data-alamat="' . $item->alamat . '" 
                        data-tempat_lahir="' . $item->tempat_lahir . '" 
                        data-tgl_lahir="' . $item->tgl_lahir . '" 
                        data-jk="' . $item->jk . '" 
                        data-kelas="' . $item->kelas . '" 
                        data-toggle="modal" data-target="#editModal">Edit</button>
                          <form action="' . route('data-siswa.destroy', $item->id) . '" method="POST">
                          ' . method_field('delete') . csrf_field() . '
                          <button type="submit" class="dropdown-item text-danger">Hapus</button>
                          </form>
                        </div>
                      </div>
                    </div>
                    ';
                })
                ->addColumn('no', function ($item) {
                    static $counter = 1;
                    return $counter++;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.data-rincian-tagihan', compact('tagihan'));
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
