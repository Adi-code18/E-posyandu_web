@extends('errors.layout')

@section('title', 'Gangguan Server Internal')

@section('badge')
    <span class="status-badge badge-5xx">
        <i class="fa-solid fa-triangle-exclamation"></i> HTTP 500 • INTERNAL SERVER ERROR
    </span>
@endsection

@section('code-class', 'code-5xx')
@section('code', '500')

@section('icon')
    <i class="fa-solid fa-server" style="color: #e74c3c;"></i>
@endsection

@section('message')
    Terjadi kendala teknis internal pada server aplikasi saat memproses data permintaan Anda. Tim pengembang telah mencatat insiden ini ke dalam berkas log sistem.
@endsection

@section('detail')
    Bila kendala ini berulang saat melakukan input pemeriksaan atau ekspor laporan, silakan laporkan ke tim teknis Puskesmas/Desa dengan menyertakan waktu kejadian.
@endsection

@section('actions')
    <button onclick="window.location.reload();" class="btn btn-primary">
        <i class="fa-solid fa-rotate-right"></i> Coba Segarkan Halaman
    </button>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
        <i class="fa-solid fa-house"></i> Kembali Aman ke Dashboard
    </a>
@endsection

