<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $barang = [
            // Bahan Baku (kategori_id: 1)
            ['kode_barang' => 'BB-001', 'nama_barang' => 'Plat Besi 2mm',         'id_kategori' => 1, 'satuan' => 'Lembar', 'stok' => 50,  'harga_beli' => 85000,  'harga_jual' => 100000],
            ['kode_barang' => 'BB-002', 'nama_barang' => 'Pipa Galvanis 1 Inch',  'id_kategori' => 1, 'satuan' => 'Batang', 'stok' => 80,  'harga_beli' => 55000,  'harga_jual' => 70000],
            ['kode_barang' => 'BB-003', 'nama_barang' => 'Besi Hollow 4x4',       'id_kategori' => 1, 'satuan' => 'Batang', 'stok' => 60,  'harga_beli' => 75000,  'harga_jual' => 90000],

            // Bahan Penolong (kategori_id: 2)
            ['kode_barang' => 'BP-001', 'nama_barang' => 'Cat Epoxy Abu-abu',     'id_kategori' => 2, 'satuan' => 'Kaleng', 'stok' => 30,  'harga_beli' => 120000, 'harga_jual' => 150000],
            ['kode_barang' => 'BP-002', 'nama_barang' => 'Kawat Las RB 26',       'id_kategori' => 2, 'satuan' => 'Kg',     'stok' => 25,  'harga_beli' => 35000,  'harga_jual' => 45000],
            ['kode_barang' => 'BP-003', 'nama_barang' => 'Thinner A Special',     'id_kategori' => 2, 'satuan' => 'Liter',  'stok' => 40,  'harga_beli' => 25000,  'harga_jual' => 35000],

            // Barang Setengah Jadi (kategori_id: 3)
            ['kode_barang' => 'BSJ-001','nama_barang' => 'Rangka Meja Setengah Jadi', 'id_kategori' => 3, 'satuan' => 'Unit', 'stok' => 15, 'harga_beli' => 250000, 'harga_jual' => 320000],
            ['kode_barang' => 'BSJ-002','nama_barang' => 'Panel Dinding Pra-cetak', 'id_kategori' => 3, 'satuan' => 'Unit',  'stok' => 20, 'harga_beli' => 180000, 'harga_jual' => 230000],

            // Barang Jadi (kategori_id: 4)
            ['kode_barang' => 'BJ-001', 'nama_barang' => 'Rak Besi 5 Tingkat',   'id_kategori' => 4, 'satuan' => 'Unit',  'stok' => 10,  'harga_beli' => 750000, 'harga_jual' => 950000],
            ['kode_barang' => 'BJ-002', 'nama_barang' => 'Meja Kerja Besi',       'id_kategori' => 4, 'satuan' => 'Unit',  'stok' => 8,   'harga_beli' => 600000, 'harga_jual' => 800000],
            ['kode_barang' => 'BJ-003', 'nama_barang' => 'Loker 4 Pintu',         'id_kategori' => 4, 'satuan' => 'Unit',  'stok' => 5,   'harga_beli' => 900000, 'harga_jual' => 1200000],

            // Suku Cadang (kategori_id: 5)
            ['kode_barang' => 'SK-001', 'nama_barang' => 'Baut M10 x 30mm',       'id_kategori' => 5, 'satuan' => 'Pcs',   'stok' => 500, 'harga_beli' => 500,    'harga_jual' => 800],
            ['kode_barang' => 'SK-002', 'nama_barang' => 'Mur M10',               'id_kategori' => 5, 'satuan' => 'Pcs',   'stok' => 500, 'harga_beli' => 400,    'harga_jual' => 650],

            // Alat & Mesin (kategori_id: 6)
            ['kode_barang' => 'AM-001', 'nama_barang' => 'Gerinda Tangan 4 Inch', 'id_kategori' => 6, 'satuan' => 'Unit',  'stok' => 4,   'harga_beli' => 350000, 'harga_jual' => 450000],
            ['kode_barang' => 'AM-002', 'nama_barang' => 'Bor Listrik 10mm',      'id_kategori' => 6, 'satuan' => 'Unit',  'stok' => 3,   'harga_beli' => 280000, 'harga_jual' => 380000],
        ];

        $now = now();
        foreach ($barang as &$item) {
            $item['created_at'] = $now;
            $item['updated_at'] = $now;
        }

        DB::table('barang')->insert($barang);
    }
}

