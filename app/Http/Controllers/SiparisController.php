<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class SiparisController extends Controller
{
    public function index()
    {
        $siparisler = Order::where('user_id', Auth::id())->latest()->get();
        return view('user.siparislerim', compact('siparisler'));
    }
    public function teslimAl($id)
{
    $siparis = Order::where('id', $id)
        ->where('user_id', auth()->id())
        ->where('durum', 'mail gönderildi')
        ->firstOrFail();

    $siparis->durum = 'tamamlandı';
    $siparis->save();

    return redirect()->back()->with('success', 'Bilet teslim edildi.');
}
public function iptalEt($id)
{
    $siparis = Order::where('id', $id)
        ->where('user_id', auth()->id())
        ->where('durum', 'bekliyor')
        ->firstOrFail();

    // 💰 Ücreti iade et
    $kullanici = auth()->user();
    $kullanici->bakiye += $siparis->toplam_tutar;
    $kullanici->save();

    // ❌ Siparişi silmek yerine durumunu güncelle
    $siparis->durum = 'iptal edildi';
    $siparis->save();

    return redirect()->back()->with('success', 'Sipariş iptal edildi. Tutar bakiyenize iade edildi.');
}
}
