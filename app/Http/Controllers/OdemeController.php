<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OdemeController extends Controller
{
    // Ödeme sayfasını göster
    public function index()
    {
        $sepet = session()->get('sepet', []);
        $toplam = 0;

        foreach ($sepet as $item) {
            $toplam += $item['fiyat'] * $item['adet'];
        }

        return view('user.odeme', compact('sepet', 'toplam'));
    }

    public function odemeYap(Request $request)
{
    $sepet = session()->get('sepet', []);
    $toplam = 0;
    foreach ($sepet as $item) {
        $toplam += $item['fiyat'] * $item['adet'];
    }

    if (empty($sepet)) {
        return redirect()->route('sepet.goster')->with('error', 'Sepetiniz boş.');
    }

    $yontem = $request->odeme_yontemi;
    $kullanici = Auth::user();

    // Bakiye ile ödeme
    if ($yontem === 'bakiye') {
        if ($kullanici->bakiye < $toplam) {
            return back()->with('error', 'Bakiyeniz yetersiz.');
        }

        $kullanici->bakiye -= $toplam;
        $kullanici->save();
    }

    // Kart ile ödeme → simülasyon
    elseif ($yontem === 'kart') {
        if (empty($request->kart_no) || empty($request->ad_soyad) || empty($request->son_kullanma) || empty($request->cvv)) {
            return back()->with('error', 'Kart bilgilerini eksiksiz doldurun.');
        }
    }

    // Siparişi oluştur
    Order::create([
        'user_id' => $kullanici->id,
        'urunler' => json_encode($sepet),
        'toplam_tutar' => $toplam,
        'durum' => 'bekliyor',
        'odeme_yontemi' => $yontem
    ]);

    session()->forget('sepet');

return redirect()->route('user.siparisler')->with('success', 'Siparişiniz alındı.');
}
}
