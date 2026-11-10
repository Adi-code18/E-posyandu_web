@extends('layouts.admin')

@section('title', 'Pemilihan Warga — e-Posyandu')
@section('breadcrumbs', 'Beranda > Pemilihan Warga')
@section('page_title', 'Pemilihan Warga')

@section('content')
<p style="font-size: 0.88rem; color: #6b7280; margin-bottom: 1.5rem; margin-top: -0.25rem;">
    Pilih data warga untuk memulai pencatatan kesehatan hari ini
</p>

<!-- 1. Baris Kontrol Filter & Pencarian Sesuai Figma -->
<div style="display: flex; justify-content: space-between; align-items: center; gap: 16px; margin-bottom: 1.75rem; flex-wrap: wrap;">
    <!-- Filter Pills -->
    <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
        @php
            $currentStatus = request('status', 'Semua');
            $filters = ['Semua', 'Balita', 'Ibu Hamil', 'Remaja', 'Lansia'];
        @endphp
        @foreach($filters as $filter)
            @php
                $isActive = $currentStatus === $filter;
            @endphp
            <a href="{{ route('admin.daftar-anggota', array_merge(request()->except('page'), ['status' => $filter])) }}" 
               class="btn {{ $isActive ? 'btn-primary' : 'btn-secondary' }}" 
               style="border-radius: 9999px; padding: 6px 16px; font-size: 0.825rem; font-weight: 600; {{ $isActive ? 'background: #2d6a4f; color: #ffffff;' : 'background: #ffffff; color: #4b5563; border-color: #e5e7eb;' }}">
                {{ $filter === 'Remaja' ? 'Dewasa & Remaja' : $filter }}
            </a>
        @endforeach
    </div>

    <!-- Search Box Rounded Pill -->
    <form action="{{ route('admin.daftar-anggota') }}" method="GET" style="margin: 0; min-width: 280px; position: relative;">
        @if(request('status'))
            <input type="hidden" name="status" value="{{ request('status') }}">
        @endif
        <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #9ca3af; font-size: 0.85rem;"></i>
        <input type="text" 
               name="search" 
               value="{{ request('search') }}" 
               class="form-control" 
               style="border-radius: 9999px; background: #ffffff; border: 1px solid #e5e7eb; padding: 8px 16px 8px 38px; font-size: 0.85rem;" 
               placeholder="Cari nama atau NIK warga...">
    </form>
</div>

<!-- 2. Grid Kartu Anggota Sesuai Mockup Figma -->
<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(290px, 1fr)); gap: 18px;">
    @forelse($warga as $item)
    <div class="card" style="border-radius: 18px; border: 1px solid #ebe6dd; background: #ffffff; padding: 1.25rem; display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 4px 16px rgba(0,0,0,0.02);">
        <div>
            <!-- Header Kartu: Avatar & Info -->
            <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 10px; margin-bottom: 1rem;">
                <div style="display: flex; align-items: center; gap: 12px; min-width: 0;">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($item->nama_lengkap) }}&background=2d6a4f&color=fff&size=80" 
                         alt="{{ $item->nama_lengkap }}" 
                         style="width: 44px; height: 44px; border-radius: 50%; object-fit: cover; flex-shrink: 0; box-shadow: 0 2px 6px rgba(0,0,0,0.06);">
                    <div style="min-width: 0;">
                        <h4 style="font-family: inherit; font-weight: 700; font-size: 0.95rem; color: #1f2937; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            {{ $item->nama_lengkap }}
                        </h4>
                        <div style="font-size: 0.75rem; color: #9ca3af; font-family: monospace; margin-top: 2px;">
                            {{ $item->NIK }}
                        </div>
                    </div>
                </div>

                <!-- Tag Kategori -->
                @php
                    $tagClass = match($item->status) {
                        'Balita' => 'tag-success',
                        'Ibu Hamil' => 'tag-warning',
                        'Lansia' => 'tag-neutral',
                        default => 'tag-info'
                    };
                @endphp
                <span class="tag {{ $tagClass }}" style="font-size: 0.7rem; padding: 2px 8px; flex-shrink: 0;">
                    {{ $item->status }}
                </span>
            </div>

            <!-- Detail Parameter Cepat -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px; margin-bottom: 1.25rem;">
                <div style="background: #faf8f5; padding: 8px 12px; border-radius: 10px; border: 1px solid #ede8de;">
                    <div style="font-size: 0.65rem; color: #9ca3af; text-transform: uppercase; font-weight: 600;">Usia</div>
                    <div style="font-weight: 700; font-size: 0.88rem; color: #1f2937; margin-top: 2px;">
                        {{ \Carbon\Carbon::parse($item->tanggal_lahir)->age }} Thn
                    </div>
                </div>
                <div style="background: #faf8f5; padding: 8px 12px; border-radius: 10px; border: 1px solid #ede8de;">
                    <div style="font-size: 0.65rem; color: #9ca3af; text-transform: uppercase; font-weight: 600;">Jenis Kelamin</div>
                    <div style="font-weight: 700; font-size: 0.88rem; color: #1f2937; margin-top: 2px;">
                        {{ $item->jenis_kelamin }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi Pill -->
        <a href="{{ route('admin.profil', ['nik' => $item->NIK]) }}" class="btn btn-primary" style="border-radius: 9999px; width: 100%; font-size: 0.85rem; font-weight: 600; padding: 9px 16px; background: #2d6a4f; border: none; box-shadow: none;">
            <i class="fa-solid fa-user-check" style="font-size: 0.8rem; margin-right: 4px;"></i>
            <span>Pilih Warga & Periksa</span>
        </a>
    </div>
    @empty
    <div class="card" style="grid-column: 1 / -1; border: 2px dashed #e5e7eb; background: transparent; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; padding: 4rem 2rem; border-radius: 18px;">
        <div class="icon-btn" style="width: 54px; height: 54px; margin-bottom: 1rem; background: #e8f5e9; color: var(--primary); font-size: 1.3rem;">
            <i class="fa-solid fa-users-slash"></i>
        </div>
        <h4 class="serif" style="margin-bottom: 6px; font-size: 1.15rem;">Data Warga Tidak Ditemukan</h4>
        <p style="font-size: 0.85rem; color: #6b7280; margin-bottom: 1.5rem; max-width: 400px;">
            Tidak ditemukan data warga yang sesuai dengan kata kunci atau filter pencarian saat ini.
        </p>
        <a href="{{ route('admin.pendaftaran') }}" class="btn btn-primary" style="border-radius: 9999px; padding: 8px 20px;">
            <i class="fa-solid fa-user-plus" style="margin-right: 4px;"></i>
            <span>Daftarkan Warga Baru</span>
        </a>
    </div>
    @endforelse
</div>

<!-- 3. Navigasi Paginasi Halaman Sesuai Desain Sistem -->
<div style="margin-top: 2rem; width: 100%;">
    {{ $warga->appends(request()->query())->links() }}
</div>
@endsection
