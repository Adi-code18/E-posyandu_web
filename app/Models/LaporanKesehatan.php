<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKesehatan extends Model
{
    use HasFactory;

    protected $table = 'laporan_kesehatan';
    protected $primaryKey = 'id_lap_kesehatan';

    protected $fillable = [
        'jenis_laporan',
        'tanggal_dibuat',
        'id_periksa',
        'id_ketua',
    ];

    public function ketua()
    {
        return $this->belongsTo(User::class, 'id_ketua', 'id_user');
    }
}

