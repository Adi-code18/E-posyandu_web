@extends('layouts.admin')

@section('title', 'Pencatatan Fisik')
@section('breadcrumbs', 'Beranda > Daftar Anggota > Pencatatan Fisik')
@section('page_title', 'Pencatatan Fisik & Antropometri')

@section('content')
<p class="text-muted mb-4">Mencatat data pertumbuhan dan status kesehatan fisik anggota Posyandu.</p>

<!-- Tabs -->
<div style="display: flex; gap: 10px; margin-bottom: 2rem; background: #eee; padding: 5px; border-radius: 12px; width: fit-content;">
    @foreach(['Balita', 'Ibu Hamil', 'Remaja', 'Lansia'] as $tab)
    <button class="btn" style="padding: 8px 20px; font-size: 0.85rem; background: {{ ($warga->status ?? 'Balita') == $tab ? '#fff' : 'transparent' }}; box-shadow: {{ ($warga->status ?? 'Balita') == $tab ? 'var(--shadow)' : 'none' }}; font-weight: {{ ($warga->status ?? 'Balita') == $tab ? '700' : '400' }};">
        {{ $tab }}
    </button>
    @endforeach
</div>

<div class="content-grid" style="grid-template-columns: 2fr 1fr;">
    <div class="card">
        <div style="background: #f0f4f1; border-left: 4px solid var(--primary); padding: 1rem; border-radius: 8px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <div>
                <span style="font-size: 0.7rem; text-transform: uppercase; color: var(--primary); font-weight: 700;">Warga Sasaran Terpilih</span>
                <div style="font-weight: 700; font-size: 1.05rem;">
                    {{ $warga->nama_lengkap ?? 'Belum ada warga dipilih' }} 
                    <span style="font-weight: 400; color: #666; font-size: 0.85rem; margin-left: 10px;">(NIK: {{ $warga->NIK ?? '-' }})</span>
                </div>
            </div>
            <a href="{{ route('admin.daftar-anggota') }}" style="font-size: 0.8rem; color: var(--primary); font-weight: 700; text-decoration: none;">
                <i class="fa-solid fa-arrows-rotate"></i> GANTI WARGA
            </a>
        </div>

        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 2rem;">
            <div class="icon-btn" style="background: var(--primary-light); color: var(--primary);"><i class="fa-solid fa-file-waveform"></i></div>
            <div>
                <h4 class="serif">Formulir Pemeriksaan {{ $warga->status ?? 'Balita' }}</h4>
                <p style="font-size: 0.8rem; color: var(--text-muted);">Silakan lengkapi parameter antropometri pengukuran di bawah ini.</p>
            </div>
        </div>

        <form action="{{ route('admin.pemeriksaan.store') }}" method="POST">
            @csrf
            <input type="hidden" name="nik" value="{{ $warga->NIK ?? '' }}">

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                <div class="form-group">
                    <label class="form-label">Tinggi Badan (cm) <span style="color: red;">*</span></label>
                    <div style="position: relative;">
                        <input type="number" step="0.1" name="tb" class="form-control" placeholder="0.0" required>
                        <span style="position: absolute; right: 15px; top: 12px; color: #999; font-size: 0.8rem;">cm</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Berat Badan (kg) <span style="color: red;">*</span></label>
                    <div style="position: relative;">
                        <input type="number" step="0.1" name="bb" class="form-control" placeholder="0.0" required>
                        <span style="position: absolute; right: 15px; top: 12px; color: #999; font-size: 0.8rem;">kg</span>
                    </div>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                <div class="form-group">
                    <label class="form-label">Lingkar Kepala (cm)</label>
                    <div style="position: relative;">
                        <input type="number" step="0.1" name="lk" class="form-control" placeholder="0.0">
                        <span style="position: absolute; right: 15px; top: 12px; color: #999; font-size: 0.8rem;">cm</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Lingkar Lengan Atas (cm)</label>
                    <div style="position: relative;">
                        <input type="number" step="0.1" name="la" class="form-control" placeholder="0.0">
                        <span style="position: absolute; right: 15px; top: 12px; color: #999; font-size: 0.8rem;">cm</span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Catatan Kesehatan / Rekomendasi Gizi</label>
                <textarea name="catatan" class="form-control" rows="4" placeholder="Masukkan indikator kesehatan, catatan nafsu makan, imunisasi yang diberikan, atau rujukan..."></textarea>
            </div>

            <div style="display: flex; gap: 15px; margin-top: 2rem;">
                <button type="submit" class="btn btn-primary" style="flex: 1; justify-content: center;">
                    <i class="fa-solid fa-save"></i> Simpan Pemeriksaan
                </button>
                <button type="reset" class="btn" style="background: #eee; color: #666;">Atur Ulang</button>
            </div>
        </form>
    </div>

    <div style="display: flex; flex-direction: column; gap: 24px;">
        <div class="card">
            <h4 class="serif mb-4" style="font-size: 1rem;">Profil Subjek Pemeriksaan</h4>
            <div style="display: flex; flex-direction: column; align-items: center; text-align: center; margin-bottom: 2rem;">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($warga->nama_lengkap ?? 'Posyandu') }}&background=random" style="width: 80px; height: 80px; border-radius: 50%; margin-bottom: 1rem; object-fit: cover;">
                <h5 class="serif" style="font-size: 1.1rem; margin-bottom: 4px;">{{ $warga->nama_lengkap ?? '-' }}</h5>
                <p style="font-size: 0.75rem; color: var(--text-muted); margin: 0;">NIK: {{ $warga->NIK ?? '-' }}</p>
                <span style="display: inline-block; margin-top: 6px; font-size: 0.7rem; font-weight: 700; background: #f0f4f1; color: var(--primary); padding: 3px 10px; border-radius: 12px;">
                    {{ $warga->status ?? 'Balita' }}
                </span>
            </div>

            <div style="display: flex; flex-direction: column; gap: 15px;">
                <div style="background: #fdf8f3; padding: 12px; border-radius: 12px;">
                    <div style="font-size: 0.65rem; color: var(--text-muted); text-transform: uppercase;">Nama Orang Tua / Wali</div>
                    <div style="font-weight: 600;">{{ $warga->nama_ibu ?? $warga->nama_ayah ?? '-' }}</div>
                </div>
                <div style="background: #fdf8f3; padding: 12px; border-radius: 12px;">
                    <div style="font-size: 0.65rem; color: var(--text-muted); text-transform: uppercase;">Usia</div>
                    <div style="font-weight: 600;">
                        @if(isset($warga->tanggal_lahir))
                            {{ \Carbon\Carbon::parse($warga->tanggal_lahir)->age }} Tahun
                        @else
                            -
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
            <div class="card" style="padding: 1.5rem; text-align: center; background: #f5f5f0;">
                <i class="fa-solid fa-syringe" style="color: var(--primary); font-size: 1.5rem; margin-bottom: 10px;"></i>
                <div style="font-size: 0.7rem; font-weight: 700; text-transform: uppercase;">Imunisasi</div>
            </div>
            <div class="card" style="padding: 1.5rem; text-align: center; background: #f5f5f0;">
                <i class="fa-solid fa-apple-whole" style="color: var(--primary); font-size: 1.5rem; margin-bottom: 10px;"></i>
                <div style="font-size: 0.7rem; font-weight: 700; text-transform: uppercase;">Gizi & PMT</div>
            </div>
        </div>
    </div>
</div>
@endsection
