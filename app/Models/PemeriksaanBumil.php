<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanBumil extends Model
{
    use HasFactory;

    protected $table = 'pemeriksaan_bumil';
    protected $primaryKey = 'id_periksa';

    protected $fillable = [
        'tanggal',
        'usia_kehamilan',
        'bb',
        'tb',
        'la',
        'lp',
        'tensi',
        'status',
        'id_user',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
