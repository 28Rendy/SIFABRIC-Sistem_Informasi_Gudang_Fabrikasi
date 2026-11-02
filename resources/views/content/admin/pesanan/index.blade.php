@extends('layout.main')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h3 class="fw-bold mb-1">Pesanan Masuk dari Pelanggan</h3>
                <p class="text-muted small">Kelola pesanan online dari katalog website fabrikasi</p>
            </div>
            @if($totalMasuk > 0)
                <span class="badge bg-warning text-dark px-3 py-2 fs-6">
                    <i class="fa fa-bell me-1"></i> {{ $totalMasuk }} Pesanan Baru Menunggu
                </span>
            @endif
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Filter Status -->
        <div class="card mb-3">
            <div class="card-body py-2">
                <div class="d-flex gap-2 flex-wrap align-items-center">
                    <span class="fw-bold small text-muted me-2">Filter Status:</span>
                    <a href="{{ route('admin.pesanan.index') }}" class="btn btn-sm {{ !$status ? 'btn-primary' : 'btn-outline-secondary' }}">Semua</a>
                    <a href="{{ route('admin.pesanan.index', ['status' => 'menunggu']) }}" class="btn btn-sm {{ $status == 'menunggu' ? 'btn-warning' : 'btn-outline-warning' }}">Menunggu</a>
                    <a href="{{ route('admin.pesanan.index', ['status' => 'diproses']) }}" class="btn btn-sm {{ $status == 'diproses' ? 'btn-info' : 'btn-outline-info' }}">Diproses</a>
                    <a href="{{ route('admin.pesanan.index', ['status' => 'dikirim']) }}" class="btn btn-sm {{ $status == 'dikirim' ? 'btn-secondary' : 'btn-outline-secondary' }}">Dikirim</a>
                    <a href="{{ route('admin.pesanan.index', ['status' => 'selesai']) }}" class="btn btn-sm {{ $status == 'selesai' ? 'btn-success' : 'btn-outline-success' }}">Selesai</a>
                    <a href="{{ route('admin.pesanan.index', ['status' => 'dibatalkan']) }}" class="btn btn-sm {{ $status == 'dibatalkan' ? 'btn-danger' : 'btn-outline-danger' }}">Dibatalkan</a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>No. Pesanan</th>
                                <th>Tanggal</th>
                                <th>Pelanggan</th>
                                <th>Item Pesanan</th>
                                <th>Total Biaya</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 140px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pesanan as $item)
                                <tr>
                                    <td class="fw-bold text-primary">{{ $item->kode_pesanan }}</td>
                                    <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <div class="fw-semibold">{{ $item->nama_pemesan }}</div>
                                        <small class="text-muted"><i class="fa fa-phone me-1"></i>{{ $item->no_hp }}</small>
                                    </td>
                                    <td>
                                        @foreach($item->details as $d)
                                            <div>{{ $d->nama_barang }} <span class="badge bg-light text-dark">x{{ $d->jumlah }}</span></div>
                                        @endforeach
                                    </td>
                                    <td class="fw-bold">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                    <td>
                                        @if($item->status == 'menunggu')
                                            <span class="badge bg-warning text-dark">Menunggu</span>
                                        @elseif($item->status == 'diproses')
                                            <span class="badge bg-info">Diproses</span>
                                        @elseif($item->status == 'dikirim')
                                            <span class="badge bg-secondary">Dikirim</span>
                                        @elseif($item->status == 'selesai')
                                            <span class="badge bg-success">Selesai</span>
                                        @else
                                            <span class="badge bg-danger">Dibatalkan</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.pesanan.show', $item->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-clipboard-check me-1"></i> Kelola
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">Belum ada pesanan masuk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $pesanan->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
