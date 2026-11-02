<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $site['nama']) - {{ $site['tagline'] }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary: #1a56db;
            --primary-dark: #1e429f;
            --accent: #e3f0ff;
        }
        body { font-family: 'Segoe UI', sans-serif; color: #333; }

        /* Navbar */
        .navbar { background: #fff; box-shadow: 0 2px 10px rgba(0,0,0,.08); }
        .navbar-brand { font-weight: 700; font-size: 1.4rem; color: var(--primary) !important; }
        .nav-link { font-weight: 500; color: #444 !important; transition: color .2s; }
        .nav-link:hover, .nav-link.active { color: var(--primary) !important; }
        .btn-login { background: var(--primary); color: #fff !important; border-radius: 8px; padding: 6px 20px; }
        .btn-login:hover { background: var(--primary-dark); }

        /* Footer */
        footer { background: #0f2351; color: #aac4e8; }
        footer a { color: #aac4e8; text-decoration: none; }
        footer a:hover { color: #fff; }
        footer .footer-brand { color: #fff; font-size: 1.3rem; font-weight: 700; }
        footer .footer-divider { border-color: rgba(255,255,255,.1); }

        /* Card hover */
        .card-hover { transition: transform .25s, box-shadow .25s; }
        .card-hover:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(0,0,0,.12); }

        /* Section */
        .section-title { font-weight: 700; font-size: 2rem; color: #0f2351; }
        .section-subtitle { color: #666; margin-bottom: 2.5rem; }
        .section-badge { background: var(--accent); color: var(--primary); font-size: .8rem; font-weight: 600; padding: 4px 14px; border-radius: 20px; }

        @yield('styles')
    </style>
    @yield('extra_styles')
</head>
<body>

{{-- Navbar --}}
<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            @if($site['logo'])
                <img src="{{ asset('storage/' . $site['logo']) }}" height="36" alt="{{ $site['nama'] }}" class="me-2">
            @else
                🏭
            @endif
            {{ $site['nama'] }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav mx-auto gap-1">
                <li class="nav-item"><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Beranda</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('katalog*') ? 'active' : '' }}" href="{{ url('/katalog') }}">Katalog</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('galeri*') ? 'active' : '' }}" href="{{ url('/galeri') }}">Galeri</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('artikel*') ? 'active' : '' }}" href="{{ url('/artikel') }}">Artikel</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('tentang-kami*') ? 'active' : '' }}" href="{{ url('/tentang-kami') }}">Tentang Kami</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('kontak*') ? 'active' : '' }}" href="{{ url('/kontak') }}">Kontak</a></li>
            </ul>
            <a href="{{ route('login') }}" class="btn btn-login ms-2">
                <i class="fa fa-sign-in-alt me-1"></i> Login Admin
            </a>
        </div>
    </div>
</nav>

{{-- Content --}}
@yield('content')

{{-- Footer --}}
<footer class="pt-5 pb-3 mt-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="footer-brand mb-2">🏭 {{ $site['nama'] }}</div>
                <p style="font-size:.9rem;">{{ $site['tagline'] }}</p>
                <div class="d-flex gap-3 mt-3">
                    @if($site['instagram'])<a href="{{ $site['instagram'] }}" target="_blank"><i class="fab fa-instagram fa-lg"></i></a>@endif
                    @if($site['facebook'])<a href="{{ $site['facebook'] }}" target="_blank"><i class="fab fa-facebook fa-lg"></i></a>@endif
                    @if($site['whatsapp'])<a href="https://wa.me/{{ $site['whatsapp'] }}" target="_blank"><i class="fab fa-whatsapp fa-lg"></i></a>@endif
                </div>
            </div>
            <div class="col-lg-2">
                <h6 class="text-white mb-3">Menu</h6>
                <ul class="list-unstyled" style="font-size:.9rem;">
                    <li class="mb-1"><a href="{{ url('/') }}">Beranda</a></li>
                    <li class="mb-1"><a href="{{ url('/katalog') }}">Katalog</a></li>
                    <li class="mb-1"><a href="{{ url('/galeri') }}">Galeri</a></li>
                    <li class="mb-1"><a href="{{ url('/artikel') }}">Artikel</a></li>
                    <li class="mb-1"><a href="{{ url('/tentang-kami') }}">Tentang Kami</a></li>
                    <li class="mb-1"><a href="{{ url('/kontak') }}">Kontak</a></li>
                </ul>
            </div>
            <div class="col-lg-4">
                <h6 class="text-white mb-3">Kontak</h6>
                <ul class="list-unstyled" style="font-size:.9rem;">
                    @if($site['alamat'])<li class="mb-2"><i class="fa fa-map-marker-alt me-2"></i>{{ $site['alamat'] }}</li>@endif
                    @if($site['telepon'])<li class="mb-2"><i class="fa fa-phone me-2"></i>{{ $site['telepon'] }}</li>@endif
                    @if($site['email'])<li class="mb-2"><i class="fa fa-envelope me-2"></i>{{ $site['email'] }}</li>@endif
                </ul>
            </div>
        </div>
        <hr class="footer-divider mt-4">
        <div class="text-center" style="font-size:.85rem;">
            &copy; {{ date('Y') }} {{ $site['nama'] }}. All rights reserved.
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>

