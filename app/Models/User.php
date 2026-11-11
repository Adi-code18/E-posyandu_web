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
        'role',
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

    /**
     * Role-Based Access Control Helpers
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isKetua(): bool
    {
        return $this->role === 'ketua';
    }

    public function isBidan(): bool
    {
        return $this->role === 'bidan';
    }

    public function isKader(): bool
    {
        return $this->role === 'kader';
    }

    /**
     * Check if user matches one of given roles.
     * 
     * @param string|array $roles
     * @return bool
     */
    public function hasRole(string|array $roles): bool
    {
        if (is_string($roles)) {
            $roles = explode(',', $roles);
        }

        $roles = array_map('trim', $roles);
        return in_array($this->role, $roles, true);
    }

    /**
     * Label resmi peran pengguna.
     */
    public function getRoleLabelAttribute(): string
    {
        return match ($this->role) {
            'admin' => 'Administrator Sistem',
            'ketua' => 'Ketua Posyandu',
            'bidan' => 'Bidan / Tenaga Medis',
            'kader' => 'Kader Lapangan',
            default => ucfirst($this->role ?? 'Kader'),
        };
    }

    /**
     * Badge visual class tag untuk UI.
     */
    public function getRoleBadgeClassAttribute(): string
    {
        return match ($this->role) {
            'admin' => 'tag-info',
            'ketua' => 'tag-warning',
            'bidan' => 'tag-primary',
            'kader' => 'tag-success',
            default => 'tag-neutral',
        };
    }
}
