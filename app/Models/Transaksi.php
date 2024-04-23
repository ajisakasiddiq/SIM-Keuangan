<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $fillable = [
        'keterangan',
        'date_awal',
        'date_akhir',
        'total',
        'jenis_transaksi',
        'bukti_transaksi',
        'metode',
        'status',
        'tagihan_id',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
