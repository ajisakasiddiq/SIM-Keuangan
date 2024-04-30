<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\tagihan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PembayaranPendaftaranController extends Controller
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
        $siswa = User::where('role', 'siswa')->get();
        if (request()->ajax()) {
            $query = Transaksi::select(
                'transaksi.user_id',
                'transaksi.tagihan_id',
                'users.name',
                'users.kelas',
                DB::raw('SUM(transaksi.total) as total_sum') // Memilih kolom total_sum sebagai hasil SUM
            )
                ->join('users', 'transaksi.user_id', '=', 'users.id')
                ->where('transaksi.tagihan_id', '3')
                ->where('transaksi.jurusan', $jurusan)
                ->groupBy('transaksi.user_id', 'transaksi.tagihan_id'); // Tambahkan kolom GROUP BY untuk kolom yang dipilih

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">Aksi</button>
                                <div class="dropdown-menu">
                                    <button class="dropdown-item" 
                                        data-id="' . $item->user_id . '" 
                                        data-tagihan_id="' . $item->tagihan_id . '" 
                                        data-user_id="' . $item->user_id . '" 
                                        data-toggle="modal" data-target="#editModal">Detail</button>
                                    <form action="' . route('data-tagihan-spp.destroy', $item->user_id) . '" method="POST">
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
                    // Menggunakan switch-case untuk menampilkan label status berdasarkan nilai status
                    switch ($item->status) {
                        case 0:
                            return '<span class="badge badge-warning">Menunggu Pembayaran</span>';
                        case 1:
                            return '<span class="badge badge-info">Pending</span>';
                        case 2:
                            return '<span class="badge badge-success">Sukses</span>';
                        default:
                            return '<span class="badge badge-danger">Undefined</span>';
                    }
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }


        return view('pages.data-pembayaran-pendaftaran', compact('siswa', 'tagihan'));
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
            // Simpan data ke dalam database
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

            // Simpan data ke database
            // Transaksi::create($request->all());
            return redirect()->route('data-tagihan-Pendaftaran.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            // Tangkap pengecualian dan tampilkan pesan kesalahan
            dd($e); // Menampilkan informasi exception ke terminal
            return redirect()->route('data-tagihan-Pendaftaran.index')->with('error', 'Terjadi kesalahan saat menyimpan data.');
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
        return redirect()->route('data-tagihan-Pendaftaran.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Transaksi::findOrFail($id);
        $data->delete();

        return redirect()->route('data-tagihan-Pendaftaran.index');
    }
}
