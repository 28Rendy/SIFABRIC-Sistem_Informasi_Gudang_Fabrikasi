<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ContentDummySeeder extends Seeder
{
    private function buatGambar(string $relativePath, int $w, int $h, string $bgColorHex, string $title, string $subtitle = '')
    {
        $fullPath = storage_path('app/public/' . $relativePath);
        $dir = dirname($fullPath);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $img = imagecreatetruecolor($w, $h);

        // Convert hex to rgb
        $hex = ltrim($bgColorHex, '#');
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));

        $bgColor = imagecolorallocate($img, $r, $g, $b);
        imagefill($img, 0, 0, $bgColor);

        // Grid/industrial accent pattern
        $gridColor = imagecolorallocatealpha($img, 255, 255, 255, 115);
        for ($x = 0; $x < $w; $x += 40) {
            imageline($img, $x, 0, $x, $h, $gridColor);
        }
        for ($y = 0; $y < $h; $y += 40) {
            imageline($img, 0, $y, $w, $y, $gridColor);
        }

        // Industrial frame
        $frameColor = imagecolorallocatealpha($img, 255, 255, 255, 80);
        imagesetthickness($img, 4);
        imagerectangle($img, 20, 20, $w - 20, $h - 20, $frameColor);

        // Text
        $textColor = imagecolorallocate($img, 255, 255, 255);
        $subColor = imagecolorallocate($img, 220, 230, 245);

        // Center simple title text
        $font = 5; // Built-in font size
        $charW = imagefontwidth($font);
        $charH = imagefontheight($font);

        $textX = max(30, (int)(($w - (strlen($title) * $charW)) / 2));
        $textY = (int)(($h / 2) - $charH);
        imagestring($img, $font, $textX, $textY, $title, $textColor);

        if ($subtitle) {
            $fontSub = 4;
            $charWSub = imagefontwidth($fontSub);
            $subX = max(30, (int)(($w - (strlen($subtitle) * $charWSub)) / 2));
            imagestring($img, $fontSub, $subX, $textY + 30, $subtitle, $subColor);
        }

        imagejpeg($img, $fullPath, 90);
        imagedestroy($img);

        return $relativePath;
    }

    public function run(): void
    {
        // 1. Gambar Banner Hero & Profil Pabrik
        $heroFoto = $this->buatGambar('site/hero_fabrication.jpg', 1200, 600, '#102a56', 'SIFABRIC INDO INDUSTRI', 'Modern Fabrication Warehouse & Steel Logistics');
        $tentangFoto = $this->buatGambar('site/about_facility.jpg', 1000, 600, '#1e3a8a', 'FASILITAS PABRIK & GUDANG', 'Kapasitas 10.000+ Ton & Peralatan Presisi CNC');

        DB::table('site_settings')->updateOrInsert(['key' => 'hero_foto'], ['value' => $heroFoto]);
        DB::table('site_settings')->updateOrInsert(['key' => 'tentang_foto'], ['value' => $tentangFoto]);

        // 2. Data Galeri Foto Pabrik & Fabrikasi
        DB::table('galeri')->truncate();
        $galeriItems = [
            [
                'judul'     => 'Mesin CNC Cutting Plasma Presisi',
                'deskripsi' => 'Fasilitas pemotongan plat baja dengan toleransi tinggi dan kecepatan potong optimal.',
                'file'      => 'galeri/cnc_cutting.jpg',
                'color'     => '#0f172a',
                'urutan'    => 1,
            ],
            [
                'judul'     => 'Area Pengelasan Rangka Konstruksi',
                'deskripsi' => 'Pengelasan berstandar AWS untuk girder jembatan dan struktur pabrik berat.',
                'file'      => 'galeri/welding_station.jpg',
                'color'     => '#1e293b',
                'urutan'    => 2,
            ],
            [
                'judul'     => 'Gudang Penyimpanan Pipa & Hollow',
                'deskripsi' => 'Sistem racking bertingkat dengan penataan material galvanis siap distribusi.',
                'file'      => 'galeri/pipe_storage.jpg',
                'color'     => '#1e3a8a',
                'urutan'    => 3,
            ],
            [
                'judul'     => 'Line Finishing Sandblasting & Epoxy',
                'deskripsi' => 'Proses pelapisan anti karat berkualitas tinggi untuk ketahanan korosi maksimal.',
                'file'      => 'galeri/sandblasting_epoxy.jpg',
                'color'     => '#0369a1',
                'urutan'    => 4,
            ],
            [
                'judul'     => 'Overhead Crane Kapasitas 15 Ton',
                'deskripsi' => 'Armada crane modern untuk pemindahan material berat dengan aman dan efisien.',
                'file'      => 'galeri/overhead_crane.jpg',
                'color'     => '#1d4ed8',
                'urutan'    => 5,
            ],
            [
                'judul'     => 'Quality Inspection & Pengujian Material',
                'deskripsi' => 'Uji ketebalan ultrasonik dan uji beban sebelum pengiriman ke lokasi pelanggan.',
                'file'      => 'galeri/quality_inspection.jpg',
                'color'     => '#334155',
                'urutan'    => 6,
            ],
        ];

        foreach ($galeriItems as $item) {
            $path = $this->buatGambar($item['file'], 800, 500, $item['color'], strtoupper($item['judul']), 'SIFABRIC WORKSHOP');
            DB::table('galeri')->insert([
                'judul'      => $item['judul'],
                'deskripsi'  => $item['deskripsi'],
                'foto'       => $path,
                'urutan'     => $item['urutan'],
                'aktif'      => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 3. Data Artikel & Berita Seputar Fabrikasi & Pergudangan
        DB::table('artikel')->truncate();
        $artikelItems = [
            [
                'judul'     => 'Standar Mutu Pengelasan Baja Fabrikasi pada Konstruksi Industri Berat',
                'ringkasan' => 'Pelajari kriteria pengelasan berstandar internasional untuk memastikan keamanan struktur baja dalam jangka panjang.',
                'konten'    => '<p>Dalam industri fabrikasi baja, kualitas pengelasan memegang peranan krusial terhadap integritas struktural suatu bangunan atau fasilitas industri. Kegagalan sambungan las dapat menimbulkan risiko fatal terhadap keselamatan operasional kerja.</p><h4>1. Pemilihan Material Elektroda</h4><p>Material elektroda harus disesuaikan dengan jenis plat dan pipa yang disambung. Untuk baja struktural karbon, penggunaan kawat las dengan sertifikasi AWS merupakan standar mutlak.</p><h4>2. Pemeriksaan Non-Destructive Testing (NDT)</h4><p>Setiap hasil sambungan utama pada fasilitas kami melalui uji NDT (Ultrasonic Test & Magnetic Particle Test) guna memastikan tidak terdapat cacat internal seperti porosity atau crack.</p>',
                'file'      => 'artikel/pengelasan_standar.jpg',
                'color'     => '#1e3a8a',
            ],
            [
                'judul'     => 'Strategi Manajemen FIFO & Stok Minimum di Gudang Logistik Pabrik',
                'ringkasan' => 'Bagaimana sistem digital SIFABRIC membantu mengontrol arus keluar masuk material bahan baku tanpa risiko kehabisan stok.',
                'konten'    => '<p>Manajemen gudang fabrikasi sering kali menghadapi kendala material terselip atau bahan baku kadaluarsa karena penataan yang kurang terstruktur. Penerapan metode First-In, First-Out (FIFO) yang diintegrasikan dengan sistem digital pergudangan adalah kunci efisiensi pabrik modern.</p><p>Dengan modul batas stok minimum, sistem akan otomatis memberi peringatan dini sebelum pasokan kawat las, plat, maupun baut habis terpakai di lini perakitan.</p>',
                'file'      => 'artikel/manajemen_fifo.jpg',
                'color'     => '#0f766e',
            ],
            [
                'judul'     => 'Keunggulan Lapisan Epoxy Primer pada Ketahanan Korosi Baja Fabrikasi',
                'ringkasan' => 'Mengenal proses sandblasting SA 2.5 dan pelapisan cat epoxy sebagai proteksi optimal dari cuaca ekstrem.',
                'konten'    => '<p>Korosi adalah musuh utama dari komponen baja terbuka. Di fasilitas kami, setiap material fabrikasi yang telah selesai dirakit akan melewati proses pembersihan sandblasting hingga standar kebersihan SA 2.5.</p><p>Setelah itu, primer epoxy dua komponen diaplikasikan secara merata untuk mengunci pori-pori baja dari kelembaban udara dan bahan kimia korosif di lingkungan pabrik.</p>',
                'file'      => 'artikel/epoxy_primer.jpg',
                'color'     => '#0369a1',
            ],
        ];

        foreach ($artikelItems as $art) {
            $path = $this->buatGambar($art['file'], 900, 500, $art['color'], Str::limit(strtoupper($art['judul']), 35), 'SIFABRIC TECH ARTICLE');
            DB::table('artikel')->insert([
                'judul'        => $art['judul'],
                'slug'         => Str::slug($art['judul']),
                'ringkasan'    => $art['ringkasan'],
                'konten'       => $art['konten'],
                'gambar'       => $path,
                'penulis'      => 'Engineering Tim Sifabrik',
                'aktif'        => 1,
                'published_at' => now(),
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }
}
