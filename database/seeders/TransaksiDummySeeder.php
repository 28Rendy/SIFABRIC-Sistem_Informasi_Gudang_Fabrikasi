<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\DetailPenjualan;
use App\Models\DetailPesanan;
use App\Models\Penjualan;
use App\Models\Pesanan;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransaksiDummySeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();
        $kasir = User::where('role', 'kasir')->first();
        $pelanggan = User::where('role', 'pelanggan')->first();

        if (!$pelanggan) {
            $pelanggan = User::create([
                'name'     => 'PT Konstruksi Mega Baja',
                'email'    => 'mitra@megabaja.co.id',
                'password' => bcrypt('password'),
                'role'     => 'pelanggan',
            ]);
        }

        $barangList = Barang::all();
        $supplierList = Supplier::all();

        if ($barangList->isEmpty() || $supplierList->isEmpty()) {
            return;
        }

        // ==========================================
        // 1. DUMMY TRANSAKSI BARANG MASUK (LOGISTIK GUDANG)
        // ==========================================
        DB::table('barang_masuk')->truncate();
        $barangMasukData = [];
        $bulanSekarang = date('Y-m');

        foreach ($barangList->take(6) as $index => $b) {
            $supplier = $supplierList[$index % $supplierList->count()];
            $tanggal = date('Y-m-d H:i:s', strtotime("-{$index} days"));

            $barangMasukData[] = [
                'kode_transaksi' => 'TRX-IN-' . date('Ymd', strtotime($tanggal)) . '-' . sprintf('%03d', $index + 1),
                'kode_barang'    => $b->kode_barang,
                'nama_barang'    => $b->nama_barang,
                'id_kategori'    => $b->kategori_id,
                'stok_masuk'     => 50 + ($index * 15),
                'harga_beli'     => $b->harga_beli,
                'tanggal_masuk'  => $tanggal,
                'supplier_id'    => $supplier->id,
                'user_id'        => $admin->id ?? 1,
                'created_at'     => $tanggal,
                'updated_at'     => $tanggal,
            ];
        }

        DB::table('barang_masuk')->insert($barangMasukData);

        // ==========================================
        // 2. DUMMY TRANSAKSI PENJUALAN OFFLINE / KASIR
        // ==========================================
        DB::table('detail_penjualan')->truncate();
        DB::table('penjualan')->truncate();

        // Buat 8 transaksi penjualan tersebar dalam tahun berjalan
        $tahun = date('Y');
        for ($m = 1; $m <= 6; $m++) {
            $tgl = sprintf('%s-%02d-15 10:30:00', $tahun, $m);
            $item1 = $barangList[$m % $barangList->count()];
            $item2 = $barangList[($m + 2) % $barangList->count()];

            $qty1 = rand(2, 5);
            $qty2 = rand(1, 3);
            $sub1 = ($item1->harga_jual ?? $item1->harga_beli) * $qty1;
            $sub2 = ($item2->harga_jual ?? $item2->harga_beli) * $qty2;
            $total = $sub1 + $sub2;

            $penjualan = Penjualan::create([
                'tanggal'   => $tgl,
                'total'     => $total,
                'bayar'     => $total + 50000,
                'kembalian' => 50000,
                'kasir_id'  => $kasir->id ?? 2,
            ]);

            DetailPenjualan::create([
                'penjualan_id' => $penjualan->id,
                'barang_id'    => $item1->id,
                'nama_barang'  => $item1->nama_barang,
                'harga'        => $item1->harga_jual ?? $item1->harga_beli,
                'jumlah'       => $qty1,
                'subtotal'     => $sub1,
            ]);

            DetailPenjualan::create([
                'penjualan_id' => $penjualan->id,
                'barang_id'    => $item2->id,
                'nama_barang'  => $item2->nama_barang,
                'harga'        => $item2->harga_jual ?? $item2->harga_beli,
                'jumlah'       => $qty2,
                'subtotal'     => $sub2,
            ]);
        }

        // ==========================================
        // 3. DUMMY PESANAN ONLINE DARI PELANGGAN WEB
        // ==========================================
        DB::table('detail_pesanan')->truncate();
        DB::table('pesanan')->truncate();

        $statuses = ['menunggu', 'diproses', 'dikirim', 'selesai'];
        foreach ($statuses as $idx => $st) {
            $b = $barangList[$idx % $barangList->count()];
            $harga = $b->harga_jual ?? $b->harga_beli;
            $qty = ($idx + 1) * 3;
            $tot = $harga * $qty;

            $pesanan = Pesanan::create([
                'kode_pesanan'      => 'ORD-' . date('Ymd') . '-00' . ($idx + 1),
                'user_id'           => $pelanggan->id,
                'nama_pemesan'      => $pelanggan->name,
                'no_hp'             => '08129988770' . $idx,
                'alamat_pengiriman' => 'Kawasan Industri Jababeka Tahap V Blok B-' . ($idx + 10) . ', Cikarang, Jawa Barat',
                'catatan'           => 'Mohon sertakan sertifikat uji bahan (Mill Certificate) dan jadwal pengiriman pagi hari.',
                'total_harga'       => $tot,
                'status'            => $st,
                'created_at'        => now()->subDays(5 - $idx),
            ]);

            DetailPesanan::create([
                'pesanan_id'  => $pesanan->id,
                'barang_id'   => $b->id,
                'nama_barang' => $b->nama_barang,
                'harga'       => $harga,
                'jumlah'      => $qty,
                'subtotal'    => $tot,
            ]);
        }
    }
}
