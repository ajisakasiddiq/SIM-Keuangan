<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Transaksi;
use App\Mail\BillingEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendBillingEmails extends Command
{
    protected $signature = 'billing:send';
    protected $description = 'Send billing emails based on due dates';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $today = Carbon::now()->timezone('Asia/Jakarta')->toDateString();
        $transaksis = Transaksi::with('user', 'jenistagihan')
            ->where('status', '0')
            ->whereDate('date_akhir', $today)
            ->get();

        // Kelompokkan transaksi berdasarkan tagihan_id
        $groupedTransaksis = $transaksis->groupBy('tagihan_id');

        foreach ($groupedTransaksis as $tagihanId => $transaksiGroup) {
            // Ambil pengguna berdasarkan user_id (sama untuk semua transaksi dalam satu grup)
            $user = $transaksiGroup->first()->user;

            // Buat array tagihan untuk email
            $tagihans = [];
            foreach ($transaksiGroup as $transaksi) {
                $tagihans[$tagihanId][] = [
                    'nama' => optional($transaksi->jenistagihan)->name,
                    'keterangan' => $transaksi->keterangan,
                    'total_tagihan' => $transaksi->total,
                ];
            }

            // Kirim email tagihan ke pengguna yang sama
            Mail::to($user->email)
                ->send(new BillingEmail($user, $tagihans));

            // Tandai transaksi sebagai sudah dikirim email tagihan
            foreach ($transaksiGroup as $transaksi) {
                $transaksi->email_terkirim = true;
                $transaksi->save();
            }
        }

        $this->info('Billing emails sent successfully.');
    }
}
