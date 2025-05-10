<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function goster()
    {
        $kullanici = Auth::user();
        return view('user.profil', compact('kullanici'));
    }

    public function guncelle(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'password' => 'nullable|min:6|confirmed'
        ]);

        $kullanici = Auth::user();
        $kullanici->name = $request->name;
        $kullanici->email = $request->email;

        if ($request->filled('password')) {
            $kullanici->password = Hash::make($request->password);
        }

        $kullanici->save();

        return redirect()->back()->with('success', 'Profiliniz güncellendi!');
    }
    public function pasif()
{
    $kullanici = Auth::user();
    $kullanici->aktif = false;
    $kullanici->save();

    Auth::logout();

    return redirect('/')->with('error', 'Hesabınız pasif hale getirildi. Giriş yapamazsınız.');
}
public function aktifEt(Request $request)
{
    $user = \App\Models\User::where('email', $request->email)->first();

    if ($user && !$user->aktif) {
        $user->aktif = true;
        $user->save();
        return redirect('/login')->with('success', 'Hesabınız tekrar aktifleştirildi. Giriş yapabilirsiniz.');
    }

    return redirect('/login')->with('error', 'Hesap bulunamadı veya zaten aktif.');
}
}
