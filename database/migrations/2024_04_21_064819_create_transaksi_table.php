<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('keterangan')->nullable();
            $table->date('date_awal')->nullable();
            $table->date('date_akhir')->nullable();
            $table->string('total')->nullable();
            $table->enum('jenis_transaksi', ['Pendapatan', 'Pengeluaran'])->nullable();
            $table->string('bukti_transaksi')->nullable();
            $table->enum('metode', ['cash', 'cicil'])->nullable();
            $table->enum('status', ['0', '1', '2'])->nullable();
            $table->string('tahunajar')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('tgl_pembayaran')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('tagihan_id');
            $table->foreign('tagihan_id')->references('id')->on('jenistagihan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
