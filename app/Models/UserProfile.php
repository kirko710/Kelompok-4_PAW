<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'alamat',
        'tanggal_lahir',
        'telepon',
        'bank',
        'rekening',
        'olahraga_favorit',
    ];

    protected $casts = [
        'olahraga_favorit' => 'array',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
