@extends('frontend.layout')
@section('title', 'Kontak')
@section('extra_styles')
<style>
    .hero-sub { background: linear-gradient(135deg,#1a56db,#0f2351); color:#fff; padding: 60px 0 40px; }
    .kontak-icon { width: 48px; height: 48px; background: var(--accent); border-radius: 12px; display:flex; align-items:center; justify-content:center; color: var(--primary); font-size: 1.2rem; flex-shrink: 0; }
</style>
@endsection

@section('content')
<div class="hero-sub">
    <div class="container">
        <span class="section-badge bg-white text-primary">Kontak</span>
        <h1 class="fw-800 mt-2">Hubungi Kami</h1>
        <p class="opacity-75">Kami siap membantu Anda</p>
    </div>
</div>

<div class="container py-5">
    <div class="row g-5">
        <div class="col-lg-5">
            <h4 class="fw-700 mb-4">Informasi Kontak</h4>
            <div class="d-flex gap-3 mb-4">
                <div class="kontak-icon"><i class="fa fa-map-marker-alt"></i></div>
                <div>
                    <div class="fw-600">Alamat</div>
                    <div class="text-muted">{{ $site['alamat'] ?: '-' }}</div>
                </div>
            </div>
            <div class="d-flex gap-3 mb-4">
                <div class="kontak-icon"><i class="fa fa-phone"></i></div>
                <div>
                    <div class="fw-600">Telepon</div>
                    <div class="text-muted">{{ $site['telepon'] ?: '-' }}</div>
                </div>
            </div>
            <div class="d-flex gap-3 mb-4">
                <div class="kontak-icon"><i class="fa fa-envelope"></i></div>
                <div>
                    <div class="fw-600">Email</div>
                    <div class="text-muted">{{ $site['email'] ?: '-' }}</div>
                </div>
            </div>
            @if($site['whatsapp'])
            <a href="https://wa.me/{{ $site['whatsapp'] }}" target="_blank" class="btn btn-success px-4 mt-2">
                <i class="fab fa-whatsapp me-2"></i>Chat via WhatsApp
            </a>
            @endif

            @if($maps_embed)
            <div class="mt-4 rounded-3 overflow-hidden shadow-sm">
                {!! $maps_embed !!}
            </div>
            @endif
        </div>
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h5 class="fw-700 mb-4">Kirim Pesan</h5>
                <form>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-600">Nama</label>
                            <input type="text" class="form-control rounded-3" placeholder="Nama Anda">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-600">Email</label>
                            <input type="email" class="form-control rounded-3" placeholder="email@contoh.com">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-600">Subjek</label>
                            <input type="text" class="form-control rounded-3" placeholder="Subjek pesan">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-600">Pesan</label>
                            <textarea class="form-control rounded-3" rows="5" placeholder="Tulis pesan Anda di sini..."></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary px-4 rounded-3">
                                <i class="fa fa-paper-plane me-2"></i>Kirim Pesan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

