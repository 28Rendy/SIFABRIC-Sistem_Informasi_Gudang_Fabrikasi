@extends('layout.main')

@section('content')
<div class="container">
  <div class="page-inner">

    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4 justify-content-between">
      <div>
        <h3 class="fw-bold mb-1">Riwayat Pesanan Saya</h3>
        <h6 class="op-7 mb-0">Pantau perkembangan status pengadaan barang dan logistik proyek Anda.</h6>
      </div>
      <div class="mt-3 mt-md-0">
        <a href="{{ route('pelanggan.order') }}" class="btn btn-primary btn-round">
          <i class="fa fa-plus me-1"></i> Pesan Barang Baru
        </a>
      </div>
    </div>

    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    <div class="card card-round">
      <div class="card-header">
        <h4 class="card-title"><i class="fas fa-history text-primary me-2"></i> Daftar Riwayat Transaksi</h4>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="thead-light">
              <tr>
                <th class="ps-4">No. Pesanan</th>
                <th>Tanggal</th>
                <th>Barang Dipesan</th>
                <th>Total Biaya</th>
                <th>Status</th>
                <th class="text-center pe-4">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($pesanan as $order)
                <tr>
                  <td class="ps-4 fw-bold text-primary">{{ $order->kode_pesanan }}</td>
                  <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                  <td>
                    @foreach($order->details as $d)
                      <div>{{ $d->nama_barang }} <strong>x{{ $d->jumlah }}</strong></div>
                    @endforeach
                  </td>
                  <td class="fw-semibold">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                  <td>
                    <span class="badge rounded-pill px-3 py-2 badge-{{ $order->status }}">
                      {{ ucfirst($order->status) }}
                    </span>
                  </td>
                  <td class="text-center pe-4">
                    <a href="{{ route('pelanggan.pesanan.detail', $order->id) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                      <i class="fa fa-eye me-1"></i> Rincian
                    </a>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center py-5 text-muted">
                    <i class="fas fa-box-open fa-3x mb-3 text-secondary d-block"></i>
                    Belum ada riwayat pesanan. <a href="{{ route('pelanggan.order') }}">Mulai pesan barang</a>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer py-3">
        {{ $pesanan->links() }}
      </div>
    </div>

  </div>
</div>
@endsection
