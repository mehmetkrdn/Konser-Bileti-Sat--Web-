<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Biletiniz</title> <
</head>
<body>
    <h2>Sayın {{ $siparis->user->name }},</h2>
    <p>🎉 Aşağıdaki konser için biletiniz hazır:</p>

    <ul>
        @foreach(json_decode($siparis->urunler, true) as $urun)
            <li>{{ $urun['baslik'] }} x {{ $urun['adet'] }}</li>
        @endforeach
    </ul>

    <p>Toplam Tutar: <strong>{{ number_format($siparis->toplam_tutar, 2) }} ₺</strong></p>
    <p>📩 Bu e-posta dijital bilet yerine geçmektedir.</p>
    <p>İyi eğlenceler!</p>
</body>
</html>
