@extends('layouts.admin')

@section('title', 'Manajemen Produk')
@section('breadcrumbs', 'MANAGEMENT > INVENTORY')
@section('page_title', 'Manajemen Produk')

@section('content')
<p class="text-muted mb-4">Pantau dan kelola stok produk kesehatan, suplemen, dan obat-obatan esensial untuk kebutuhan operasional Posyandu.</p>

<div style="display: flex; justify-content: flex-end; margin-bottom: 2rem;">
    <button class="btn" onclick="openModal()" style="background: #4a7c59; color: #fff; border-radius: 10px;">
        <i class="fa-solid fa-plus" style="margin-right: 8px;"></i> Tambah Produk Baru
    </button>
</div>

<!-- Modal Tambah Produk -->
<div id="productModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 2000; align-items: center; justify-content: center;">
    <div class="card" style="width: 100%; max-width: 500px; animation: slideUp 0.3s ease;">
        <div class="card-title" style="display: flex; justify-content: space-between;">
            <span>Tambah Produk Baru</span>
            <i class="fa-solid fa-xmark" onclick="closeModal()" style="cursor: pointer;"></i>
        </div>
        <form action="{{ route('admin.produk.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Nama Produk</label>
                <input type="text" name="nama_barang" class="form-control" required placeholder="Contoh: Biskuit Balita">
            </div>
            <div class="form-group">
                <label class="form-label">Kategori</label>
                <select name="kategori" class="form-control" required>
                    <option value="Suplemen Gizi">Suplemen Gizi</option>
                    <option value="Vitamin">Vitamin</option>
                    <option value="Obat-obatan">Obat-obatan</option>
                </select>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="form-group">
                    <label class="form-label">Jumlah Stok</label>
                    <input type="number" name="jumlah" class="form-control" required placeholder="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Harga Satuan (Rp)</label>
                    <input type="number" name="harga" class="form-control" required placeholder="0">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Tanggal Masuk</label>
                <input type="date" name="tanggal_masuk" class="form-control" required value="{{ date('Y-m-d') }}">
            </div>
            <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 1rem;">
                <button type="button" class="btn" onclick="closeModal()" style="background: #eee;">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Produk</button>
            </div>
        </form>
    </div>
</div>

<!-- Inventory Stats -->
<div class="stats-grid" style="grid-template-columns: repeat(4, 1fr); margin-bottom: 2.5rem;">
    <div class="card" style="padding: 1.5rem; border: none; border-left: 4px solid #eee;">
        <div style="font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 10px;">Total Produk</div>
        <div style="display: flex; align-items: baseline; gap: 10px;">
            <span style="font-size: 2rem; font-weight: 700;">{{ $stats['total'] }}</span>
            <span style="font-size: 0.75rem; color: #27ae60; background: #f0f4f1; padding: 2px 8px; border-radius: 10px;">+{{ $stats['total'] }} total</span>
        </div>
    </div>
    <div class="card" style="padding: 1.5rem; border: none; border-left: 4px solid #e74c3c;">
        <div style="font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 10px; color: #e74c3c;">Stok Habis</div>
        <div style="display: flex; align-items: baseline; gap: 10px;">
            <span style="font-size: 2rem; font-weight: 700;">{{ $stats['habis'] }}</span>
            <span style="font-size: 0.75rem; color: #e74c3c; background: #fdf2f2; padding: 2px 8px; border-radius: 10px;">Perlu Re-stock</span>
        </div>
    </div>
    <div class="card" style="padding: 1.5rem; border: none; border-left: 4px solid #eee;">
        <div style="font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 10px;">Kategori</div>
        <div style="display: flex; align-items: baseline; gap: 10px;">
            <span style="font-size: 2rem; font-weight: 700;">{{ $stats['kategori'] }}</span>
            <span style="font-size: 0.75rem; color: #888;">Aktif</span>
        </div>
    </div>
    <div class="card" style="padding: 1.5rem; border: none; border-left: 4px solid #eee;">
        <div style="font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 10px;">Update Terakhir</div>
        <div style="font-size: 1.4rem; font-weight: 700;">Hari ini</div>
        <div style="font-size: 0.75rem; color: #aaa;">{{ date('H:i') }} WIB</div>
    </div>
</div>


