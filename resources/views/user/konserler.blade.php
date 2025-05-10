@extends('layouts.app')

@section('title', 'Satıştaki Konserler')

@section('content')
    <h2 class="mb-4 text-center">🎵 Satıştaki Konserler</h2>

    <div class="row">
        @forelse ($konserler as $konser)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow">
                    @if($konser->gorsel)
                        <img src="{{ asset('uploads/' . $konser->gorsel) }}" class="card-img-top" alt="Konser Görseli">
                    @else
                        <img src="https://via.placeholder.com/400x200?text=Görsel+Yok" class="card-img-top">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $konser->baslik }}</h5>
                        <p class="card-text">{{ Str::limit($konser->aciklama, 100) }}</p>
                        <ul class="list-unstyled small">
                            <li><strong>Tarih:</strong> {{ $konser->tarih }}</li>
                            <li><strong>Saat:</strong> {{ $konser->saat }}</li>
                            <li><strong>Yer:</strong> {{ $konser->konum }}</li>
                            <li><strong>Fiyat:</strong> {{ number_format($konser->fiyat, 2) }} ₺</li>
                        </ul>
                        <a href="{{ route('konser.detay', $konser->slug) }}" class="btn btn-primary w-100">Detaya Git</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="alert alert-warning text-center">Şu anda satışta konser bulunmamaktadır.</p>
            </div>
        @endforelse
    </div>
@endsection
