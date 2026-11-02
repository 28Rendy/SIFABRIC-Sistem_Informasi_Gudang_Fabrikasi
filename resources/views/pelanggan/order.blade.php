@extends('pelanggan.layout')

@section('title', 'Buat Pesanan Barang')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card card-custom p-4">
            <h4 class="fw-bold mb-1 text-primary"><i class="fa fa-shopping-cart me-2"></i> Form Pemesanan Barang Fabrikasi</h4>
            <p class="text-muted small mb-4">Silakan pilih barang dan lengkapi rincian pengiriman untuk pesanan Anda.</p>

            <form action="{{ route('pelanggan.order.submit') }}" method="POST">
                @csrf

                <!-- Pilih Barang -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Pilih Barang Fabrikasi / Material <span class="text-danger">*</span></label>
                    <select name="barang_id" id="barang_id" class="form-select form-select-lg" required>
                        <option value="">-- Pilih Barang --</option>
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

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Jumlah Pesanan <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="number" name="jumlah" id="jumlah" min="1" class="form-control" value="{{ old('jumlah', 1) }}" required>
                            <span class="input-group-text" id="satuan-label">Unit</span>
                        </div>
                        <small class="text-muted" id="info-stok"></small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Estimasi Total Biaya</label>
                        <div class="form-control bg-light fw-bold text-primary fs-5" id="total-display">Rp 0</div>
                    </div>
                </div>

                <hr class="my-4">

                <h5 class="fw-bold mb-3 text-dark"><i class="fa fa-truck me-2"></i> Rincian Pengiriman & Pemesan</h5>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nama Pemesan / PIC <span class="text-danger">*</span></label>
                        <input type="text" name="nama_pemesan" class="form-control" value="{{ old('nama_pemesan', $user->name) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nomor WhatsApp / HP Aktif <span class="text-danger">*</span></label>
                        <input type="text" name="no_hp" class="form-control" placeholder="Contoh: 08123456789" value="{{ old('no_hp') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Alamat Lengkap Pengiriman Pabrik/Proyek <span class="text-danger">*</span></label>
                    <textarea name="alamat_pengiriman" class="form-control" rows="3" placeholder="Nama jalan, nomor gedung/gudang, kota, patokan..." required>{{ old('alamat_pengiriman') }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Catatan Kebutuhan Khusus / Spesifikasi Fabrikasi (Opsional)</label>
                    <textarea name="catatan" class="form-control" rows="2" placeholder="Contoh: Butuh pemotongan ukuran khusus, jadwal kirim hari Rabu...">{{ old('catatan') }}</textarea>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('pelanggan.dashboard') }}" class="btn btn-outline-secondary px-4 rounded-pill">Batal</a>
                    <button type="submit" class="btn btn-primary px-5 py-2 fw-semibold rounded-pill">
                        <i class="fa fa-paper-plane me-1"></i> Kirim Pesanan Sekarang
                    </button>
                </div>
            </form>
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
            infoStok.innerText = 'Stok saat ini: ' + stok + ' ' + satuan;

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
    hitungTotal();
</script>
@endsection

