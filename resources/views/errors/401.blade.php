@extends('errors.layout')

@section('title', 'Sesi Belum Terotentikasi')

@section('badge')
    <span class="status-badge badge-4xx">
        <i class="fa-solid fa-key"></i> HTTP 401 • UNAUTHORIZED
    </span>
@endsection

@section('code-class', 'code-4xx')
@section('code', '401')

@section('icon')
    <i class="fa-solid fa-shield-halved" style="color: #e67e22;"></i>
@endsection

@section('message')
    Akses ditolak karena sesi Anda belum terautentikasi atau telah kedaluwarsa. Silakan masukkan kredensial akun Posyandu Anda untuk melanjutkan aktivitas.
@endsection

@section('detail')
    Demi keamanan data medis dan privasi warga, sistem mewajibkan otentikasi aktif sebelum mengakses data penimbangan, kartu KMS, maupun data posyandu lainnya.
@endsection

@section('actions')
    <a href="{{ route('login') }}" class="btn btn-primary">
        <i class="fa-solid fa-arrow-right-to-bracket"></i> Masuk Sekarang
    </a>
    <a href="javascript:history.back()" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Sebelumnya
    </a>
@endsection

