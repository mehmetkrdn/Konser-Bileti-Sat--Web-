@extends('layouts.app')

@section('title', 'Admin Paneli')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">🎛️ Admin Paneline Hoş Geldiniz</h2>

    <div class="row g-3">
        <div class="col-md-3">
            <a href="{{ route('konser.index') }}" class="btn btn-primary w-100 py-3">
                🎤 Konserleri Yönet
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('admin.siparisler') }}" class="btn btn-success w-100 py-3">
                📦 Siparişleri Yönet
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('admin.kullanicilar') }}" class="btn btn-warning w-100 py-3">
                👥 Kullanıcıları Yönet
            </a>
        </div>
</div>
@endsection
