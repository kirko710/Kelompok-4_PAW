<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venue extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'venues';
    
    protected $fillable = [
        'id_user',
        'nama',
        'lokasi',
        'deskripsi',
        'foto',
    ];
    
    protected $hidden = [
        'id_user',
    ];
    
    protected $appends = [
        'foto_url',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function lapangans()
    {
        return $this->hasMany(Lapangan::class, 'id_venue');
    }

    public function pemesanans()
    {
        return $this->hasManyThrough(Pemesanan::class, Lapangan::class, 'id_venue', 'id_lapangan');
    }

    public function getFotoUrlAttribute()
    {
        if (!$this->foto) {
            return null;
        }
        
        return asset('storage/venues/' . $this->foto);
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('id_user', $userId);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('nama', 'like', "%{$search}%")
              ->orWhere('lokasi', 'like', "%{$search}%");
        });
    }

    public function scopeWithLapangans($query)
    {
        return $query->with('lapangans');
    }

    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }

    public function isOwnedBy(User $user)
    {
        return $this->id_user === $user->id;
    }
    
    public function setFotoAttribute($value)
    {
        if ($value && $value instanceof \Illuminate\Http\UploadedFile) {
            $this->attributes['foto'] = $value->store('venues', 'public');
        } else {
            $this->attributes['foto'] = $value;
        }
    }
}
