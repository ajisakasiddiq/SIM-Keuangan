<?php

namespace App\Http\Controllers\Siswa;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Cicilan;
use App\Models\tagihan;
use App\Models\Rekening;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PembayaranDaftarUlangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::id();
        $no = 1;
        $trans = Transaksi::with(['user', 'jenistagihan'])
            ->where('status', '0')
            ->where('user_id', $user)
            ->latest()
            ->get();
        $totaltransaksi = Transaksi::where('status', '0')->count();
        $trans->map(function ($item) {
            $item->tgl_pembayaran_formatted = \Carbon\Carbon::parse($item->tgl_pembayaran)->format('F j, Y');
            return $item;
        });
        $tagihan = tagihan::get();
        $siswa = User::where('role', 'siswa')->get();
        $transaksi = Transaksi::with('user')
            ->where('tagihan_id', '2')
            ->where('user_id', $user)
            ->get();
        $total = Transaksi::selectRaw('user_id, tagihan_id, SUM(total) as total_sum')
            ->where('tagihan_id', '4') // Filter berdasarkan tagihan_id tertentu
            ->where('user_id', $user) // Filter berdasarkan user_id tertentu
            ->groupBy('user_id', 'tagihan_id') // Kelompokkan berdasarkan user_id dan tagihan_id
            ->get();
        $transaksi2 = Transaksi::with('user')
            ->where('tagihan_id', '2')
            ->where('status', '2')
            ->where('user_id', $user)
            ->limit(1)
            ->get();
        $totalcicilan = Cicilan::selectRaw('user_id, tagihan_id, SUM(total) as total_sum')
            ->where('tagihan_id', '2') // Filter berdasarkan tagihan_id tertentu
            ->where('user_id', $user) // Filter berdasarkan user_id tertentu
            ->groupBy('user_id', 'tagihan_id') // Kelompokkan berdasarkan user_id dan tagihan_id
            ->get();
        $cicilan = Cicilan::where('tagihan_id', '2')
            ->where('user_id', $user)
            ->get();
        $userjurusan = Auth::user()->jurusan;
        $rekening = Rekening::where('jurusan', $userjurusan)->get();
        return view('pages.siswa.pembayaran-daftarulang', compact('no', 'total', 'transaksi2', 'siswa', 'tagihan', 'transaksi', 'cicilan', 'totalcicilan', 'trans', 'totaltransaksi', 'rekening'));
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
            ]);
            // Simpan data ke database
            $data = $request->all();
            $data['bukti_pembayaran'] = $request->file('bukti_pembayaran')->store('assets/bukti_transaksi', 'public');
            $tgl = $data['tgl'] = Carbon::now();
            $cicilan = Cicilan::create($data);
            $this->updateTransaksiStatus($cicilan, $tgl);
            return redirect()->route('Tagihan-DaftarUlang.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->route('Tagihan-DaftarUlang.index')->with('error', 'Terjadi kesalahan saat menyimpan data.');
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
                ->update(['status' => '1', 'tgl_pembayaran' => $tgl]);
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
