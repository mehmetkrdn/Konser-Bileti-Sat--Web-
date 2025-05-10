@extends('layouts.app')

@section('title', 'Ana Sayfa')

@section('content')

<!-- 🔍 ARAMA -->
<form method="GET" action="{{ route('dashboard') }}" class="mb-4 text-end">
    <div class="input-group input-group-sm" style="max-width: 300px; margin-left: auto;">
        <input type="text" name="q" value="{{ $arama }}" class="form-control" placeholder="Konser ara...">
        <button class="btn btn-outline-secondary" type="submit">Ara</button>
    </div>
</form>

<!-- 🎞️ SLIDER -->
@if($konserler->count())
<div id="konserCarousel" class="carousel slide carousel-fade mb-5 shadow-sm rounded overflow-hidden" data-bs-ride="carousel" data-bs-interval="5000" style="max-height: 500px;">
    <div class="carousel-inner">
        @foreach($konserler->take(5) as $index => $konser)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <a href="{{ route('konser.detay', $konser->slug) }}">
                    <div style="height: 500px; width: 100%;">
                        <img src="{{ asset('uploads/' . $konser->gorsel) }}"
                             class="d-block w-100"
                             style="height: 100%; width: 100%; object-fit: cover;">
                    </div>
                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-2">
                        <h4>{{ $konser->baslik }}</h4>
                        <p>{{ $konser->tarih }} | {{ $konser->konum }}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#konserCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#konserCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>
@endif

<!-- 🧱 POPÜLER KONSERLER -->
<h5 class="mb-3 fw-bold text-primary">🎵 Popüler Konserler</h5>
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
    @forelse ($konserler->take(6) as $konser)
        <div class="col">
            <div class="card h-100 border-0 shadow-sm">
                <img src="{{ asset('uploads/' . $konser->gorsel) }}" class="card-img-top" style="height: 180px; object-fit: cover;">
                <div class="card-body">
                    <h6 class="card-title">{{ $konser->baslik }}</h6>
                    <ul class="list-unstyled small text-muted">
                        <li><strong>Tarih:</strong> {{ $konser->tarih }}</li>
                        <li><strong>Saat:</strong> {{ $konser->saat }}</li>
                        <li><strong>Yer:</strong> {{ $konser->konum }}</li>
                        <li><strong>Fiyat:</strong> {{ number_format($konser->fiyat, 2) }} ₺</li>
                    </ul>
                    <a href="{{ route('konser.detay', $konser->slug) }}" class="btn btn-outline-primary btn-sm w-100">Detaya Git</a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <p class="alert alert-warning text-center">Konser bulunamadı.</p>
        </div>
    @endforelse
</div>

<!-- 🔗 HEPSİNİ GÖR -->
<div class="text-center mt-4">
    <a href="{{ route('user.konserler') }}" class="btn btn-secondary px-4 py-2">Tümünü Gör</a>
</div>

@endsection
