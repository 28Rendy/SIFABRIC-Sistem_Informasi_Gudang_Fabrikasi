@extends('layout.main')

@section('content')
<div class="container">
  <div class="page-inner">

    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
      <div>
        <h3 class="fw-bold mb-1">Buat Pesanan Barang Baru</h3>
        <h6 class="op-7 mb-0">Pilih barang fabrikasi/material dan lengkapi rincian pengiriman ke proyek/pabrik Anda.</h6>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="card card-round">
          <div class="card-header">
            <h4 class="card-title"><i class="fas fa-shopping-cart text-primary me-2"></i> Formulir Pemesanan Barang</h4>
          </div>
          <div class="card-body">
            @if(session('error'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              </div>
            @endif

            <form action="{{ route('pelanggan.order.submit') }}" method="POST">
              @csrf

              <!-- Pilih Barang -->
              <div class="form-group mb-3">
                <label class="form-label fw-bold">Pilih Barang Fabrikasi / Material <span class="text-danger">*</span></label>
                <select name="barang_id" id="barang_id" class="form-select form-select-lg" required>
                  <option value="">-- Pilih Barang dari Gudang --</option>
                  @foreach($barangList as $b)
                    @php
                      $harga = $b->harga_jual ?? $b->harga_beli;
                    @endphp
                    <option value="{{ $b->id }}" 
                            data-harga="{{ $harga }}" 
                            data-satuan="{{ $b->satuan }}" 
                            data-stok="{{ $b->stok }}"
                            {{ (old('barang_id', $selectedBarang->id ?? '') == $b->id) ? 'selected' : '' }}>
                      {{ $b->nama_barang }} (Kode: {{ $b->kode_barang }}) - Rp {{ number_format($harga, 0, ',', '.') }}/{{ $b->satuan }} [Stok: {{ $b->stok }}]
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="row mb-3">
                <div class="col-md-6 form-group">
                  <label class="form-label fw-bold">Jumlah Pesanan <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <input type="number" name="jumlah" id="jumlah" min="1" class="form-control" value="{{ old('jumlah', 1) }}" required>
                    <span class="input-group-text" id="satuan-label">Unit</span>
                  </div>
                  <small class="form-text text-muted" id="info-stok"></small>
                </div>
                <div class="col-md-6 form-group">
                  <label class="form-label fw-bold">Estimasi Total Biaya</label>
                  <div class="form-control bg-light fw-bold text-primary fs-5" id="total-display">Rp 0</div>
                </div>
              </div>

              <hr class="my-4">

              <h5 class="fw-bold mb-3 text-dark"><i class="fas fa-truck text-info me-2"></i> Rincian Pengiriman & Pemesan</h5>

              <div class="row mb-3">
                <div class="col-md-6 form-group">
                  <label class="form-label fw-bold">Nama Pemesan / PIC <span class="text-danger">*</span></label>
                  <input type="text" name="nama_pemesan" class="form-control" value="{{ old('nama_pemesan', $user->name) }}" required>
                </div>
                <div class="col-md-6 form-group">
                  <label class="form-label fw-bold">Nomor WhatsApp / HP Aktif <span class="text-danger">*</span></label>
                  <input type="text" name="no_hp" class="form-control" placeholder="Contoh: 08123456789" value="{{ old('no_hp') }}" required>
                </div>
              </div>

              <div class="form-group mb-3">
                <label class="form-label fw-bold">Alamat Lengkap Pengiriman Pabrik/Proyek <span class="text-danger">*</span></label>
                <textarea name="alamat_pengiriman" class="form-control" rows="3" placeholder="Nama jalan, nomor gedung/gudang, kota, patokan..." required>{{ old('alamat_pengiriman') }}</textarea>
              </div>

              <div class="form-group mb-4">
                <label class="form-label fw-bold">Catatan Kebutuhan Khusus / Spesifikasi Fabrikasi (Opsional)</label>
                <textarea name="catatan" class="form-control" rows="2" placeholder="Contoh: Butuh pemotongan ukuran khusus, jadwal kirim hari kerja pagi...">{{ old('catatan') }}</textarea>
              </div>

              <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                <a href="{{ route('pelanggan.dashboard') }}" class="btn btn-outline-secondary btn-round px-4">Batal</a>
                <button type="submit" class="btn btn-primary btn-round px-5 py-2 fw-semibold">
                  <i class="fas fa-paper-plane me-1"></i> Kirim Pesanan Sekarang
                </button>
              </div>
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
  function hitungTotal() {
    const select = document.getElementById('barang_id');
    const jumlahInput = document.getElementById('jumlah');
    const totalDisplay = document.getElementById('total-display');
    const satuanLabel = document.getElementById('satuan-label');
    const infoStok = document.getElementById('info-stok');

    const selectedOption = select.options[select.selectedIndex];
    if (selectedOption && selectedOption.value) {
      const harga = parseInt(selectedOption.getAttribute('data-harga')) || 0;
      const satuan = selectedOption.getAttribute('data-satuan') || 'Unit';
      const stok = parseInt(selectedOption.getAttribute('data-stok')) || 0;
      const jumlah = parseInt(jumlahInput.value) || 0;

      satuanLabel.innerText = satuan;
      infoStok.innerText = 'Stok tersedia: ' + stok + ' ' + satuan;

      if (jumlah > stok) {
        infoStok.innerHTML = '<span class="text-danger fw-bold"><i class="fa fa-exclamation-triangle"></i> Jumlah melebihi stok yang tersedia (' + stok + ' ' + satuan + ')</span>';
      }

      const total = harga * jumlah;
      totalDisplay.innerText = 'Rp ' + total.toLocaleString('id-ID');
    } else {
      satuanLabel.innerText = 'Unit';
      infoStok.innerText = '';
      totalDisplay.innerText = 'Rp 0';
    }
  }

  document.getElementById('barang_id').addEventListener('change', hitungTotal);
  document.getElementById('jumlah').addEventListener('input', hitungTotal);
  document.addEventListener('DOMContentLoaded', hitungTotal);
</script>
@endsection
