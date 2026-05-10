<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemesanan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_user',
        'id_lapangan',
        'tanggal_pesan',
        'waktu_mulai',
        'waktu_selesai',
        'total_harga',
        'status_pesanan',
    ];

    protected $casts = [
        'tanggal_pesan' => 'date',
        'total_harga'   => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function lapangan()
    {
        return $this->belongsTo(Lapangan::class, 'id_lapangan');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_pemesanan');
    }
}
