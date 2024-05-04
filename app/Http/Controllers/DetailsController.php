<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cicilan;
use App\Models\tagihan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user_id = $request->input('user_id');
        $tagihan_id = $request->input('tagihan_id');
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
        // Mengambil data user berdasarkan user_id
        $user = User::findOrFail($user_id);

        // Mengambil data tagihan berdasarkan tagihan_id
        $tagihan = Tagihan::findOrFail($tagihan_id);
        // $namatagihan = Tagihan::where('id', $tagihan_id);

        // Mengambil transaksi berdasarkan user_id dan tagihan_id
        $transaksi = Transaksi::with('user')
            ->where('tagihan_id', $tagihan_id)
            ->where('user_id', $user_id)
            ->get();

        // Menghitung total transaksi berdasarkan user_id dan tagihan_id
        $total = Transaksi::selectRaw('user_id, tagihan_id, SUM(total) as total_sum')
            ->where('tagihan_id', $tagihan_id)
            ->where('user_id', $user_id)
            ->groupBy('user_id', 'tagihan_id')
            ->first();

        // Menghitung total cicilan berdasarkan user_id dan tagihan_id
        $totalcicilan = Cicilan::selectRaw('user_id, tagihan_id, SUM(total) as total_sum')
            ->where('tagihan_id', $tagihan_id)
            ->where('user_id', $user_id)
            ->groupBy('user_id', 'tagihan_id')
            ->get();

        // Mengambil data cicilan berdasarkan user_id dan tagihan_id tertentu
        $cicilan = Cicilan::where('tagihan_id', $tagihan_id)
            ->where('user_id', $user_id)
            ->get();

        $no = 1; // Ini mungkin untuk nomor urut, sesuaikan dengan kebutuhan

        return view('pages.detail.detail', compact('user_id', 'tagihan_id', 'no', 'user', 'tagihan', 'transaksi', 'total', 'totalcicilan', 'cicilan', 'trans', 'totaltransaksi', 'tagihan'));
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
            $data['bukti_pembayaran'] = $request->file('bukti_pembayaran')->store('assets/bukti_transaksi', 'public');
            Cicilan::create($data);
            $user_id = $data['user_id'];
            $tagihan_id = $data['tagihan_id'];

            // Redirect dengan menyertakan user_id dan tagihan_id sebagai parameter
            return redirect()->route('Details.index', compact('user_id', 'tagihan_id'))
                ->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            // Tangkap pengecualian dan tampilkan pesan kesalahan
            dd($e); // Menampilkan informasi exception ke terminal
            return redirect()->route('Details.index', compact('user_id', 'tagihan_id'))->with('error', 'Terjadi kesalahan saat menyimpan data.');
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
        //
    }
}
