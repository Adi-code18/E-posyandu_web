<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
        'is_prematur',
        'usia_kehamilan_minggu',
        'fcm_token',
        'id_user',
        'id_kader',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'is_prematur' => 'boolean',
        'usia_kehamilan_minggu' => 'integer',
    ];

    /**
     * Hitung Usia Koreksi Prematur sesuai Aturan Bisnis BR-02 & Standar Kemenkes (Kurva Fenton)
     * Usia Koreksi = Usia Kronologis - (40 minggu - usia gestasi lahir). Berlaku hingga 2 tahun (24 bulan).
     */
    public function getUsiaKoreksiAttribute()
    {
        if (!$this->is_prematur || empty($this->usia_kehamilan_minggu)) {
            return null;
        }

        $birthDate = Carbon::parse($this->tanggal_lahir);
        $now = Carbon::now();
        $usiaKronologisBulan = $birthDate->diffInMonths($now);

        // Setelah usia kronologis 2 tahun, transisi penuh ke kurva pertumbuhan WHO
        if ($usiaKronologisBulan >= 24) {
            return 'Transisi Kurva WHO (Usia > 2 Tahun)';
        }

        $mingguKurang = max(0, 40 - (int) $this->usia_kehamilan_minggu);
        $hariKurang = $mingguKurang * 7;
        $tanggalKoreksi = (clone $birthDate)->addDays($hariKurang);

        if ($tanggalKoreksi->isFuture()) {
            $hariMenujuAterm = $now->diffInDays($tanggalKoreksi);
            return "Preterm ({$hariMenujuAterm} hari menuju HPL 40 minggu)";
        }

        $bulanKoreksi = $tanggalKoreksi->diffInMonths($now);
        $sisaHari = $tanggalKoreksi->copy()->addMonths($bulanKoreksi)->diffInDays($now);

        $teksSisa = $sisaHari > 0 ? " {$sisaHari} Hari" : '';
        return "{$bulanKoreksi} Bulan{$teksSisa} (Kurva Fenton)";
    }

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

    public function kartuKembangAnak()
    {
        return $this->hasMany(KartuKembangAnak::class, 'NIK', 'NIK')->orderBy('tanggal_pemeriksaan', 'desc');
    }

    public function kontrolTtd()
    {
        return $this->hasMany(KontrolTtd::class, 'NIK', 'NIK')->orderBy('tanggal_konsumsi', 'desc');
    }

    public function kunjunganRumah()
    {
        return $this->hasMany(KunjunganRumah::class, 'NIK', 'NIK')->orderBy('tanggal', 'desc');
    }
}
