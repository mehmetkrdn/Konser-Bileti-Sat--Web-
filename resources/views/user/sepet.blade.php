@extends('layouts.app')

@section('title', 'Sepetim')

@section('content')
    <h2 class="mb-4 text-center">🛒 Sepetim</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(empty($sepet))
        <div class="alert alert-warning text-center">Sepetinizde ürün bulunmamaktadır.</div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Görsel</th>
                    <th>Başlık</th>
                    <th>Adet</th>
                    <th>Birim Fiyat</th>
                    <th>Toplam</th>
                    <th>Sil</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sepet as $item)
                    <tr>
                        <td>
                            @if($item['gorsel'])
                                <img src="{{ asset('uploads/' . $item['gorsel']) }}" width="80">
                            @else
                                Yok
                            @endif
                        </td>
                        <td>{{ $item['baslik'] }}</td>
                        <td>
                            <form action="{{ route('sepet.artir', $item['id']) }}" method="POST" style="display:inline;">
                                @csrf
                                <button class="btn btn-sm btn-success">+</button>
                            </form>

                            <span class="mx-2">{{ $item['adet'] }}</span>

                            <form action="{{ route('sepet.azalt', $item['id']) }}" method="POST" style="display:inline;">
                                @csrf
                                <button class="btn btn-sm btn-warning">-</button>
                            </form>
                        </td>
                        <td>{{ number_format($item['fiyat'], 2) }} ₺</td>
                        <td>{{ number_format($item['fiyat'] * $item['adet'], 2) }} ₺</td>
                        <td>
                            <form action="{{ route('sepet.sil', $item['id']) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">❌</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="text-end"><strong>Genel Toplam:</strong></td>
                    <td colspan="2"><strong>{{ number_format($toplam, 2) }} ₺</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="text-end">
            <a href="{{ route('odeme.index') }}" class="btn btn-primary">💳 Ödemeye Geç</a>
        </div>
    @endif
@endsection
