<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Identitas perusahaan
            'nama_perusahaan'  => 'Sifabrik',
            'tagline'          => 'Sistem Informasi Gudang Fabrikasi',
            'deskripsi'        => 'Platform digital untuk manajemen gudang dan fabrikasi secara terintegrasi, mudah, dan efisien.',
            'alamat'           => 'Jl. Industri Raya No. 1, Indonesia',
            'telepon'          => '(021) 1234-5678',
            'email'            => 'info@sifabrik.test',
            'logo'             => '',

            // Hero section
            'hero_judul'       => 'Kelola Gudang Fabrikasi Lebih Mudah',
            'hero_subjudul'    => 'Sistem informasi terpadu untuk manajemen stok, penjualan, dan laporan pabrik Anda.',
            'hero_foto'        => '',

            // Tentang Kami
            'tentang_konten'   => 'Sifabrik adalah platform sistem informasi gudang yang dirancang khusus untuk industri fabrikasi. Kami membantu pabrik mengelola stok barang, transaksi, supplier, dan laporan dengan lebih efisien dan terorganisir.',
            'tentang_visi'     => 'Menjadi platform manajemen gudang terdepan yang membantu setiap pabrik berkembang dengan teknologi digital.',
            'tentang_misi'     => 'Menyediakan solusi sistem informasi yang mudah digunakan, andal, dan terjangkau untuk industri fabrikasi Indonesia.',
            'tentang_foto'     => '',

            // Kontak
            'maps_embed'       => '',
            'instagram'        => '',
            'facebook'         => '',
            'whatsapp'         => '',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::set($key, $value);
        }
    }
}

