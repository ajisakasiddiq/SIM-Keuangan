<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\tagihan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PembayaranKainSeragamController extends Controller
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
        $tagihan = tagihan::get();
        $siswa = User::where('role', 'siswa')->get();
        if (request()->ajax()) {
            $query = Transaksi::with('user')
                ->where('tagihan_id', '4')
                ->where('jurusan', $jurusan);
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '<a href="' . route('Details.index', ['user_id' => $item->user_id, 'tagihan_id' => $item->tagihan_id]) . '" class="btn btn-primary">Detail</a>';
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
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('pages.data-pembayaran-kainseragam', compact('siswa', 'tagihan', 'totaltransaksi', 'trans'));
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
            $data = $request->all();
            // Simpan data ke database
            if ($request->hasFile('bukti_transaksi')) {
                // Jika ada file yang diunggah, simpan file baru dan gunakan path yang baru
                $data['bukti_transaksi'] = $request->file('bukti_transaksi')->store('assets/bukti_transaksi', 'public');
            } else {
                // Jika tidak ada file yang diunggah, gunakan foto lama (path yang sudah ada)
                $data['bukti_transaksi'] = NULL;
            }
            Transaksi::create($data);
            return redirect()->route('data-tagihan-kainSeragam.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            // Tangkap pengecualian dan tampilkan pesan kesalahan
            dd($e); // Menampilkan informasi exception ke terminal
            return redirect()->route('data-tagihan-kainSeragam.index')->with('error', 'Terjadi kesalahan saat menyimpan data.');
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
        $item = Transaksi::findOrFail($id);

        // Ambil data yang dikirimkan dalam request
        $data = $request->all();

        // Periksa apakah ada file yang diunggah
        if ($request->hasFile('bukti_transaksi')) {
            // Jika ada file yang diunggah, simpan file baru dan gunakan path yang baru
            $data['bukti_transaksi'] = $request->file('bukti_transaksi')->store('assets/bukti_transaksi', 'public');
        } else {
            // Jika tidak ada file yang diunggah, gunakan foto lama (path yang sudah ada)
            $data['bukti_transaksi'] = $item->bukti_transaksi;
        }

        // Lakukan pembaruan data transaksi dengan data yang baru
        $item->update($data);
        return redirect()->route('data-tagihan-kainSeragam.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Transaksi::findOrFail($id);
        $data->delete();

        return redirect()->route('data-tagihan-kainSeragam.index');
    }
}
