@extends('errors.layout')

@section('title', 'Sesi Formulir Kedaluwarsa')

@section('badge')
    <span class="status-badge badge-4xx">
        <i class="fa-solid fa-hourglass-end"></i> HTTP 419 • PAGE EXPIRED
    </span>
@endsection

@section('code-class', 'code-4xx')
@section('code', '419')

@section('icon')
    <i class="fa-solid fa-clock-rotate-left" style="color: #d35400;"></i>
@endsection

@section('message')
    Sesi pengisian formulir pendaftaran atau pemeriksaan Anda telah kedaluwarsa karena halaman tidak aktif dalam durasi yang cukup lama (Token CSRF habis).
@endsection

@section('detail')
    Ini adalah proteksi keamanan Laravel untuk mencegah serangan pemalsuan permintaan antar-situs (CSRF). Data Anda tetap aman. Cukup muat ulang halaman formulir dan kirimkan kembali.
@endsection

@section('actions')
    <button onclick="window.location.reload();" class="btn btn-primary">
        <i class="fa-solid fa-arrows-rotate"></i> Muat Ulang Halaman
    </button>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
        <i class="fa-solid fa-house"></i> Ke Beranda Dashboard
    </a>
@endsection

