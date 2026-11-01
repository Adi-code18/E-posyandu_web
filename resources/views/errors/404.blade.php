@extends('errors.layout')

@section('title', 'Halaman Tidak Ditemukan')

@section('badge')
    <span class="status-badge badge-4xx">
        <i class="fa-solid fa-compass"></i> HTTP 404 • NOT FOUND
    </span>
@endsection

@section('code-class', 'code-4xx')
@section('code', '404')

@section('icon')
    <i class="fa-solid fa-file-circle-question" style="color: #e67e22;"></i>
@endsection

@section('message')
    Maaf, halaman atau catatan kesehatan warga yang Anda cari tidak dapat ditemukan di arsip server e-Posyandu. Kemungkinan tautan telah berpindah atau salah pengetikan.
@endsection

@section('detail')
    Periksa kembali NIK warga atau URL yang Anda tuju. Anda juga dapat menggunakan fitur pencarian di modul <em>Daftar Anggota</em> untuk menemukan data yang tepat.
@endsection

@section('actions')
    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
        <i class="fa-solid fa-house"></i> Kembali ke Dashboard
    </a>
    <a href="{{ route('admin.daftar-anggota') }}" class="btn btn-secondary">
        <i class="fa-solid fa-users"></i> Cari Warga
    </a>
@endsection

