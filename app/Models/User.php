<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'nama',
        'username',
        'jabatan',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function warga()
    {
        return $this->hasMany(Warga::class, 'id_user', 'id_user');
    }

    public function barang()
    {
        return $this->hasMany(BarangManajemen::class, 'id_ketua', 'id_user');
    }

    public function laporanPenjualan()
    {
        return $this->hasMany(LaporanPenjualan::class, 'id_ketua', 'id_user');
    }

    public function kasMasuk()
    {
        return $this->hasMany(TabelKasMasuk::class, 'id_ketua', 'id_user');
    }

    public function laporanKesehatan()
    {
        return $this->hasMany(LaporanKesehatan::class, 'id_ketua', 'id_user');
    }

    public function informasi()
    {
        return $this->hasMany(InformasiUmum::class, 'id_ketua', 'id_user');
    }
}
