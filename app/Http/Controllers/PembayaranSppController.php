<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\tagihan;
use App\Models\TahunAjaran;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PembayaranSppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'bendahara-excellent')
            $jurusan = 'excellent';
        else
            $jurusan = 'reguler';

        $tagihan = tagihan::get();
        $tahun = TahunAjaran::where('status', 'Aktif')->get();
        $siswa = User::where('role', 'siswa')->get();
        if (request()->ajax()) {
            $query = Transaksi::with('user')
                ->where('tagihan_id', '1')
                ->where('jurusan', $jurusan);
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
                        data-tagihan_id="' . $item->tagihan_id . '" 
                        data-user_id="' . $item->user_id . '" 
                        data-keterangan="' . $item->keterangan . '" 
                        data-date_awal="' . $item->date_awal . '" 
                        data-date_akhir="' . $item->date_akhir . '" 
                        data-metode="' . $item->metode . '" 
                        data-total="' . $item->total . '" 
                        data-status="' . $item->status . '" 
                        data-jurusan="' . $item->jurusan . '" 
                        data-Pendapatan="' . $item->Pendapatan . '" 
                        data-toggle="modal" data-target="#editModal">Edit</button>
                          <form action="' . route('data-tagihan-spp.destroy', $item->id) . '" method="POST">
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
                ->addColumn('status', function ($item) {
                    switch ($item->status) {
                        case 0:
                            return '<span class="badge badge-warning">Menunggu Pembayaran</span>';
                            break;
                        case 1:
                            return '<span class="badge badge-info">Pending</span>';
                            break;
                        case 2:
                            return '<span class="badge badge-success">Sukses</span>';
                            break;
                        default:
                            return '<span class="badge badge-danger">Undefined</span>';
                    }
                })
                ->rawColumns(['status', 'tahun', 'action'])
                ->make(true);
        }
        return view('pages.data-pembayaran-spp', compact('siswa', 'tagihan'));
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
            if ($request->has('kelas')) {
                // Jika request memiliki parameter 'kelas', ambil pengguna (user) berdasarkan kelas
                $users = User::where('kelas', $request['kelas'])->get();

                // Iterasi setiap pengguna (user) dalam kelas tertentu
                foreach ($users as $user) {
                    foreach ($request['keterangan'] as $index => $keterangan) {
                        $nominal = (string) $request['total'][$index];
                        // Siapkan data transaksi untuk ditambahkan ke tabel 'transaksi'
                        $data = [
                            'user_id' => $user->id,
                            'tagihan_id' => $request['tagihan_id'],
                            'keterangan' => (string) $keterangan,
                            'jenis_transaksi' => $request['jenis_transaksi'],
                            'jurusan' => $request['jurusan'],
                            'total' => $nominal, // Misalnya, total pembayaran SPP
                            'date_awal' => $request['date_awal'], // Misalnya, total pembayaran SPP
                            'date_akhir' => $request['date_akhir'], // Misalnya, total pembayaran SPP
                            'tahunajar' => $request['tahunajar'], // Misalnya, total pembayaran SPP
                            'status' => '0', // Status "Belum Dibayar"
                        ];

                        // Tambahkan data transaksi ke dalam tabel 'transaksi'
                        Transaksi::create($data);
                    }
                }
            } else {
                // Jika tidak ada parameter 'kelas', tambahkan data transaksi berdasarkan request
                foreach ($request['keterangan'] as $index => $keterangan) {
                    $nominal = (string) $request['total'][$index];

                    // Simpan ke database sesuai kebutuhan Anda
                    Transaksi::create([
                        'user_id' => $request['user_id'],
                        'tagihan_id' => $request['tagihan_id'],
                        'jurusan' => $request['jurusan'],
                        'jenis_transaksi' => $request['jenis_transaksi'],
                        'status' => $request['status'],
                        'date_awal' => $request['date_awal'],
                        'date_akhir' => $request['date_akhir'],
                        'keterangan' => (string) $keterangan,
                        'total' => $nominal,
                    ]);
                }
            }

            return response()->json(['message' => 'Data transaksi berhasil ditambahkan.']);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
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
        $item = Transaksi::findOrFail($id);
        $item->update($data);
        return redirect()->route('data-tagihan-spp.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Transaksi::findOrFail($id);
        $data->delete();

        return redirect()->route('data-tagihan-spp.index');
    }
}
