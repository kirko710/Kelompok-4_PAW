<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pemesanan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pemesanans';
    
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
        'waktu_mulai' => 'datetime:H:i',
        'waktu_selesai' => 'datetime:H:i',
        'total_harga' => 'decimal:2',
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

    public function scopeByStatus($query, $status)
    {
        return $query->where('status_pesanan', $status);
    }

    public function scopeByTanggal($query, $tanggal)
    {
        return $query->whereDate('tanggal_pesan', $tanggal);
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('id_user', $userId);
    }

    public function scopeBelumSelesai($query)
    {
        return $query->whereIn('status_pesanan', ['pending', 'confirmed']);
    }

    public function getDurasiAttribute()
    {
        return $this->waktu_mulai->diffInMinutes($this->waktu_selesai);
    }

    public function scopeAntaraTanggal($query, $tanggalMulai, $tanggalSelesai)
    {
        return $query->whereBetween('tanggal_pesan', [$tanggalMulai, $tanggalSelesai]);
    }

    public function cekDanBatalJikaKedaluwarsa()
    {
        if ($this->status_pesanan === 'pending' && $this->created_at->addHour()->isPast()) {
            $this->update(['status_pesanan' => 'cancelled']);
            if ($this->pembayaran) {
                $this->pembayaran->update(['status_bayar' => 'failed']);
            }
            return true;
        }
        return false; 
    }
}