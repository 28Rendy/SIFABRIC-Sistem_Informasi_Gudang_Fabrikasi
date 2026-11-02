@extends('frontend.layout')
@section('title', 'Galeri Foto')
@section('extra_styles')
<style>
    .hero-sub { background: linear-gradient(135deg,#1a56db,#0f2351); color:#fff; padding: 60px 0 40px; }
    .galeri-img { height: 220px; object-fit: cover; width: 100%; transition: transform .3s; }
    .galeri-card:hover .galeri-img { transform: scale(1.05); }
    .galeri-card { overflow: hidden; border-radius: 12px; }
</style>
@endsection

@section('content')
<div class="hero-sub">
    <div class="container">
        <span class="section-badge bg-white text-primary">Galeri</span>
        <h1 class="fw-800 mt-2">Galeri Foto</h1>
        <p class="opacity-75">Dokumentasi kegiatan dan fasilitas kami</p>
    </div>
</div>

<div class="container py-5">
    @if($galeri->count())
        <div class="row g-4">
            @foreach($galeri as $foto)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card border-0 shadow-sm galeri-card card-hover">
                    <img src="{{ asset('storage/' . $foto->foto) }}" class="galeri-img" alt="{{ $foto->judul }}">
                    <div class="card-body py-2 px-3">
                        <p class="mb-0 fw-600 small">{{ $foto->judul }}</p>
                        @if($foto->deskripsi)<small class="text-muted">{{ $foto->deskripsi }}</small>@endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-4 d-flex justify-content-center">
            {{ $galeri->links() }}
        </div>
    @else
        <div class="text-center py-5 text-muted">
            <div style="font-size:4rem;">🖼️</div>
            <h5>Belum ada foto di galeri</h5>
        </div>
    @endif
</div>
@endsection

