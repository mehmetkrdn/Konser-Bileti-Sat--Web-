<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        return response()->json([
            'durum' => 'basarili',
            'mesaj' => 'Giriş başarılı',
        ], 200);
    }

    return response()->json([
        'durum' => 'hata',
        'mesaj' => 'Email ya da şifre hatalı',
    ], 401);
});
