@extends('pelanggan.layout')

@section('title', 'Riwayat Pesanan')

@section('content')
<div class="card card-custom p-4">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h4 class="fw-bold mb-1 text-primary">Daftar Riwayat Pesanan</h4>
            <p class="text-muted small mb-0">Pantau perkembangan status pesanan material dan fabrikasi Anda.</p>
        </div>
        <a href="{{ route('pelanggan.order') }}" class="btn btn-primary rounded-pill px-4">
            <i class="fa fa-plus me-1"></i> Pesan Baru
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>No. Pesanan</th>
                    <th>Tanggal</th>
                    <th>Barang Dipesan</th>
                    <th>Total Biaya</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pesanan as $order)
                    <tr>
                        <td class="fw-bold text-primary">{{ $order->kode_pesanan }}</td>
                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            @foreach($order->details as $d)
                                <span class="d-block">{{ $d->nama_barang }} <strong>x{{ $d->jumlah }}</strong></span>
                            @endforeach
                        </td>
                        <td class="fw-semibold">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge rounded-pill px-3 py-2 badge-{{ $order->status }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('pelanggan.pesanan.detail', $order->id) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                <i class="fa fa-eye me-1"></i> Rincian
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="fa fa-box-open fa-3x mb-3 text-secondary d-block"></i>
                            Belum ada riwayat pesanan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $pesanan->links() }}
    </div>
</div>
@endsection

