<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelKasMasuk extends Model
{
    use HasFactory;

    protected $table = 'tabel_kas_masuk';
    protected $primaryKey = 'id_laporan';

    protected $fillable = [
        'total_dana_dikelola',
        'status_laporan',
        'tanggal_terima_dana',
        'nama_sumber',
        'ket_penggunaan_dana',
        'id_ketua',
    ];

    public function ketua()
    {
        return $this->belongsTo(User::class, 'id_ketua', 'id_user');
    }
}

