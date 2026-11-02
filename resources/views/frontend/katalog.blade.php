@extends('frontend.layout')
@section('title', 'Katalog Produk')
@section('extra_styles')
<style>
    .hero-sub { background: linear-gradient(135deg,#1a56db,#0f2351); color:#fff; padding: 60px 0 40px; }
    .badge-kategori { background: #e3f0ff; color: #1a56db; font-size: .78rem; font-weight: 600; padding: 3px 10px; border-radius: 20px; }
    .card-barang img { height: 180px; object-fit: cover; }
    .harga { font-size: 1.1rem; font-weight: 700; color: #1a56db; }
    .stok-badge { font-size: .75rem; }
</style>
@endsection

@section('content')
<div class="hero-sub">
    <div class="container">
        <span class="section-badge bg-white text-primary">Katalog</span>
        <h1 class="fw-800 mt-2">Katalog Produk</h1>
        <p class="opacity-75">Temukan semua produk yang tersedia di gudang kami</p>
    </div>
</div>

<div class="container py-5">
    @if($barang->count())
        <div class="row g-4">
            @foreach($barang as $item)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 h-100 card-hover overflow-hidden">
                    <div class="bg-light d-flex align-items-center justify-content-center" style="height:160px;font-size:3.5rem;">📦</div>
                    <div class="card-body">
                        <span class="badge-kategori">{{ $item->kategori->nama_kategori ?? '-' }}</span>
                        <h6 class="fw-700 mt-2 mb-1">{{ $item->nama_barang }}</h6>
                        <small class="text-muted d-block mb-2">{{ $item->kode_barang }}</small>
                        @if($item->harga_jual)
                            <div class="harga">Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</div>
                        @endif
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <small class="text-muted">Satuan: {{ $item->satuan }}</small>
                            <span class="badge {{ $item->stok > 10 ? 'bg-success' : 'bg-warning text-dark' }} stok-badge">
                                Stok: {{ $item->stok }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-4 d-flex justify-content-center">
            {{ $barang->links() }}
        </div>
    @else
        <div class="text-center py-5 text-muted">
            <div style="font-size:4rem;">📦</div>
            <h5>Belum ada produk tersedia</h5>
        </div>
    @endif
</div>
@endsection

