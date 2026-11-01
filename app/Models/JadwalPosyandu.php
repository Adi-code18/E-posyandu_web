<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPosyandu extends Model
{
    use HasFactory;

    protected $table = 'jadwal_posyandu';
    protected $primaryKey = 'id_jadwal';

    protected $fillable = [
        'tanggal_pelaksanaan',
        'kegiatan_pelaksanaan',
        'status_pelaksanaan',
        'id_kader',
        'id_balita',
    ];

    public function kader()
    {
        return $this->belongsTo(Kader::class, 'id_kader', 'id_kader');
    }

    public function balita()
    {
        return $this->belongsTo(Warga::class, 'id_balita', 'NIK');
    }
}