<!-- Product Table -->
<div class="card" style="overflow-x: auto;">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <div style="display: flex; gap: 10px; background: #eee; padding: 4px; border-radius: 10px;">
            <button class="btn" style="padding: 5px 15px; font-size: 0.8rem; background: var(--primary); color: #fff;">Semua</button>
            <button class="btn" style="padding: 5px 15px; font-size: 0.8rem; background: transparent;">Tersedia</button>
            <button class="btn" style="padding: 5px 15px; font-size: 0.8rem; background: transparent;">Habis</button>
        </div>
        <div style="display: flex; gap: 15px; align-items: center;">
            <button class="btn" style="background: transparent; font-size: 0.85rem; color: #666;"><i class="fa-solid fa-sliders"></i> Filter</button>
            <i class="fa-solid fa-ellipsis" style="color: #ccc; cursor: pointer;"></i>
        </div>
    </div>

    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="text-align: left; color: var(--text-muted); font-size: 0.7rem; text-transform: uppercase; border-bottom: 1px solid #eee;">
                <th style="padding: 15px 10px;">Nama Produk</th>
                <th style="padding: 15px 10px;">Kategori</th>
                <th style="padding: 15px 10px; text-align: center;">Stok</th>
                <th style="padding: 15px 10px;">Satuan</th>
                <th style="padding: 15px 10px;">Status</th>
                <th style="padding: 15px 10px; text-align: right;">Tanggal Masuk</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $prod)
            <tr style="border-bottom: 1px solid #fafafa; font-size: 0.9rem;">
                <td style="padding: 20px 10px;">
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <div style="width: 40px; height: 40px; background: #fdf8f3; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #d4a373;">
                            <i class="fa-solid fa-box-open"></i>
                        </div>
                        <div style="font-weight: 700;">{{ $prod->nama_barang }}</div>
                    </div>
                </td>
                <td style="padding: 20px 10px; color: #666;">{{ $prod->kategori }}</td>
                <td style="padding: 20px 10px; text-align: center; font-weight: 700; color: {{ $prod->jumlah == 0 ? '#e74c3c' : 'inherit' }};">{{ $prod->jumlah }}</td>
                <td style="padding: 20px 10px; color: #666;">{{ $prod->satuan ?? 'Unit' }}</td>
                <td style="padding: 20px 10px;">
                    @php
                        $status = 'TERSEDIA';
                        $color = '#27ae60';
                        if($prod->jumlah == 0) {
                            $status = 'HABIS';
                            $color = '#e74c3c';
                        } elseif($prod->jumlah < 10) {
                            $status = 'STOK RENDAH';
                            $color = '#d35400';
                        }
                    @endphp
                    <span style="font-size: 0.65rem; font-weight: 800; background: {{ $color }}15; color: {{ $color }}; padding: 4px 10px; border-radius: 20px; display: flex; align-items: center; gap: 5px; width: fit-content;">
                        <i class="fa-solid fa-circle" style="font-size: 0.4rem;"></i> {{ $status }}
                    </span>
                </td>
                <td style="padding: 20px 10px; text-align: right; color: #aaa; font-size: 0.8rem;">{{ \Carbon\Carbon::parse($prod->tanggal_masuk)->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>

    </table>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 2rem;">
        <span style="font-size: 0.8rem; color: var(--text-muted);">Menampilkan 1-4 dari 42 produk</span>
        <div style="display: flex; gap: 5px;">
            <button class="icon-btn" style="width: 25px; height: 25px;"><i class="fa-solid fa-chevron-left" style="font-size: 0.6rem;"></i></button>
            <button class="icon-btn" style="width: 25px; height: 25px; background: var(--primary); color: #fff;">1</button>
            <button class="icon-btn" style="width: 25px; height: 25px;">2</button>
            <button class="icon-btn" style="width: 25px; height: 25px;">3</button>
            <button class="icon-btn" style="width: 25px; height: 25px;"><i class="fa-solid fa-chevron-right" style="font-size: 0.6rem;"></i></button>
        </div>
    </div>
</div>

<!-- Bottom CTA Section -->
<div class="content-grid mt-4">
    <div class="card" style="background: #84a59d; color: white; border: none; padding: 2.5rem;">
        <h3 class="serif mb-3">Butuh Bantuan Stok?</h3>
        <p style="font-size: 0.9rem; opacity: 0.9; margin-bottom: 2rem; line-height: 1.6;">
            Sistem Terra Posyandu secara otomatis mengingatkan Anda ketika produk mencapai ambang batas minimum. Segera hubungi pusat distribusi jika stok Vitamin A atau TTD mendekati nol.
        </p>
        <button class="btn" style="background: #ffffff30; color: white; border: 1px solid #ffffff50;">Hubungi Distribusi</button>
    </div>

    <div class="card" style="border: 2px dashed #ddd; background: transparent; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
        <div class="icon-btn" style="background: #f5f5f5; width: 50px; height: 50px; margin-bottom: 1rem;"><i class="fa-solid fa-chart-pie"></i></div>
        <h4 class="serif">Analisis Penggunaan</h4>
        <p style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 1.5rem;">Ingin melihat tren penggunaan biskuit PMT dalam 6 bulan terakhir? Lihat laporan detail produk.</p>
        <a href="#" class="text-primary" style="font-weight: 600; font-size: 0.85rem;">Buka Laporan <i class="fa-solid fa-arrow-right"></i></a>
    </div>
</div>
@endsection

@section('scripts')

<script>
    function openModal() {
        document.getElementById('productModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('productModal').style.display = 'none';
    }

    // Close on outside click
    window.onclick = function(event) {
        const modal = document.getElementById('productModal');
        if (event.target == modal) {
            closeModal();
        }
    }
</script>
@endsection

