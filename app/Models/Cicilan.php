<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cicilan extends Model
{
    use HasFactory;
    protected $table = 'cicil';
    protected $fillable = [
        'tgl',
        'total',
        'bukti_pembayaran',
        'tagihan_id',
    ];
    public function jenistagihan()
    {
        return $this->belongsTo(tagihan::class, 'tagihan_id', 'id');
    }
}
