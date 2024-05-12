<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = ['bendahara-excellent', 'bendahara-reguler'];
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
        if (request()->ajax()) {
            $query = User::whereIn('role', $roles);
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
                ->addColumn('profile', function ($item) {
                    if ($item->foto) {
                        // Jika ada data bukti transaksi, tampilkan tautan dan gambar
                        return '<td><a href="' . Storage::url($item->foto) . '" data-lightbox="gallery">
                                    <img src="' . Storage::url($item->foto) . '" alt="Bukti Transaksi" style="width: 100px; height: auto;">
                                </a></td>';
                    } else {
                        // Jika tidak ada data bukti transaksi, tampilkan tanda strip (-)
                        return 'Tidak Ada Foto';
                    }
                })
                ->rawColumns(['action', 'profile'])
                ->make(true);
        }
        // $no = 1;
        // $user = User::where('role', 'siswa')->get();
        return view('pages.data-user', compact('trans', 'totaltransaksi'));
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
            // Mendapatkan semua data dari request
            $data = $request->all();

            // Hashing kata sandi sebelum disimpan
            $data['password'] = Hash::make($request->password);

            // Membuat user baru dan menyimpan ke database
            User::create($data);
            return redirect()->route('data-user.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            dd($e);
            // Tangkap pengecualian dan tampilkan pesan kesalahan
            return redirect()->route('data-user.index')->with('error', 'Key yang anda masukkan tidak ada di saldo mon');
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
        $item = User::findOrFail($id);
        $item->update($data);
        return redirect()->route('data-user.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = User::findOrFail($id);
        $data->delete();

        return redirect()->route('data-user.index');
    }
}
