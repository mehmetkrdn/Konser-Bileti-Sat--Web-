@extends('layouts.app')

@section('title', 'Profilim')

@section('content')
    <h2 class="mb-4 text-center">👤 Profilim</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('profil.guncelle') }}">
        @csrf

        <div class="mb-3">
            <label>Ad Soyad</label>
            <input type="text" name="name" value="{{ old('name', $kullanici->name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>E-posta</label>
            <input type="email" name="email" value="{{ old('email', $kullanici->email) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Yeni Şifre (değiştirmek isterseniz)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Yeni Şifre (Tekrar)</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <div class="mb-3">
            <label>Mevcut Bakiyeniz:</label>
            <input type="text" value="{{ number_format($kullanici->bakiye, 2) }} ₺" class="form-control" disabled>
        </div>

        <button class="btn btn-primary w-100">Güncelle</button>
    </form>
    <form method="POST" action="{{ route('profil.pasif') }}" onsubmit="return confirm('Hesabınızı pasif yapmak istediğinize emin misiniz?')">
    @csrf
    <button type="submit" class="btn btn-outline-danger w-100 mt-3">Üyeliğimi Pasif Yap</button>
</form>
@endsection
