@extends('layouts.admin')

@section('title', 'Daftar Anggota')
@section('breadcrumbs', 'Beranda > Daftar Anggota')
@section('page_title', 'Pencarian & Pemilihan Warga')

@section('content')
<p class="text-muted mb-4">Cari dan pilih warga yang akan melakukan pemeriksaan hari ini.</p>

<!-- Filters -->
<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; margin-bottom: 2.5rem;">
    <form action="{{ route('admin.daftar-anggota') }}" method="GET" class="card" style="padding: 1rem 1.5rem; display: flex; align-items: center; gap: 15px;">
        <i class="fa-solid fa-magnifying-glass text-muted"></i>
        <input type="text" name="search" value="{{ request('search') }}" class="form-control" style="border: none; background: transparent; padding: 0;" placeholder="Masukkan 16 digit NIK atau Nama Lengkap...">
        <button type="submit" style="display: none;"></button>
    </form>
    <div style="display: flex; gap: 10px; align-items: center;">
        <span style="font-size: 0.85rem; font-weight: 600;">Filter Cepat:</span>
        <div style="display: flex; gap: 5px; flex-wrap: wrap;">
            @foreach(['Semua', 'Balita', 'Ibu Hamil', 'Remaja', 'Lansia'] as $filter)
            <a href="{{ route('admin.daftar-anggota', ['status' => $filter]) }}" class="btn" style="padding: 5px 12px; font-size: 0.75rem; border: 1px solid #ddd; background: {{ request('status', 'Semua') == $filter ? 'var(--primary)' : '#fff' }}; color: {{ request('status', 'Semua') == $filter ? '#fff' : 'inherit' }}; text-decoration: none;">
                {{ $filter }}
            </a>
            @endforeach
        </div>
    </div>
</div>

<!-- Member Cards -->
<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 24px;">
    @foreach($warga as $item)
    <div class="card" style="padding: 1.5rem; position: relative;">
        <span style="position: absolute; top: 1rem; right: 1rem; font-size: 0.7rem; background: #eee; padding: 3px 8px; border-radius: 20px;">{{ $item->status }}</span>
        <div style="display: flex; gap: 15px; margin-bottom: 1.5rem;">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($item->nama_lengkap) }}&background=random" style="width: 60px; height: 60px; border-radius: 12px; object-fit: cover;">
            <div>
                <h4 class="serif" style="margin-bottom: 4px;">{{ $item->nama_lengkap }}</h4>
                <div style="font-size: 0.75rem; color: var(--text-muted); letter-spacing: 1px;">{{ $item->NIK }}</div>
            </div>
        </div>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 1.5rem;">
            <div style="background: #fdf8f3; padding: 10px; border-radius: 10px;">
                <div style="font-size: 0.65rem; color: var(--text-muted); text-transform: uppercase;">Usia</div>
                <div style="font-weight: 700; font-size: 0.9rem;">{{ \Carbon\Carbon::parse($item->tanggal_lahir)->age }} Thn</div>
            </div>
            <div style="background: #fdf8f3; padding: 10px; border-radius: 10px;">
                <div style="font-size: 0.65rem; color: var(--text-muted); text-transform: uppercase;">RT/RW</div>
                <div style="font-weight: 700; font-size: 0.9rem;">01 / 04</div>
            </div>
        </div>
        <a href="{{ route('admin.profil', ['nik' => $item->NIK]) }}" class="btn btn-primary" style="width: 100%; justify-content: center;">
            <i class="fa-solid fa-user-check"></i>
            Pilih Warga
        </a>
    </div>
    @endforeach

    @if($warga->isEmpty())
    <!-- Add New Empty State -->
    <div class="card" style="grid-column: 1 / -1; border: 2px dashed #ddd; background: transparent; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; padding: 4rem;">
        <div class="icon-btn" style="width: 50px; height: 50px; margin-bottom: 1rem; background: #eee;">
            <i class="fa-solid fa-plus"></i>
        </div>
        <h4 class="serif">Warga Tidak Ditemukan</h4>
        <p style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 1.5rem;">Coba gunakan kata kunci lain atau daftarkan warga baru.</p>
        <a href="{{ route('admin.pendaftaran') }}" class="btn" style="border: 1px solid var(--primary); color: var(--primary); text-decoration: none;">Daftar Warga Baru</a>
    </div>
    @endif
</div>

<!-- Pagination -->
<div style="margin-top: 3rem;">
    {{ $warga->appends(request()->query())->links() }}
</div>

@endsection
