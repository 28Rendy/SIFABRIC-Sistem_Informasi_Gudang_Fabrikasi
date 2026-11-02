@extends('layout.main')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Pengaturan Website & Frontend</h3>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('admin.pengaturan.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <!-- Identitas Perusahaan -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="fas fa-building me-2"></i> Identitas Pabrik / Sistem</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label class="fw-bold">Nama Pabrik / Perusahaan</label>
                                <input type="text" name="nama_perusahaan" class="form-control" value="{{ $settings['nama_perusahaan'] }}" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="fw-bold">Tagline</label>
                                <input type="text" name="tagline" class="form-control" value="{{ $settings['tagline'] }}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="fw-bold">Deskripsi Singkat</label>
                                <textarea name="deskripsi" class="form-control" rows="3">{{ $settings['deskripsi'] }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label class="fw-bold">Logo Website</label>
                                @if($settings['logo'])
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $settings['logo']) }}" height="40" class="border p-1 rounded">
                                    </div>
                                @endif
                                <input type="file" name="logo" class="form-control" accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kontak & Media Sosial -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="fas fa-address-book me-2"></i> Informasi Kontak & Sosmed</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label class="fw-bold">Alamat Pabrik</label>
                                <textarea name="alamat" class="form-control" rows="2">{{ $settings['alamat'] }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label class="fw-bold">No. Telepon / Fax</label>
                                <input type="text" name="telepon" class="form-control" value="{{ $settings['telepon'] }}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="fw-bold">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $settings['email'] }}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="fw-bold">WhatsApp (Contoh: 628123456789)</label>
                                <input type="text" name="whatsapp" class="form-control" value="{{ $settings['whatsapp'] }}">
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group mb-3">
                                    <label class="fw-bold">Instagram URL</label>
                                    <input type="text" name="instagram" class="form-control" value="{{ $settings['instagram'] }}" placeholder="https://instagram.com/...">
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label class="fw-bold">Facebook URL</label>
                                    <input type="text" name="facebook" class="form-control" value="{{ $settings['facebook'] }}" placeholder="https://facebook.com/...">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hero Section Beranda -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="fas fa-home me-2"></i> Banner Hero Beranda</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label class="fw-bold">Judul Hero Banner</label>
                                <input type="text" name="hero_judul" class="form-control" value="{{ $settings['hero_judul'] }}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="fw-bold">Subjudul Hero</label>
                                <textarea name="hero_subjudul" class="form-control" rows="3">{{ $settings['hero_subjudul'] }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label class="fw-bold">Foto Banner Hero</label>
                                @if($settings['hero_foto'])
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $settings['hero_foto']) }}" height="80" class="border p-1 rounded">
                                    </div>
                                @endif
                                <input type="file" name="hero_foto" class="form-control" accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Halaman Tentang Kami -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="fas fa-info-circle me-2"></i> Konten Halaman Tentang Kami</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label class="fw-bold">Deskripsi Perusahaan / Tentang Kami</label>
                                <textarea name="tentang_konten" class="form-control" rows="3">{{ $settings['tentang_konten'] }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label class="fw-bold">Visi</label>
                                <textarea name="tentang_visi" class="form-control" rows="2">{{ $settings['tentang_visi'] }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label class="fw-bold">Misi</label>
                                <textarea name="tentang_misi" class="form-control" rows="2">{{ $settings['tentang_misi'] }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label class="fw-bold">Foto Profil Perusahaan</label>
                                @if($settings['tentang_foto'])
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $settings['tentang_foto']) }}" height="80" class="border p-1 rounded">
                                    </div>
                                @endif
                                <input type="file" name="tentang_foto" class="form-control" accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mb-4">
                    <button type="submit" class="btn btn-primary btn-lg w-100">
                        <i class="fas fa-save me-2"></i> Simpan Semua Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

