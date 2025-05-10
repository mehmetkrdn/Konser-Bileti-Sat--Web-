<!DOCTYPE html>
<html>
<head>
    <title>Konser Düzenle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h2>🎵 Konser Düzenle: {{ $konser->baslik }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('konser.update', $konser->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Başlık</label>
            <input type="text" name="baslik" class="form-control" value="{{ $konser->baslik }}">
        </div>

        <div class="mb-3">
            <label>Açıklama</label>
            <textarea name="aciklama" class="form-control">{{ $konser->aciklama }}</textarea>
        </div>

        <div class="mb-3">
            <label>Konum</label>
            <input type="text" name="konum" class="form-control" value="{{ $konser->konum }}">
        </div>

        <div class="mb-3">
            <label>Tarih</label>
            <input type="date" name="tarih" class="form-control" value="{{ $konser->tarih }}">
        </div>

        <div class="mb-3">
            <label>Saat</label>
            <input type="time" name="saat" class="form-control" value="{{ $konser->saat }}">
        </div>

        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" value="{{ $konser->stok }}">
        </div>

        <div class="mb-3">
            <label>Fiyat (₺)</label>
            <input type="text" name="fiyat" class="form-control" value="{{ $konser->fiyat }}">
        </div>

        <div class="mb-3">
            <label>Aktif mi?</label>
            <input type="checkbox" name="aktif" {{ $konser->aktif ? 'checked' : '' }}>
        </div>

        <div class="mb-3">
            <label>Görsel (varsa güncellenir)</label>
            <input type="file" name="gorsel" class="form-control">
            @if($konser->gorsel)
                <p class="mt-2">Mevcut görsel:</p>
                <img src="{{ asset('uploads/' . $konser->gorsel) }}" width="100">
            @endif
        </div>

        <button type="submit" class="btn btn-success">Kaydet</button>
        <a href="{{ route('konser.index') }}" class="btn btn-secondary">Geri Dön</a>
    </form>
</body>
</html>
