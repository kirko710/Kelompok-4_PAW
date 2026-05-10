<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pemesanan',
        'metode_pembayaran',
        'status_bayar',
        'tanggal_pembayaran',
        'nomor_referensi',
        'catatan',
    ];

    protected $casts = [
        'tanggal_pembayaran' => 'datetime',
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan');
    }
}
