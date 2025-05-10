<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
   public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();
    $request->session()->regenerate();

    // Pasif kullanıcı engeli
    if (!auth()->user()->aktif) {
        auth()->logout();
        return redirect('/login')->with('error', 'Hesabınız pasif durumda. Giriş yapamazsınız.');
    }

    // Rol kontrolü ile yönlendirme
    if (auth()->user()->role === 'admin') {
        return redirect('/admin'); // 👉 admin paneli route
    }

    return redirect()->intended(RouteServiceProvider::HOME);
}
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
