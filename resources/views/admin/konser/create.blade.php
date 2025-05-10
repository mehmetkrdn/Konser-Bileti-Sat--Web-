<!-- resources/views/admin/konser/create.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Konser Ekle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h2>🎫 Yeni Konser Ekle</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('konser.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Konser Başlığı</label>
            <input type="text" name="baslik" class="form-control">
        </div>

        <div class="mb-3">
            <label>Açıklama</label>
            <textarea name="aciklama" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Konum (Mekan)</label>
            <input type="text" name="konum" class="form-control">
        </div>

        <div class="mb-3">
            <label>Tarih</label>
            <input type="date" name="tarih" class="form-control">
        </div>

        <div class="mb-3">
            <label>Saat</label>
            <input type="time" name="saat" class="form-control">
        </div>

        <div class="mb-3">
            <label>Stok (Bilet adedi)</label>
            <input type="number" name="stok" class="form-control">
        </div>

        <div class="mb-3">
            <label>Fiyat (₺)</label>
            <input type="text" name="fiyat" class="form-control">
        </div>

        <div class="mb-3">
            <label>Görsel Yükle (Opsiyonel)</label>
            <input type="file" name="gorsel" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Konseri Ekle</button>
    </form>
</body>
</html>
