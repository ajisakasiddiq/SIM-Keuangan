<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
            $request->validate([
                'total' => 'required|numeric|min:0',
                'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'tgl' => 'required',
                // Tambahkan validasi lainnya jika perlu
            ]);
            // Simpan data ke database
            $data = $request->all();
            $data['bukti_pembayaran'] = $request->file('bukti_pembayaran')->store('assets/bukti_transaksi', 'public');
            $data['tgl'] = Carbon::now();
            $cicilan = Cicilan::create($data);
            $user_id = $data['user_id'];
            $tagihan_id = $data['tagihan_id'];
            $tgl = $request['tgl'];
            $this->updateTransaksiStatus($cicilan, $tgl);
            // Redirect dengan menyertakan user_id dan tagihan_id sebagai parameter
            return redirect()->route('Details.index', compact('user_id', 'tagihan_id'))
                ->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            $data = $request->all();
            $user_id = $data['user_id'];
            $tagihan_id = $data['tagihan_id'];
            $tgl = $request['tgl'];
            return redirect()->route('Details.index', compact('user_id', 'tagihan_id'))->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    private function updateTransaksiStatus($cicilan, $tgl)
    {
        $tagihanId = $cicilan->tagihan_id;
        $userId = $cicilan->user_id;

        // Hitung total cicilan untuk tagihan_id dan user_id yang sama
        $totalCicilan = Cicilan::where('tagihan_id', $tagihanId)
            ->where('user_id', $userId)
            ->sum('total');

        // Hitung total transaksi untuk tagihan_id dan user_id yang sama
        $totalTransaksi = Transaksi::where('tagihan_id', $tagihanId)
            ->where('user_id', $userId)
            ->sum('total');

        // Periksa apakah total cicilan mencapai atau melebihi total transaksi
        if ($totalCicilan >= $totalTransaksi) {
            // Update status transaksi menjadi 'LUNAS'
            Transaksi::where('tagihan_id', $tagihanId)
                ->where('user_id', $userId)
                ->update(['status' => '2', 'tgl_pembayaran' => $tgl]);
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
    public function update(Request $request)
    {
        // Validasi request

        // Dapatkan data dari request
        $user_id = $request->input('user_id');
        $tagihan_id = $request->input('tagihan_id');
        $status = $request->input('status');

        // Update semua transaksi berdasarkan user_id dan tagihan_id
        Transaksi::where('user_id', $user_id)
            ->where('tagihan_id', $tagihan_id)
            ->update(['status' => $status]);

        // Redirect atau berikan respon sesuai kebutuhan
        return redirect()->route('Details.index', ['user_id' => $user_id, 'tagihan_id' => $tagihan_id])
            ->with('success', 'Status pembayaran telah diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
