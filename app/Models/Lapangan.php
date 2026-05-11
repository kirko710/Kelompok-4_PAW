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

    public function venue()
    {
        return $this->belongsTo(Venue::class, 'id_venue');
    }

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class, 'id_lapangan');
    }

    
    public function scopeByJenisOlahraga($query, $jenis)
    {
        return $query->where('jenis_olahraga', $jenis);
    }

    public function scopeByVenue($query, $venueId)
    {
        return $query->where('id_venue', $venueId);
    }

    public function getHasFotoAttribute()
    {
        return !is_null($this->foto);
    }
    
    public function hasActivePemesanan(): bool
    {
        return $this->pemesanans()
            ->whereIn('status_pesanan', ['pending', 'confirmed'])
            ->exists();
    }
}
