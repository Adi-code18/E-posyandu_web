<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanBalita extends Model
{
    use HasFactory;

    protected $table = 'pemeriksaan_balita';
    protected $primaryKey = 'id_periksa';

    protected $fillable = [
        'tanggal',
        'bb',
        'tb',
        'lk',
        'la',
        'lp',
        'status',
        'id_user',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
