<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bilet PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
    </style>
</head>
<body>
   <h2>🎫 Bilet Bilgisi</h2>
<p><strong>Ad:</strong> {{ $siparis->user->name }}</p>
<p><strong>Tarih:</strong> {{ $siparis->created_at->format('d.m.Y H:i') }}</p>
<p><strong>Tutar:</strong> {{ number_format($siparis->toplam_tutar, 2) }} ₺</p>

<h4>📄 İçerik:</h4>
<ul>
@foreach(json_decode($siparis->urunler, true) as $urun)
    <li>{{ $urun['baslik'] }} x {{ $urun['adet'] }}</li>
@endforeach
</ul>
</body>
</html>
