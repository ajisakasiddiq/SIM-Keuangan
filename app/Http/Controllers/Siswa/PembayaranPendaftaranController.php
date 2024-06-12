<?php

namespace App\Http\Controllers\Siswa;

use App\Models\User;
use App\Models\tagihan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cicilan;
use App\Models\Rekening;
use Illuminate\Support\Facades\Auth;

class PembayaranPendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user()->id;
        $userjurusan = Auth::user()->jurusan;
        $no = 1;
        $tagihan = tagihan::get();
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
        $siswa = User::where('role', 'siswa')->get();
        $transaksi = Transaksi::with('user')
            ->where('tagihan_id', '3')
            ->where('user_id', $user)
            ->get();
        $total = Transaksi::selectRaw('user_id, tagihan_id, SUM(total) as total_sum')
            ->where('tagihan_id', '3') // Filter berdasarkan tagihan_id tertentu
            ->where('user_id', $user) // Filter berdasarkan user_id tertentu
            ->groupBy('user_id', 'tagihan_id') // Kelompokkan berdasarkan user_id dan tagihan_id
            ->first();
        $totalcicilan = Cicilan::selectRaw('user_id, tagihan_id, SUM(total) as total_sum')
            ->where('tagihan_id', '3') // Filter berdasarkan tagihan_id tertentu
            ->where('user_id', $user) // Filter berdasarkan user_id tertentu
            ->groupBy('user_id', 'tagihan_id') // Kelompokkan berdasarkan user_id dan tagihan_id
            ->get();
        $cicilan = Cicilan::where('tagihan_id', '3')
            ->where('user_id', $user)
            ->get();
        $rekening = Rekening::where('jurusan', $userjurusan)->get();

        return view('pages.siswa.pembayaran-pendaftaran', compact('no', 'total', 'siswa', 'tagihan', 'transaksi', 'cicilan', 'totalcicilan', 'trans', 'totaltransaksi', 'rekening'));
    }
    public function cetak($id)
    {
        $user = Auth::user()->id;
        $no = 1;
        $title = 'Pendaftaran';
        $transaksi = Transaksi::with('user')
            ->where('tagihan_id', $id)
            ->where('user_id', $user)
            ->get();
        $total = Transaksi::selectRaw('user_id, tagihan_id, SUM(total) as total_sum')
            ->where('tagihan_id', $id) // Filter berdasarkan tagihan_id tertentu
            ->where('user_id', $user) // Filter berdasarkan user_id tertentu
            ->groupBy('user_id', 'tagihan_id') // Kelompokkan berdasarkan user_id dan tagihan_id
            ->first();

        return view('pages.cetak.cetak', compact('no', 'total', 'transaksi', 'title'));
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
            $cicilan = Cicilan::create($data);
            $tgl = $request['tgl'];
            $this->updateTransaksiStatus($cicilan, $tgl);
            return redirect()->route('Tagihan-Pendaftaran.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            // Tangkap pengecualian dan tampilkan pesan kesalahan
            dd($e); // Menampilkan informasi exception ke terminal
            return redirect()->route('Tagihan-Pendaftaran.index')->with('error', 'Terjadi kesalahan saat menyimpan data.');
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
