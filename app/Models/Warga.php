<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    protected $table = 'warga';
    protected $primaryKey = 'NIK';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'NIK',
        'nama_lengkap',
        'tanggal_lahir',
        'nama_ayah',
        'jenis_kelamin',
        'nama_ibu',
        'status',
        'id_user',
        'id_kader',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function kader()
    {
        return $this->belongsTo(Kader::class, 'id_kader', 'id_kader');
    }

    public function jadwalPosyandu()
    {
        return $this->hasMany(JadwalPosyandu::class, 'id_balita', 'NIK');
    }
}
