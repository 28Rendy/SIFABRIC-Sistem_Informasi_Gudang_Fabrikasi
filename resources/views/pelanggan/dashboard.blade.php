@extends('layout.main')

@section('content')
<div class="container">
  <div class="page-inner">

    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4 justify-content-between">
      <div>
        <h3 class="fw-bold mb-1">Dashboard Pelanggan</h3>
        <h6 class="op-7 mb-0">Selamat datang kembali, <strong>{{ $user->name }}</strong>! Pantau status pesanan fabrikasi Anda secara real-time.</h6>
      </div>
      <div class="mt-3 mt-md-0">
        <a href="{{ route('pelanggan.order') }}" class="btn btn-primary btn-round">
          <i class="fa fa-plus me-1"></i> Buat Pesanan Baru
        </a>
      </div>
    </div>

    <!-- Ringkasan Statistik -->
    <div class="row">
      <!-- Total Pesanan -->
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-primary bubble-shadow-small">
                  <i class="fas fa-shopping-bag"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Total Pesanan</p>
                  <h4 class="card-title">{{ $totalPesanan }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Menunggu Konfirmasi -->
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-warning bubble-shadow-small">
                  <i class="fas fa-clock"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Menunggu</p>
                  <h4 class="card-title">{{ $menunggu }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Sedang Diproses/Kirim -->
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-info bubble-shadow-small">
                  <i class="fas fa-truck-loading"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Diproses / Dikirim</p>
                  <h4 class="card-title">{{ $diproses }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Selesai -->
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-success bubble-shadow-small">
                  <i class="fas fa-check-circle"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Pesanan Selesai</p>
                  <h4 class="card-title">{{ $selesai }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- 5 Pesanan Terakhir -->
    <div class="row">
      <div class="col-md-12">
        <div class="card card-round">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">5 Pesanan Terakhir</h4>
            <a href="{{ route('pelanggan.riwayat') }}" class="btn btn-sm btn-outline-primary btn-round">
              Lihat Semua Riwayat
            </a>
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
                          <i class="fa fa-eye me-1"></i> Rincian
                        </a>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="6" class="text-center py-4 text-muted">
                        Belum ada pesanan aktif. <a href="{{ route('pelanggan.order') }}">Buat pesanan sekarang</a>.
                      </td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection
