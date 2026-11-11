<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KartuKembangAnak extends Model
{
    use HasFactory;

    protected $table = 'kartu_kembang_anak';
    protected $primaryKey = 'id_kka';

    protected $fillable = [
        'NIK',
        'id_kader',
        'id_user',
        'tanggal_pemeriksaan',
        'usia_bulan',
        'gerak_kasar',
        'gerak_halus',
        'komunikasi_pasif',
        'komunikasi_aktif',
        'kecerdasan',
        'menolong_diri_sendiri',
        'tingkah_laku_sosial',
        'capai_garis_merah',
        'bulan_tidak_capai_beruntun',
        'status_rujuk',
        'catatan',
    ];

    protected $casts = [
        'tanggal_pemeriksaan' => 'date',
        'gerak_kasar' => 'boolean',
        'gerak_halus' => 'boolean',
        'komunikasi_pasif' => 'boolean',
        'komunikasi_aktif' => 'boolean',
        'kecerdasan' => 'boolean',
        'menolong_diri_sendiri' => 'boolean',
        'tingkah_laku_sosial' => 'boolean',
        'capai_garis_merah' => 'boolean',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'NIK', 'NIK');
    }

    public function kader()
    {
        return $this->belongsTo(Kader::class, 'id_kader', 'id_kader');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}

