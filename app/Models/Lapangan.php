<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lapangan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_venue',
        'nama',
        'jenis_olahraga',
        'harga_sewa',
        'foto',
        'jam_buka',
        'jam_tutup',
    ];

    protected $casts = [
        'harga_sewa' => 'decimal:2',
    ];

    /**
     * Lapangan dimiliki oleh sebuah Venue.
     */
    public function venue()
    {
        return $this->belongsTo(Venue::class, 'id_venue');
    }

    /**
     * Lapangan memiliki banyak Pemesanan.
     */
    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class, 'id_lapangan');
    }

    /**
     * Cek apakah lapangan memiliki pemesanan aktif/pending.
     */
    public function hasActivePemesanan(): bool
    {
        return $this->pemesanans()
            ->whereIn('status_pesanan', ['pending', 'confirmed'])
            ->exists();
    }
}
