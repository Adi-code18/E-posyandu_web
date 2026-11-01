<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangManajemen extends Model
{
    use HasFactory;

    protected $table = 'barang_manajemen';
    protected $primaryKey = 'id_barang';

    protected $fillable = [
        'nama_barang',
        'jumlah',
        'tanggal_masuk',
        'kategori',
        'harga',
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

    public function laporanPenjualan()
    {
        return $this->hasMany(LaporanPenjualan::class, 'id_barang', 'id_barang');
    }
}
