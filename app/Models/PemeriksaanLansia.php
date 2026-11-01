<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanLansia extends Model
{
    use HasFactory;

    protected $table = 'pemeriksaan_lansia';
    protected $primaryKey = 'id_periksa';

    protected $fillable = [
        'tanggal',
        'bb',
        'tb',
        'tensi',
        'gula',
        'riwayat_penyakit',
        'status',
        'id_user',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
