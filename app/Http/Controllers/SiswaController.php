<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaksi;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::user()->role == 'admin-excellent')
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
            $kelas = $request->input('kelas');
            $query = User::where('role', 'siswa')
                ->where('jurusan', 'excellent');
            if ($kelas) {
                $query->where('kelas', $kelas);
            }
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
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
                        data-nisn="' . $item->nisn . '" 
                        data-no_hp="' . $item->no_hp . '" 
                        data-alamat="' . $item->alamat . '" 
                        data-tempat_lahir="' . $item->tempat_lahir . '" 
                        data-tgl_lahir="' . $item->tgl_lahir . '" 
                        data-jk="' . $item->jk . '" 
                        data-kelas="' . $item->kelas . '" 
                        data-jurusan="' . $item->jurusan . '" 
                        data-toggle="modal" data-target="#editModal">Edit</button>
                          <form action="' . route('data-siswa-excellent.destroy', $item->id) . '" method="POST">
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
        return view('pages.data-siswa', compact('trans', 'totaltransaksi'));
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

            // Hashing kata sandi sebelum disimpan
            $data['password'] = Hash::make($request->password);

            // Membuat user baru dan menyimpan ke database
            User::create($data);
            return redirect()->route('data-siswa-excellent.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            dd($e);
            // Tangkap pengecualian dan tampilkan pesan kesalahan
            return redirect()->route('data-siswa-excellent.index')->with('error', 'Key yang anda masukkan tidak ada di saldo mon');
        }
    }

    public function updateClasses(Request $request)
    {
        // Update kelas VII ke VIII
        User::where('role', 'siswa')->where('kelas', 'IX')->update(['kelas' => 'Lulus']);
        User::where('role', 'siswa')->where('kelas', 'VIII')->update(['kelas' => 'IX']);
        User::where('role', 'siswa')->where('kelas', 'VII')->update(['kelas' => 'VIII']);

        // Bisa tambahkan notifikasi atau redirect setelah update
        return redirect()->back()->with('success', 'Kelas siswa berhasil diperbarui.');
    }
    public function importData(Request $request)
    {

        $file = $request->file('excel_file');
        // dd($file);
        Excel::import(new SiswaImport, $file);

        return redirect()->back()->with('success', 'Data berhasil diimpor.');
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
        return redirect()->route('data-siswa-excellent.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = User::findOrFail($id);
        $data->delete();

        return redirect()->route('data-siswa-excellent.index');
    }
}
