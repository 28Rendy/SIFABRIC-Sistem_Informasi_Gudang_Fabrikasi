@extends('frontend.layout')
@section('title', $artikel->judul)
@section('extra_styles')
<style>
    .hero-sub { background: linear-gradient(135deg,#1a56db,#0f2351); color:#fff; padding: 60px 0 40px; }
    .artikel-konten { line-height: 1.9; font-size: 1.05rem; }
    .artikel-konten img { max-width: 100%; border-radius: 10px; }
    .artikel-hero-img { max-height: 420px; object-fit: cover; width: 100%; border-radius: 14px; }
</style>
@endsection

@section('content')
<div class="hero-sub">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="--bs-breadcrumb-divider-color:#aac4e8;">
                <li class="breadcrumb-item"><a href="{{ url('/artikel') }}" class="text-white opacity-75">Artikel</a></li>
                <li class="breadcrumb-item active text-white">{{ Str::limit($artikel->judul, 50) }}</li>
            </ol>
        </nav>
        <h1 class="fw-800">{{ $artikel->judul }}</h1>
        <small class="opacity-75"><i class="fa fa-calendar me-1"></i>{{ $artikel->published_at->format('d M Y') }} &bull; <i class="fa fa-user me-1"></i>{{ $artikel->penulis }}</small>
    </div>
</div>

<div class="container py-5">
    <div class="row g-5">
        <div class="col-lg-8">
            @if($artikel->gambar)
                <img src="{{ asset('storage/' . $artikel->gambar) }}" class="artikel-hero-img mb-4" alt="{{ $artikel->judul }}">
            @endif
            <div class="artikel-konten">{!! $artikel->konten !!}</div>
        </div>
        <div class="col-lg-4">
            @if($artikel_lain->count())
            <h6 class="fw-700 mb-3">Artikel Lainnya</h6>
            @foreach($artikel_lain as $lain)
            <div class="card border-0 shadow-sm rounded-3 mb-3 card-hover">
                <div class="card-body py-3">
                    <small class="text-muted">{{ $lain->published_at->format('d M Y') }}</small>
                    <p class="fw-600 mb-1 mt-1 small">{{ $lain->judul }}</p>
                    <a href="{{ url('/artikel/' . $lain->slug) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Baca</a>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>
@endsection

