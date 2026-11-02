@extends('pelanggan.layout')

@section('title', 'Detail Pesanan ' . $pesanan->kode_pesanan)

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('pelanggan.riwayat') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                <i class="fa fa-arrow-left me-1"></i> Kembali ke Riwayat
            </a>
            <span class="badge rounded-pill px-3 py-2 fs-6 badge-{{ $pesanan->status }}">
                Status: {{ strtoupper($pesanan->status) }}
            </span>
        </div>

        <div class="card card-custom p-4 mb-4">
            <div class="d-flex justify-content-between border-bottom pb-3 mb-3 flex-wrap gap-2">
                <div>
                    <h5 class="fw-bold mb-1">Pesanan: <span class="text-primary">{{ $pesanan->kode_pesanan }}</span></h5>
                    <small class="text-muted"><i class="fa fa-calendar me-1"></i> Tanggal Transaksi: {{ $pesanan->created_at->format('d F Y, H:i') }} WIB</small>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6 mb-3 mb-md-0">
                    <h6 class="fw-bold text-muted text-uppercase small">Tujuan Pengiriman:</h6>
                    <div class="fw-bold">{{ $pesanan->nama_pemesan }}</div>
                    <div class="text-muted small"><i class="fa fa-phone me-1"></i> {{ $pesanan->no_hp }}</div>
                    <div class="mt-2 text-secondary">{{ $pesanan->alamat_pengiriman }}</div>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-muted text-uppercase small">Catatan Fabrikasi / Pesanan:</h6>
                    <div class="p-3 bg-light rounded-3 small">
                        {{ $pesanan->catatan ?: 'Tidak ada catatan khusus.' }}
                    </div>
                    @if($pesanan->status == 'dibatalkan' && $pesanan->alasan_batal)
                        <div class="alert alert-danger mt-3 py-2 small mb-0">
                            <strong>Alasan Dibatalkan:</strong> {{ $pesanan->alasan_batal }}
                        </div>
                    @endif
                </div>
            </div>

            <h6 class="fw-bold text-muted text-uppercase small mb-2">Item Barang</h6>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Barang</th>
                            <th class="text-center" style="width: 120px;">Jumlah</th>
                            <th class="text-end" style="width: 180px;">Harga Satuan</th>
                            <th class="text-end" style="width: 200px;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pesanan->details as $item)
                            <tr>
                                <td>
                                    <div class="fw-bold">{{ $item->nama_barang }}</div>
                                    <small class="text-muted">Kode: {{ $item->barang->kode_barang ?? '-' }}</small>
                                </td>
                                <td class="text-center">{{ $item->jumlah }} {{ $item->barang->satuan ?? 'Unit' }}</td>
                                <td class="text-end">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td class="text-end fw-semibold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end fs-6">Total Tagihan:</th>
                            <th class="text-end fs-5 text-primary">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
