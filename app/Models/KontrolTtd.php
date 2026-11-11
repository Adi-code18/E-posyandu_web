<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontrolTtd extends Model
{
    use HasFactory;

    protected $table = 'kontrol_ttd';
    protected $primaryKey = 'id_ttd';

    protected $fillable = [
        'NIK',
        'id_kader',
        'tanggal_konsumsi',
        'jumlah_tablet',
        'status_sasaran',
        'kadar_hb',
        'status_anemia',
        'efek_samping',
        'catatan',
    ];

    protected $casts = [
        'tanggal_konsumsi' => 'date',
        'kadar_hb' => 'float',
        'status_anemia' => 'boolean',
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

