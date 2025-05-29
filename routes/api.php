<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json([
            'durum' => 'hata',
            'mesaj' => 'Email ya da şifre hatalı',
        ], 401);
    }

    return response()->json([
        'durum' => 'basarili',
        'mesaj' => 'Giriş başarılı',
        'kullanici' => [
            'id' => $user->id,
            'ad' => $user->name,
            'email' => $user->email,
        ]
    ], 200);
});