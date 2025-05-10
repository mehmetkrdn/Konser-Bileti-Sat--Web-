@extends('layouts.app')

@php use Illuminate\Support\Str; @endphp

@section('title', 'Siparişlerim')

@section('content')
    <h2 class="mb-4 text-center">📄 Siparişlerim</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if($siparisler->isEmpty())
        <div class="alert alert-info text-center">Henüz hiç siparişiniz bulunmamaktadır.</div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Biletler</th>
                    <th>Toplam</th>
                    <th>Durum</th>
                    <th>Tarih</th>
                </tr>
            </thead>
            <tbody>
                @foreach($siparisler as $siparis)
                    <tr>
                        <td>{{ $siparis->id }}</td>
                        <td>
                            <ul class="mb-0">
                                @foreach(json_decode($siparis->urunler, true) as $urun)
                                    <li>{{ $urun['baslik'] }} x {{ $urun['adet'] }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ number_format($siparis->toplam_tutar, 2) }} ₺</td>
                        <td>
                            @php
                                $badgeColors = [
                                    'bekliyor'        => 'primary',
                                    'mail gönderildi' => 'success',
                                    'iptal edildi'    => 'danger',
                                    'reddedildi'      => 'danger',
                                ];
                                $renk = $badgeColors[$siparis->durum] ?? 'secondary';
                            @endphp

                            <span class="badge bg-{{ $renk }}">{{ Str::title($siparis->durum) }}</span>

                            @if($siparis->durum === 'mail gönderildi')
                                <form action="{{ route('user.siparis.teslimal', $siparis->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    <button class="btn btn-sm btn-success">🎟️ Biletimi Teslim Aldım</button>
                                </form>
                            @endif

                            @if($siparis->durum === 'bekliyor')
                                <form action="{{ route('user.siparis.iptal', $siparis->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Siparişi iptal etmek istediğinizden emin misiniz?')" class="btn btn-sm btn-outline-danger">İptal Et</button>
                                </form>
                            @endif
                        </td>
                        <td>{{ $siparis->created_at->format('d.m.Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
