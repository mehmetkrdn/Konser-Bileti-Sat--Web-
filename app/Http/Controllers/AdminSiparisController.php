<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Mail\BiletMaili;
use Illuminate\Support\Facades\Mail;

class AdminSiparisController extends Controller
{
    // Tüm siparişleri listele
    public function index()
    {
        $siparisler = Order::with('user')->latest()->get();
        return view('admin.siparis.index', compact('siparisler'));
    }

    // Sipariş durumunu güncelle
    public function guncelle(Request $request, $id)
{
    $request->validate([
        'durum' => 'required|string'
    ]);

    $siparis = Order::with('user')->findOrFail($id);
    $kullanici = $siparis->user;

    // REDDEDİLDİ → bakiye iadesi yapılır
    if ($request->durum === 'reddedildi') {
        $kullanici->bakiye += $siparis->toplam_tutar;
        $kullanici->save();
    }

    // ONAYLANDI → mail gönderilir
    if ($request->durum === 'mail gönderildi') {
        Mail::to($kullanici->email)->send(new BiletMaili($siparis));
    }

    $siparis->durum = $request->durum;
    $siparis->save();

    return redirect()->route('admin.siparisler')->with('success', 'Sipariş durumu güncellendi!');
}
}
