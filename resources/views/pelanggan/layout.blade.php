<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portal Pelanggan') - Sifabrik</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary: #1a56db;
            --primary-dark: #1646b5;
        }
        body {
            background-color: #f8fafc;
            font-family: 'Segoe UI', sans-serif;
            color: #334155;
        }
        .navbar-pelanggan {
            background: #ffffff;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        }
        .nav-link.active {
            color: var(--primary) !important;
            font-weight: 600;
        }
        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
            background: #fff;
        }
        .badge-menunggu { background: #fef3c7; color: #92400e; }
        .badge-diproses { background: #dbeafe; color: #1e40af; }
        .badge-dikirim  { background: #e0e7ff; color: #3730a3; }
        .badge-selesai  { background: #dcfce7; color: #166534; }
        .badge-dibatalkan { background: #fee2e2; color: #991b1b; }

        /* Ukuran proporsional ikon SVG pagination */
        nav svg,
        nav svg.w-5,
        nav svg.w-4,
        svg.w-5,
        svg.w-4 {
            width: 1.25rem !important;
            height: 1.25rem !important;
            max-width: 20px !important;
            max-height: 20px !important;
            display: inline-block !important;
            vertical-align: middle !important;
        }
        .w-5 { width: 1.25rem !important; }
        .h-5 { height: 1.25rem !important; }
        .w-4 { width: 1rem !important; }
        .h-4 { height: 1rem !important; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-pelanggan py-3 sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="{{ route('pelanggan.dashboard') }}">
            🏭 Sifabrik <span class="badge bg-primary bg-opacity-10 text-primary fs-6 fw-normal ms-2">Portal Pelanggan</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navPelanggan">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navPelanggan">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('pelanggan.dashboard') ? 'active' : '' }}" href="{{ route('pelanggan.dashboard') }}">
                        <i class="fa fa-home me-1"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('pelanggan.order') ? 'active' : '' }}" href="{{ route('pelanggan.order') }}">
                        <i class="fa fa-cart-plus me-1"></i> Buat Pesanan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('pelanggan.riwayat*') || request()->routeIs('pelanggan.pesanan.*') ? 'active' : '' }}" href="{{ route('pelanggan.riwayat') }}">
                        <i class="fa fa-history me-1"></i> Riwayat Pesanan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/katalog') }}" target="_blank">
                        <i class="fa fa-box me-1"></i> Katalog Gudang
                    </a>
                </li>
            </ul>
            <div class="d-flex align-items-center gap-3">
                <span class="fw-semibold small"><i class="fa fa-user-circle me-1 text-primary"></i> {{ Auth::guard('pelanggan')->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                        <i class="fa fa-sign-out-alt me-1"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<div class="container py-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
            <i class="fa fa-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
            <i class="fa fa-exclamation-circle me-1"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

<footer class="py-4 text-center text-muted small mt-5 border-top bg-white">
    &copy; {{ date('Y') }} Sifabrik - Portal Layanan & Pemesanan Gudang Fabrikasi
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>

