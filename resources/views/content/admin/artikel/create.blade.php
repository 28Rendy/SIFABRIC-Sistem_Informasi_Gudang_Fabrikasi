@extends('layout.main')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Tulis Artikel Baru</h3>
        </div>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.artikel.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="fw-bold">Judul Artikel</label>
                        <input type="text" name="judul" class="form-control" placeholder="Masukkan judul..." required>
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-bold">Ringkasan Singkat (Lead)</label>
                        <textarea name="ringkasan" class="form-control" rows="2" placeholder="Penjelasan singkat artikel..."></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-bold">Konten / Isi Artikel</label>
                        <textarea name="konten" class="form-control" rows="8" placeholder="Tulis isi artikel secara lengkap..." required></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold">Gambar Sampul</label>
                            <input type="file" name="gambar" class="form-control" accept="image/*">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold d-block">Status Publikasi</label>
                            <input type="checkbox" name="aktif" value="1" checked> Tayangkan langsung ke publik
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa fa-paper-plane me-1"></i> Terbitkan Artikel
                        </button>
                        <a href="{{ route('admin.artikel.index') }}" class="btn btn-secondary ms-2">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
