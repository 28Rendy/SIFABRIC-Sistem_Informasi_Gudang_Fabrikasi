<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            ['nama_kategori' => 'Bahan Baku'],
            ['nama_kategori' => 'Bahan Penolong'],
            ['nama_kategori' => 'Barang Setengah Jadi'],
            ['nama_kategori' => 'Barang Jadi'],
            ['nama_kategori' => 'Suku Cadang'],
            ['nama_kategori' => 'Alat & Mesin'],
        ];

        DB::table('kategori')->insert($kategori);
    }
}

