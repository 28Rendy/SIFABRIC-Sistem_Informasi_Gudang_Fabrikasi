@extends('pelanggan.layout')

@section('title', 'Dashboard Pelanggan')

@section('content')
<div class="row g-3 mb-4">
    <div class="col-12">
        <div class="card card-custom p-4 bg-primary text-white" style="background: linear-gradient(135deg, #1a56db 0%, #0f2351 100%) !important;">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h4 class="fw-bold mb-1">Halo, {{ $user->name }}! 👋</h4>
                    <p class="mb-0 opacity-75 small">Selamat datang di portal layanan pemesanan fabrikasi & logistik gudang Sifabrik.</p>
                </div>
                <a href="{{ route('pelanggan.order') }}" class="btn btn-light text-primary fw-semibold px-4 rounded-pill">
                    <i class="fa fa-plus me-1"></i> Buat Pesanan Baru
                </a>
            </div>
        </div>
    </div>

    <!-- Ringkasan Statistik -->
    <div class="col-sm-6 col-lg-3">
        <div class="card card-custom p-3">
            <div class="text-muted small fw-semibold">Total Pesanan</div>
            <h3 class="fw-bold mt-1 text-primary">{{ $totalPesanan }}</h3>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card card-custom p-3">
            <div class="text-muted small fw-semibold">Menunggu Konfirmasi</div>
            <h3 class="fw-bold mt-1 text-warning">{{ $menunggu }}</h3>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card card-custom p-3">
            <div class="text-muted small fw-semibold">Sedang Diproses/Kirim</div>
            <h3 class="fw-bold mt-1 text-info">{{ $diproses }}</h3>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card card-custom p-3">
            <div class="text-muted small fw-semibold">Pesanan Selesai</div>
            <h3 class="fw-bold mt-1 text-success">{{ $selesai }}</h3>
        </div>
    </div>
</div>

<!-- Pesanan Terbaru -->
<div class="card card-custom">
    <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold m-0 text-dark">5 Pesanan Terakhir</h5>
        <a href="{{ route('pelanggan.riwayat') }}" class="small text-decoration-none fw-semibold">Lihat Semua</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">No. Pesanan</th>
                        <th>Tanggal</th>
                        <th>Barang</th>
                        <th>Total Biaya</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesananTerbaru as $order)
                        <tr>
                            <td class="ps-4 fw-bold text-primary">{{ $order->kode_pesanan }}</td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                @foreach($order->details as $d)
                                    <div>{{ $d->nama_barang }} (x{{ $d->jumlah }})</div>
                                @endforeach
                            </td>
                            <td class="fw-semibold">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge rounded-pill px-3 py-2 badge-{{ $order->status }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('pelanggan.pesanan.detail', $order->id) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                Belum ada pesanan. <a href="{{ route('pelanggan.order') }}">Pesan barang sekarang</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
