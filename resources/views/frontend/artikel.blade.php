@extends('frontend.layout')
@section('title', 'Artikel')
@section('extra_styles')
<style>
    .hero-sub { background: linear-gradient(135deg,#1a56db,#0f2351); color:#fff; padding: 60px 0 40px; }
    .artikel-img { height: 200px; object-fit: cover; width: 100%; }
</style>
@endsection

@section('content')
<div class="hero-sub">
    <div class="container">
        <span class="section-badge bg-white text-primary">Artikel</span>
        <h1 class="fw-800 mt-2">Artikel & Berita</h1>
        <p class="opacity-75">Informasi terbaru seputar industri fabrikasi dan gudang</p>
    </div>
</div>

<div class="container py-5">
    @if($artikel->count())
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
                        <small class="text-muted"><i class="fa fa-calendar me-1"></i>{{ $art->published_at->format('d M Y') }}
                        &bull; <i class="fa fa-user me-1"></i>{{ $art->penulis }}</small>
                        <h6 class="fw-700 mt-2">{{ $art->judul }}</h6>
                        <p class="text-muted small mb-3">{{ Str::limit($art->ringkasan, 100) }}</p>
                        <a href="{{ url('/artikel/' . $art->slug) }}" class="btn btn-sm btn-primary rounded-pill px-3">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-4 d-flex justify-content-center">
            {{ $artikel->links() }}
        </div>
    @else
        <div class="text-center py-5 text-muted">
            <div style="font-size:4rem;">📰</div>
            <h5>Belum ada artikel</h5>
        </div>
    @endif
</div>
@endsection

