@extends('layout.main')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Kelola Artikel & Berita</h3>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Daftar Artikel</h4>
                <a href="{{ route('admin.artikel.create') }}" class="btn btn-primary btn-round">
                    <i class="fa fa-plus me-1"></i> Tulis Artikel Baru
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th style="width: 80px;">Gambar</th>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Tanggal</th>
                                <th style="width: 100px;">Status</th>
                                <th style="width: 150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($artikel as $item)
                            <tr>
                                <td>
                                    @if($item->gambar)
                                        <img src="{{ asset('storage/' . $item->gambar) }}" width="60" height="60" style="object-fit:cover; border-radius:8px;">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center text-muted" style="width:60px; height:60px; border-radius:8px;">📰</div>
                                    @endif
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $item->judul }}</div>
                                    <small class="text-muted">{{ Str::limit($item->ringkasan, 70) }}</small>
                                </td>
                                <td>{{ $item->penulis }}</td>
                                <td>{{ $item->published_at ? $item->published_at->format('d/m/Y') : '-' }}</td>
                                <td>
                                    @if($item->aktif)
                                        <span class="badge bg-success">Tayang</span>
                                    @else
                                        <span class="badge bg-secondary">Draf</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.artikel.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.artikel.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus artikel ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Belum ada artikel yang dibuat</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $artikel->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
