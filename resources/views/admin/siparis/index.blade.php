<!DOCTYPE html>
<html>
<head>
    <title>Siparişler</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">

    <h2 class="mb-4 text-center">📦 Tüm Bilet Siparişleri</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($siparisler->isEmpty())
        <div class="alert alert-warning text-center">Henüz sipariş yok.</div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kullanıcı</th>
                    <th>Ürünler</th>
                    <th>Toplam</th>
                    <th>Durum</th>
                    <th>Tarih</th>
                    <th>İşlem</th>
                </tr>
            </thead>
            <tbody>
                @foreach($siparisler as $siparis)
                    <tr>
                        <td>{{ $siparis->id }}</td>
                        <td>{{ $siparis->user->name ?? 'Silinmiş Kullanıcı' }}</td>
                        <td>
                            <ul class="mb-0">
                                @foreach(json_decode($siparis->urunler, true) as $urun)
                                    <li>{{ $urun['baslik'] }} x {{ $urun['adet'] }} → {{ number_format($urun['fiyat'], 2) }} ₺</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ number_format($siparis->toplam_tutar, 2) }} ₺</td>
                        <td>
                            <span class="badge bg-{{ $siparis->durum === 'reddedildi' ? 'danger' : ($siparis->durum === 'mail gönderildi' ? 'success' : 'secondary') }}">
                                {{ ucfirst($siparis->durum) }}
                            </span>
                        </td>
                        <td>{{ $siparis->created_at->format('d.m.Y H:i') }}</td>
                        <td>
                            <form action="{{ route('admin.siparis.guncelle', $siparis->id) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="durum" value="mail gönderildi">
                                <button class="btn btn-success btn-sm">Onayla</button>
                            </form>

                            <form action="{{ route('admin.siparis.guncelle', $siparis->id) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="durum" value="reddedildi">
                                <button class="btn btn-danger btn-sm">Reddet</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</body>
</html>
