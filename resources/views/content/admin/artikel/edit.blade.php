@extends('layout.main')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Edit Artikel</h3>
        </div>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.artikel.update', $artikel->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label class="fw-bold">Judul Artikel</label>
                        <input type="text" name="judul" class="form-control" value="{{ $artikel->judul }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-bold">Ringkasan Singkat (Lead)</label>
                        <textarea name="ringkasan" class="form-control" rows="2">{{ $artikel->ringkasan }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-bold">Konten / Isi Artikel</label>
                        <textarea name="konten" class="form-control" rows="8" required>{{ $artikel->konten }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold">Gambar Sampul</label>
                            @if($artikel->gambar)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $artikel->gambar) }}" height="70" class="rounded border p-1">
                                </div>
                            @endif
                            <input type="file" name="gambar" class="form-control" accept="image/*">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold d-block">Status Publikasi</label>
                            <input type="checkbox" name="aktif" value="1" {{ $artikel->aktif ? 'checked' : '' }}> Tayangkan langsung ke publik
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa fa-save me-1"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.artikel.index') }}" class="btn btn-secondary ms-2">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

