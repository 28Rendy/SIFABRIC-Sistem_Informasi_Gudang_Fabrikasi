@extends('frontend.layout')
@section('title', 'Tentang Kami')
@section('extra_styles')
<style>
    .hero-sub { background: linear-gradient(135deg,#1a56db,#0f2351); color:#fff; padding: 60px 0 40px; }
    .tentang-img { border-radius: 16px; max-height: 400px; object-fit: cover; width: 100%; }
    .visi-misi-card { border-left: 4px solid var(--primary); border-radius: 0 12px 12px 0; background: #f8fbff; }
</style>
@endsection

@section('content')
<div class="hero-sub">
    <div class="container">
        <span class="section-badge bg-white text-primary">Profil</span>
        <h1 class="fw-800 mt-2">Tentang Kami</h1>
        <p class="opacity-75">Kenali lebih dekat {{ $site['nama'] }}</p>
    </div>
</div>

<div class="container py-5">
    <div class="row align-items-center g-5 mb-5">
        <div class="col-lg-6">
            @if($tentang_foto)
                <img src="{{ asset('storage/' . $tentang_foto) }}" class="tentang-img shadow" alt="Tentang Kami">
            @else
                <div class="bg-primary bg-opacity-10 rounded-4 d-flex align-items-center justify-content-center" style="height:360px;font-size:7rem;">🏭</div>
            @endif
        </div>
        <div class="col-lg-6">
            <span class="section-badge">Tentang Kami</span>
            <h2 class="section-title mt-2">{{ $site['nama'] }}</h2>
            <p class="text-muted mt-3" style="line-height:1.8;">{{ $tentang_konten }}</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="p-4 visi-misi-card">
                <h5 class="fw-700 text-primary"><i class="fa fa-eye me-2"></i>Visi</h5>
                <p class="text-muted mb-0">{{ $tentang_visi }}</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="p-4 visi-misi-card">
                <h5 class="fw-700 text-primary"><i class="fa fa-bullseye me-2"></i>Misi</h5>
                <p class="text-muted mb-0">{{ $tentang_misi }}</p>
            </div>
        </div>
    </div>
</div>
@endsection

