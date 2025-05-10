<!DOCTYPE html>
<html>
<head>
    <title>Konser Listesi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h2>🎫 Konser Listesi</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('konser.create') }}" class="btn btn-primary mb-3">+ Yeni Konser Ekle</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Başlık</th>
                <th>Tarih</th>
                <th>Saat</th>
                <th>Stok</th>
                <th>Fiyat</th>
                <th>Durum</th>
                <th>Görsel</th>
                <th>İşlem</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($konserler as $konser)
                <tr>
                    <td>{{ $konser->id }}</td>
                    <td>{{ $konser->baslik }}</td>
                    <td>{{ $konser->tarih }}</td>
                    <td>{{ $konser->saat }}</td>
                    <td>{{ $konser->stok }}</td>
                    <td>{{ number_format($konser->fiyat, 2) }} ₺</td>
                    <td>{{ $konser->aktif ? 'Satışta' : 'Pasif' }}</td>
                    <td>
                        @if($konser->gorsel)
                            <img src="{{ asset('uploads/' . $konser->gorsel) }}" width="60">
                        @else
                            Yok
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('konser.edit', $konser->id) }}" class="btn btn-sm btn-warning">Düzenle</a>
                        <form action="{{ route('konser.destroy', $konser->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Silmek istediğine emin misin?')" class="btn btn-sm btn-danger">Sil</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
