<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiUmum extends Model
{
    use HasFactory;

    protected $table = 'informasi_umum';
    protected $primaryKey = 'id_informasi';

    protected $fillable = [
        'judul',
        'isi_informasi',
        'tanggal_post',
        'kategori_info',
        'gambar_poster',
        'id_kader',
        'id_ketua',
    ];

    public function kader()
    {
        return $this->belongsTo(Kader::class, 'id_kader', 'id_kader');
    }

    public function ketua()
    {
        return $this->belongsTo(User::class, 'id_ketua', 'id_user');
    }
}

