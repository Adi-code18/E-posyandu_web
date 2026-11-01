@extends('errors.layout')

@section('title', 'Pemeliharaan Sistem Berkala')

@section('badge')
    <span class="status-badge badge-4xx">
        <i class="fa-solid fa-wrench"></i> HTTP 503 • SERVICE UNAVAILABLE
    </span>
@endsection

@section('code-class', 'code-4xx')
@section('code', '503')

@section('icon')
    <i class="fa-solid fa-screwdriver-wrench" style="color: #4a7c59;"></i>
@endsection

@section('message')
    Aplikasi e-Posyandu sedang menjalani pemeliharaan berkala (*System Maintenance*) untuk peningkatan performa, pembaruan database gizi, dan optimasi keamanan data warga.
@endsection

@section('detail')
    Proses pemeliharaan biasanya hanya memakan waktu beberapa menit. Layanan pencatatan penimbangan balita dan rekam medis posyandu akan segera dapat diakses kembali.
@endsection

@section('actions')
    <button onclick="window.location.reload();" class="btn btn-primary">
        <i class="fa-solid fa-arrows-rotate"></i> Cek Status Layanan
    </button>
    <a href="https://wa.me/" target="_blank" class="btn btn-secondary">
        <i class="fa-brands fa-whatsapp"></i> Hubungi Dukungan Kader
    </a>
@endsection

