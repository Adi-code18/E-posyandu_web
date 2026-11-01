@extends('errors.layout')

@section('title', 'Akses Dibatasi')

@section('badge')
    <span class="status-badge badge-4xx">
        <i class="fa-solid fa-ban"></i> HTTP 403 • FORBIDDEN
    </span>
@endsection

@section('code-class', 'code-4xx')
@section('code', '403')

@section('icon')
    <i class="fa-solid fa-user-lock" style="color: #c0392b;"></i>
@endsection

@section('message')
    Anda tidak memiliki hak akses khusus untuk membuka halaman atau memodifikasi modul kesehatan ini. Modul ini dibatasi hanya untuk akun berwenang (Ketua Posyandu / Bidan Desa).
@endsection

@section('detail')
    Bila Anda merupakan kader posyandu yang ditugaskan mengelola berkas ini, silakan hubungi Administrator Sistem atau login ulang menggunakan akun yang memiliki izin otorisasi.
@endsection

@section('actions')
    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
        <i class="fa-solid fa-house"></i> Kembali ke Dashboard
    </a>
    <a href="{{ route('login') }}" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-right-to-bracket"></i> Ganti Akun Login
    </a>
@endsection

