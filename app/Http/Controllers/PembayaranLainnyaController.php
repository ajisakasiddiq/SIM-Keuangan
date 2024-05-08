<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\tagihan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PembayaranLainnyaController extends Controller
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
                ->where('tagihan_id', '6')
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
                ->addColumn('bukti_transaksi', function ($item) {
                    if ($item->bukti_transaksi) {
                        // Jika ada data bukti transaksi, tampilkan tautan dan gambar
                        return '<td><a href="' . Storage::url($item->bukti_transaksi) . '" data-lightbox="gallery">
                                    <img src="' . Storage::url($item->bukti_transaksi) . '" alt="Bukti Transaksi" style="width: 100px; height: auto;">
                                </a></td>';
                    } else {
                        // Jika tidak ada data bukti transaksi, tampilkan tanda strip (-)
                        return '<td>-</td>';
                    }
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
                ->rawColumns(['status', 'bukti_transaksi', 'action'])
                ->make(true);
        }
        return view('pages.data-pembayaran-lainnya', compact('siswa', 'tagihan', 'trans', 'totaltransaksi'));
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
            return redirect()->route('data-tagihan-lainnya.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            // Tangkap pengecualian dan tampilkan pesan kesalahan
            dd($e); // Menampilkan informasi exception ke terminal
            return redirect()->route('data-tagihan-lainnya.index')->with('error', 'Terjadi kesalahan saat menyimpan data.');
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
        return redirect()->route('data-tagihan-lainnya.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Transaksi::findOrFail($id);
        $data->delete();

        return redirect()->route('data-tagihan-lainnya.index');
    }
}
