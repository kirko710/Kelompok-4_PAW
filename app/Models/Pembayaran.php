<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pembayaran extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pembayarans';
    
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

    public function scopeByStatus($query, $status)
    {
        return $query->where('status_bayar', $status);
    }

    public function scopeByMetode($query, $metode)
    {
        return $query->where('metode_pembayaran', $metode);
    }

    public function scopeSudahLunas($query)
    {
        return $query->where('status_bayar', 'paid');
    }

    public function scopeBelumSelesai($query)
    {
        return $query->whereIn('status_bayar', ['unpaid', 'pending', 'failed']);
    }

    public function getIsLunasAttribute()
    {
        return $this->status_bayar === 'paid';
    }
}
