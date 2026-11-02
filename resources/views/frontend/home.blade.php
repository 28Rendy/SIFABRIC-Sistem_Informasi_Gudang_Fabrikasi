@extends('frontend.layout')

@section('title', 'Beranda')

@section('extra_styles')
<style>
    .hero { background: linear-gradient(135deg, #1a56db 0%, #0f2351 100%); color: #fff; min-height: 88vh; display: flex; align-items: center; }
    .hero h1 { font-size: 3rem; font-weight: 800; line-height: 1.2; }
    .hero p { font-size: 1.15rem; opacity: .88; }
    .hero-img { border-radius: 16px; box-shadow: 0 20px 60px rgba(0,0,0,.3); max-height: 420px; object-fit: cover; width: 100%; }
    .hero-placeholder { background: rgba(255,255,255,.1); border-radius: 16px; height: 360px; display: flex; align-items: center; justify-content: center; font-size: 6rem; }
    .stat-card { background: #fff; border-radius: 16px; padding: 2rem; text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,.08); }
    .stat-number { font-size: 2.5rem; font-weight: 800; color: var(--primary); }
    .fitur-icon { width: 60px; height: 60px; background: var(--accent); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; margin-bottom: 1rem; }
    .galeri-thumb { height: 200px; object-fit: cover; width: 100%; border-radius: 10px; }
    .artikel-img { height: 180px; object-fit: cover; width: 100%; }
</style>
@endsection

@section('content')

{{-- Hero --}}
<section class="hero">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="badge bg-white text-primary mb-3 px-3 py-2 rounded-pill">🏭 {{ $site['tagline'] }}</span>
                <h1>{{ $hero_judul }}</h1>
                <p class="mt-3 mb-4">{{ $hero_subjudul }}</p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ url('/katalog') }}" class="btn btn-light btn-lg px-4 fw-600">Lihat Katalog <i class="fa fa-arrow-right ms-1"></i></a>
                    <a href="{{ url('/kontak') }}" class="btn btn-outline-light btn-lg px-4">Hubungi Kami</a>
                </div>
            </div>
            <div class="col-lg-6">
                @if($hero_foto)
                    <img src="{{ asset('storage/' . $hero_foto) }}" class="hero-img" alt="Hero">
                @else
                    <div class="hero-placeholder">🏭</div>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- Statistik --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4 justify-content-center">
            <div class="col-6 col-md-3">
                <div class="stat-card card-hover">
                    <div class="stat-number">{{ $total_barang }}+</div>
                    <div class="text-muted">Jenis Barang</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card card-hover">
                    <div class="stat-number">100%</div>
                    <div class="text-muted">Digital</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card card-hover">
                    <div class="stat-number">24/7</div>
                    <div class="text-muted">Akses Sistem</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card card-hover">
                    <div class="stat-number">Real-time</div>
                    <div class="text-muted">Laporan</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Fitur Unggulan --}}
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-badge">Fitur</span>
            <h2 class="section-title mt-2">Mengapa Memilih Sifabrik?</h2>
            <p class="section-subtitle">Solusi lengkap untuk manajemen gudang fabrikasi Anda</p>
        </div>
        <div class="row g-4">
            @php $fitur = [
                ['ikon'=>'📦','judul'=>'Manajemen Stok','desc'=>'Pantau stok barang secara real-time, termasuk barang masuk, keluar, dan stok minimum.'],
                ['ikon'=>'🛒','judul'=>'Transaksi Penjualan','desc'=>'Catat dan kelola transaksi penjualan dengan cepat, lengkap dengan struk digital.'],
                ['ikon'=>'🚚','judul'=>'Manajemen Supplier','desc'=>'Kelola data supplier dan riwayat pembelian barang dengan mudah dan terorganisir.'],
                ['ikon'=>'📊','judul'=>'Laporan & Grafik','desc'=>'Dashboard interaktif dengan grafik penjualan bulanan dan laporan yang bisa diekspor.'],
                ['ikon'=>'👥','judul'=>'Multi-Role Pengguna','desc'=>'Sistem hak akses untuk Admin, Kasir, dan Pimpinan dengan dashboard masing-masing.'],
                ['ikon'=>'📋','judul'=>'Export Laporan','desc'=>'Ekspor laporan stok, penjualan, dan barang masuk ke format Excel dan PDF.'],
            ] @endphp
            @foreach($fitur as $f)
            <div class="col-md-4">
                <div class="card border-0 h-100 p-4 card-hover shadow-sm rounded-4">
                    <div class="fitur-icon">{{ $f['ikon'] }}</div>
                    <h5 class="fw-700">{{ $f['judul'] }}</h5>
                    <p class="text-muted mb-0">{{ $f['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Galeri Preview --}}
@if($galeri->count())
<section class="py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <span class="section-badge">Galeri</span>
                <h2 class="section-title mt-2 mb-0">Galeri Foto</h2>
            </div>
            <a href="{{ url('/galeri') }}" class="btn btn-outline-primary">Lihat Semua <i class="fa fa-arrow-right ms-1"></i></a>
        </div>
        <div class="row g-3">
            @foreach($galeri as $foto)
            <div class="col-6 col-md-4">
                <div class="card border-0 overflow-hidden rounded-3 card-hover shadow-sm">
                    <img src="{{ asset('storage/' . $foto->foto) }}" class="galeri-thumb" alt="{{ $foto->judul }}">
                    <div class="card-body py-2 px-3">
                        <small class="text-muted">{{ $foto->judul }}</small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Artikel Preview --}}
@if($artikel->count())
<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <span class="section-badge">Artikel</span>
                <h2 class="section-title mt-2 mb-0">Artikel Terbaru</h2>
            </div>
            <a href="{{ url('/artikel') }}" class="btn btn-outline-primary">Semua Artikel <i class="fa fa-arrow-right ms-1"></i></a>
        </div>
        <div class="row g-4">
            @foreach($artikel as $art)
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 h-100 card-hover overflow-hidden">
                    @if($art->gambar)
                        <img src="{{ asset('storage/' . $art->gambar) }}" class="artikel-img" alt="{{ $art->judul }}">
                    @else
                        <div class="artikel-img bg-primary bg-opacity-10 d-flex align-items-center justify-content-center" style="font-size:3rem;">📰</div>
                    @endif
                    <div class="card-body">
                        <small class="text-muted"><i class="fa fa-calendar me-1"></i>{{ $art->published_at->format('d M Y') }}</small>
                        <h6 class="fw-700 mt-2">{{ $art->judul }}</h6>
                        <p class="text-muted small mb-3">{{ Str::limit($art->ringkasan, 90) }}</p>
                        <a href="{{ url('/artikel/' . $art->slug) }}" class="btn btn-sm btn-primary rounded-pill px-3">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- CTA --}}
<section class="py-5" style="background: linear-gradient(135deg, #1a56db, #0f2351);">
    <div class="container text-center text-white py-3">
        <h2 class="fw-800 mb-3">Siap Digitalisasi Gudang Anda?</h2>
        <p class="mb-4 opacity-75">Mulai kelola stok, penjualan, dan laporan dengan lebih efisien bersama Sifabrik.</p>
        <a href="{{ url('/kontak') }}" class="btn btn-light btn-lg px-5">Hubungi Kami Sekarang</a>
    </div>
</section>

@endsection

