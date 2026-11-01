<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kader extends Model
{
    use HasFactory;

    protected $table = 'kader';
    protected $primaryKey = 'id_kader';

    protected $fillable = [
        'nama_kader',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function warga()
    {
        return $this->hasMany(Warga::class, 'id_kader', 'id_kader');
    }

    public function jadwalPosyandu()
    {
        return $this->hasMany(JadwalPosyandu::class, 'id_kader', 'id_kader');
    }

    public function barang()
    {
        return $this->hasMany(BarangManajemen::class, 'id_kader', 'id_kader');
    }

    public function informasi()
    {
        return $this->hasMany(InformasiUmum::class, 'id_kader', 'id_kader');
    }
}
