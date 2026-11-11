<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KunjunganRumah extends Model
{
    use HasFactory;

    protected $table = 'kunjungan_rumah';
    protected $primaryKey = 'id_kunjungan';

    protected $fillable = [
        'NIK',
        'id_kader',
        'tanggal',
        'kategori_sasaran',
        'checklist_hasil',
        'tanda_bahaya_ditemukan',
        'status_tindak_lanjut',
        'catatan',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'checklist_hasil' => 'array',
        'tanda_bahaya_ditemukan' => 'boolean',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'NIK', 'NIK');
    }

    public function kader()
    {
        return $this->belongsTo(Kader::class, 'id_kader', 'id_kader');
    }
}

