@extends('layout.main')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Kelola Galeri Foto</h3>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Daftar Foto Galeri</h4>
                <button class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    <i class="fa fa-plus me-1"></i> Tambah Foto
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th style="width: 80px;">Foto</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th style="width: 80px;">Urutan</th>
                                <th style="width: 100px;">Status</th>
                                <th style="width: 150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($galeri as $item)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $item->foto) }}" width="60" height="60" style="object-fit:cover; border-radius:8px;">
                                </td>
                                <td class="fw-bold">{{ $item->judul }}</td>
                                <td>{{ $item->deskripsi ?? '-' }}</td>
                                <td>{{ $item->urutan }}</td>
                                <td>
                                    @if($item->aktif)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.galeri.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="POST" action="{{ route('admin.galeri.update', $item->id) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Foto Galeri</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group mb-3">
                                                    <label class="fw-bold">Judul Foto</label>
                                                    <input type="text" name="judul" class="form-control" value="{{ $item->judul }}" required>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="fw-bold">Deskripsi</label>
                                                    <textarea name="deskripsi" class="form-control" rows="2">{{ $item->deskripsi }}</textarea>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="fw-bold">Ganti Foto (Opsional)</label>
                                                    <input type="file" name="foto" class="form-control" accept="image/*">
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 form-group mb-3">
                                                        <label class="fw-bold">Urutan</label>
                                                        <input type="number" name="urutan" class="form-control" value="{{ $item->urutan }}">
                                                    </div>
                                                    <div class="col-md-6 form-group mb-3">
                                                        <label class="fw-bold d-block">Tampilkan di Web</label>
                                                        <input type="checkbox" name="aktif" value="1" {{ $item->aktif ? 'checked' : '' }}> Aktif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Belum ada foto di galeri</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $galeri->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.galeri.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Foto Galeri</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label class="fw-bold">Judul Foto</label>
                        <input type="text" name="judul" class="form-control" placeholder="Contoh: Mesin Produksi 1" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="fw-bold">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="2" placeholder="Keterangan singkat..."></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label class="fw-bold">Pilih Foto</label>
                        <input type="file" name="foto" class="form-control" accept="image/*" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold">Urutan</label>
                            <input type="number" name="urutan" class="form-control" value="0">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold d-block">Tampilkan di Web</label>
                            <input type="checkbox" name="aktif" value="1" checked> Aktif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
