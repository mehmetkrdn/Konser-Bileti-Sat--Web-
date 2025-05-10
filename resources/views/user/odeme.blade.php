@extends('layouts.app')

@section('title', 'Ödeme')

@section('content')
<h2 class="text-center mb-4">💳 Ödeme</h2>

@if(session('error'))
    <div class="alert alert-danger text-center">{{ session('error') }}</div>
@endif

@if(empty($sepet))
    <div class="alert alert-warning text-center">Sepetiniz boş.</div>
@else
    <p><strong>Mevcut Bakiyeniz:</strong> {{ number_format(Auth::user()->bakiye, 2) }} ₺</p>

    <form action="{{ route('odeme.yap') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Ödeme Yöntemi:</label><br>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="odeme_yontemi" id="bakiye" value="bakiye" checked>
                <label class="form-check-label" for="bakiye">🪙 Hesap Bakiyesi ile</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="odeme_yontemi" id="kart" value="kart">
                <label class="form-check-label" for="kart">💳 Kredi Kartı ile</label>
            </div>
        </div>

        <div id="kart-bilgileri" style="display: none;">
            <input type="text" name="kart_no" class="form-control mb-2" placeholder="Kart Numarası">
            <input type="text" name="ad_soyad" class="form-control mb-2" placeholder="Ad Soyad">
            <input type="text" name="son_kullanma" class="form-control mb-2" placeholder="SKT (AA/YY)">
            <input type="text" name="cvv" class="form-control mb-2" placeholder="CVV">
        </div>

        <hr>
        <h5>Genel Toplam: {{ number_format($toplam, 2) }} ₺</h5>

        <button type="submit" class="btn btn-success w-100 mt-3">Ödemeyi Tamamla</button>
    </form>
@endif

<script>
    document.getElementById('kart').addEventListener('change', () => {
        document.getElementById('kart-bilgileri').style.display = 'block';
    });
    document.getElementById('bakiye').addEventListener('change', () => {
        document.getElementById('kart-bilgileri').style.display = 'none';
    });
</script>
@endsection
