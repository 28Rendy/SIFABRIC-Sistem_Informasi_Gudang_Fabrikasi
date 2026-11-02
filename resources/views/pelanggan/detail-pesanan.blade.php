@extends('layout.main')

@section('content')
<div class="container">
  <div class="page-inner">

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
      <div>
        <a href="{{ route('pelanggan.riwayat') }}" class="btn btn-outline-secondary btn-round btn-sm px-3 mb-2">
          <i class="fas fa-arrow-left me-1"></i> Kembali ke Riwayat
        </a>
        <h3 class="fw-bold mb-0">Rincian Pesanan <span class="text-primary">{{ $pesanan->kode_pesanan }}</span></h3>
      </div>
      <div>
        <span class="badge rounded-pill px-3 py-2 fs-6 badge-{{ $pesanan->status }}">
          Status: {{ strtoupper($pesanan->status) }}
        </span>
      </div>
    </div>

    <div class="card card-round mb-4">
      <div class="card-header border-bottom">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
          <h4 class="card-title mb-0"><i class="fas fa-file-invoice text-primary me-2"></i> Informasi Dokumen Pesanan</h4>
          <small class="text-muted"><i class="fas fa-calendar me-1"></i> {{ $pesanan->created_at->format('d F Y, H:i') }} WIB</small>
        </div>
      </div>
      <div class="card-body">
        <div class="row mb-4">
          <div class="col-md-6 mb-3 mb-md-0 border-end">
            <h6 class="fw-bold text-muted text-uppercase small mb-2"><i class="fas fa-map-marker-alt text-danger me-1"></i> Tujuan Pengiriman:</h6>
            <div class="fw-bold fs-5 text-dark">{{ $pesanan->nama_pemesan }}</div>
            <div class="text-muted small mt-1"><i class="fas fa-phone me-1"></i> {{ $pesanan->no_hp }}</div>
            <div class="mt-2 text-secondary bg-light p-3 rounded-3">{{ $pesanan->alamat_pengiriman }}</div>
          </div>
          <div class="col-md-6 ps-md-4">
            <h6 class="fw-bold text-muted text-uppercase small mb-2"><i class="fas fa-sticky-note text-warning me-1"></i> Catatan Spesifikasi Fabrikasi:</h6>
            <div class="p-3 bg-light rounded-3 text-secondary small">
              {{ $pesanan->catatan ?: 'Tidak ada instruksi khusus.' }}
            </div>
            @if($pesanan->status == 'dibatalkan' && $pesanan->alasan_batal)
              <div class="alert alert-danger mt-3 py-2 small mb-0">
                <strong>Alasan Pembatalan:</strong> {{ $pesanan->alasan_batal }}
              </div>
            @endif
          </div>
        </div>

        <h5 class="fw-bold mb-3"><i class="fas fa-boxes text-info me-2"></i> Rincian Barang Dipesan</h5>
        <div class="table-responsive">
          <table class="table table-bordered align-middle">
            <thead class="thead-light">
              <tr>
                <th class="ps-3">Nama Barang</th>
                <th class="text-center" style="width: 130px;">Jumlah</th>
                <th class="text-end" style="width: 200px;">Harga Satuan</th>
                <th class="text-end pe-3" style="width: 220px;">Subtotal</th>
              </tr>
            </thead>
            <tbody>
              @foreach($pesanan->details as $item)
                <tr>
                  <td class="ps-3">
                    <div class="fw-bold text-dark">{{ $item->nama_barang }}</div>
                    <small class="text-muted">Kode: {{ $item->barang->kode_barang ?? '-' }}</small>
                  </td>
                  <td class="text-center fw-semibold">{{ $item->jumlah }} {{ $item->barang->satuan ?? 'Unit' }}</td>
                  <td class="text-end">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                  <td class="text-end pe-3 fw-bold text-primary">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr class="bg-light">
                <th colspan="3" class="text-end fs-6 py-3">Total Pembayaran:</th>
                <th class="text-end pe-3 fs-5 text-primary py-3">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection
