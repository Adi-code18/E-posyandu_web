<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPenjualan extends Model
{
    use HasFactory;

    protected $table = 'laporan_penjualan';
    protected $primaryKey = 'id_penjualan';

    protected $fillable = [
        'nominal',
        'jumlah_barang',
        'tanggal_keluar',
        'total_harga',
        'id_barang',
        'id_ketua',
    ];

    public function barang()
    {
        return $this->belongsTo(BarangManajemen::class, 'id_barang', 'id_barang');
    }

    public function ketua()
    {
        return $this->belongsTo(User::class, 'id_ketua', 'id_user');
    }
}
