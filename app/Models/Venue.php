<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Venue extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_user',
        'nama',
        'lokasi',
        'deskripsi',
        'foto',
    ];

    /**
     * Venue dimiliki oleh seorang User (pengelola).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Venue memiliki banyak Lapangan.
     */
    public function lapangans()
    {
        return $this->hasMany(Lapangan::class, 'id_venue');
    }
}
