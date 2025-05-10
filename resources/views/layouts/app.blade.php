<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Bilet Al')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar-custom {
            background: linear-gradient(to right, #1e3c72, #2a5298);
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">🎫 Bilet Al</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            {{-- Sol Menü --}}
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @auth
                    @if(auth()->user()->role !== 'admin')
                        <li class="nav-item"><a class="nav-link" href="{{ route('user.konserler') }}">Konserler</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('sepet.goster') }}">Sepet</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('user.siparisler') }}">Siparişlerim</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.panel') }}">Yönetim</a></li>
                    @endif
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.konserler') }}">Konserler</a></li>
                @endauth
            </ul>

            {{-- Sağ Menü --}}
            <ul class="navbar-nav ms-auto">
                @auth
                    @if(auth()->user()->role !== 'admin')
                        <li class="nav-item nav-link text-light me-2">
                            💰 {{ number_format(auth()->user()->bakiye, 2) }} ₺
                        </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profil.goster') }}">Profilim</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Çıkış Yap</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Giriş</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Kayıt Ol</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<main class="py-4">
    <div class="container">
        @yield('content')
    </div>
</main>

{{-- Hakkında --}}
@include('partials.hakkinda')

{{-- Footer --}}
@include('partials.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
