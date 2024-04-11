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
        Schema::create('rincian_tagihans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('total');
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
        Schema::dropIfExists('rincian_tagihans');
    }
};
