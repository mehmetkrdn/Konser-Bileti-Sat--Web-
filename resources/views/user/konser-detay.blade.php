@extends('layouts.app')

@section('title', $konser->baslik)

@section('content')
    <div class="container py-4">
        <h2>{{ $konser->baslik }}</h2>
        <p class="text-muted">{{ $konser->konum }} | {{ $konser->tarih }} - {{ $konser->saat }}</p>

        @if($konser->gorsel)
            <img src="{{ asset('uploads/' . $konser->gorsel) }}" class="img-fluid mb-3">
        @endif

        <p>{{ $konser->aciklama }}</p>

        <h4>Fiyat: {{ number_format($konser->fiyat, 2) }} ₺</h4>
        <p>Stok: {{ $konser->stok }} adet</p>

        <form action="{{ route('sepet.ekle', $konser->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Sepete Ekle</button>
        </form>
    </div>
@endsection
