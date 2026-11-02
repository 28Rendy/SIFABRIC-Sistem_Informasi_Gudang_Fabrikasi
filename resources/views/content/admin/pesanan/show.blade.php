@extends('layout.main')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header d-flex justify-content-between align-items-center">
            <div>
                <a href="{{ route('admin.pesanan.index') }}" class="btn btn-outline-secondary btn-sm mb-2">
                    <i class="fa fa-arrow-left me-1"></i> Kembali ke Daftar
                </a>
                <h3 class="fw-bold m-0">Detail Pesanan: {{ $pesanan->kode_pesanan }}</h3>
            </div>
            <div>
                <span class="badge fs-6 px-3 py-2 
                    @if($pesanan->status == 'menunggu') bg-warning text-dark
                    @elseif($pesanan->status == 'diproses') bg-info
                    @elseif($pesanan->status == 'dikirim') bg-secondary
                    @elseif($pesanan->status == 'selesai') bg-success
                    @else bg-danger @endif">
                    Status: {{ strtoupper($pesanan->status) }}
                </span>
            </div>
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

        <div class="row">
            <!-- Informasi Pesanan & Pemesan -->
            <div class="col-md-7">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="card-title"><i class="fa fa-info-circle me-2"></i> Data Pemesan</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <th style="width: 180px;">Nama Pemesan</th>
                                <td>: {{ $pesanan->nama_pemesan }}</td>
                            </tr>
                            <tr>
                                <th>Akun Terdaftar</th>
                                <td>: {{ $pesanan->user->name }} ({{ $pesanan->user->email }})</td>
                            </tr>
                            <tr>
                                <th>No. Handphone/WA</th>
                                <td>: <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $pesanan->no_hp) }}" target="_blank" class="fw-bold">{{ $pesanan->no_hp }} <i class="fab fa-whatsapp text-success ms-1"></i></a></td>
                            </tr>
                            <tr>
                                <th>Alamat Pengiriman</th>
                                <td>: {{ $pesanan->alamat_pengiriman }}</td>
                            </tr>
                            <tr>
                                <th>Catatan Pemesan</th>
                                <td>: <em class="text-muted">{{ $pesanan->catatan ?: '-' }}</em></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i class="fa fa-boxes me-2"></i> Rincian Barang Dipesan</h4>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Barang</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-end">Harga Satuan</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pesanan->details as $item)
                                    <tr>
                                        <td>
                                            <div class="fw-bold">{{ $item->nama_barang }}</div>
                                            <small class="text-muted">Stok Gudang: {{ $item->barang->stok ?? 0 }} {{ $item->barang->satuan ?? 'Unit' }}</small>
                                        </td>
                                        <td class="text-center">{{ $item->jumlah }}</td>
                                        <td class="text-end">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                        <td class="text-end fw-bold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-end">Total Pembayaran:</th>
                                    <th class="text-end text-primary fs-5">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Panel Ubah Status -->
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i class="fa fa-tasks me-2"></i> Proses Status Pesanan</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.pesanan.updateStatus', $pesanan->id) }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="fw-bold">Ubah Status Menjadi:</label>
                                <select name="status" class="form-select" id="statusSelect" required>
                                    <option value="menunggu" {{ $pesanan->status == 'menunggu' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                                    <option value="diproses" {{ $pesanan->status == 'diproses' ? 'selected' : '' }}>Diproses (Potong Stok Gudang)</option>
                                    <option value="dikirim" {{ $pesanan->status == 'dikirim' ? 'selected' : '' }}>Sedang Dikirim</option>
                                    <option value="selesai" {{ $pesanan->status == 'selesai' ? 'selected' : '' }}>Selesai (Masuk Laporan Penjualan)</option>
                                    <option value="dibatalkan" {{ $pesanan->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                </select>
                            </div>

                            <div class="form-group mb-3" id="batalArea" style="{{ $pesanan->status == 'dibatalkan' ? '' : 'display:none;' }}">
                                <label class="fw-bold">Alasan Pembatalan:</label>
                                <textarea name="alasan_batal" class="form-control" rows="2" placeholder="Tulis alasan jika dibatalkan...">{{ $pesanan->alasan_batal }}</textarea>
                            </div>

                            <div class="alert alert-info py-2 small mb-3">
                                <i class="fa fa-info-circle me-1"></i>
                                Memilih status <strong>Diproses</strong> akan otomatis memotong stok barang di gudang. Memilih status <strong>Selesai</strong> otomatis mencatatnya ke laporan penjualan & grafik tahunan.
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fa fa-save me-1"></i> Simpan Status Baru
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('statusSelect').addEventListener('change', function () {
        const batalArea = document.getElementById('batalArea');
        if (this.value === 'dibatalkan') {
            batalArea.style.display = 'block';
        } else {
            batalArea.style.display = 'none';
        }
    });
</script>
@endsection

