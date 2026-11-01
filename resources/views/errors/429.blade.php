@extends('errors.layout')

@section('title', 'Batas Akses Terlampaui')

@section('badge')
    <span class="status-badge badge-4xx">
        <i class="fa-solid fa-gauge-high"></i> HTTP 429 • TOO MANY REQUESTS
    </span>
@endsection

@section('code-class', 'code-4xx')
@section('code', '429')

@section('icon')
    <i class="fa-solid fa-hand" style="color: #e67e22;"></i>
@endsection

@section('message')
    Sistem mendeteksi terlalu banyak pengiriman permintaan dari perangkat Anda dalam rentang waktu yang sangat singkat. Akses sementara dibatasi demi stabilitas server.
@endsection

@section('detail')
    Fitur pembatasan laju (*Rate Limiting*) aktif untuk menjaga server e-Posyandu dari beban berlebih. Silakan tunggu sekitar 1 hingga 2 menit sebelum mencoba kembali.
@endsection

@section('actions')
    <button onclick="window.location.reload();" class="btn btn-primary">
        <i class="fa-solid fa-rotate-right"></i> Coba Kembali Sekarang
    </button>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
        <i class="fa-solid fa-house"></i> Beranda e-Posyandu
    </a>
@endsection

