<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Barang;
use App\Models\Galeri;
use App\Models\SiteSetting;

class FrontendController extends Controller
{
    private function settings(): array
    {
        return [
            'site' => [
                'nama'      => SiteSetting::get('nama_perusahaan', 'Sifabrik'),
                'tagline'   => SiteSetting::get('tagline', 'Sistem Informasi Gudang Fabrikasi'),
                'logo'      => SiteSetting::get('logo'),
                'telepon'   => SiteSetting::get('telepon'),
                'email'     => SiteSetting::get('email'),
                'alamat'    => SiteSetting::get('alamat'),
                'instagram' => SiteSetting::get('instagram'),
                'facebook'  => SiteSetting::get('facebook'),
                'whatsapp'  => SiteSetting::get('whatsapp'),
            ],
        ];
    }

    public function home()
    {
        $data = $this->settings();
        $data['hero_judul']   = SiteSetting::get('hero_judul', 'Kelola Gudang Fabrikasi Lebih Mudah');
        $data['hero_subjudul'] = SiteSetting::get('hero_subjudul');
        $data['hero_foto']    = SiteSetting::get('hero_foto');
        $data['galeri']       = Galeri::where('aktif', true)->orderBy('urutan')->take(6)->get();
        $data['artikel']      = Artikel::where('aktif', true)->latest('published_at')->take(3)->get();
        $data['total_barang'] = Barang::count();
        return view('frontend.home', $data);
    }

    public function katalog()
    {
        $data = $this->settings();
        $data['barang'] = Barang::with('kategori')->where('stok', '>', 0)->orderBy('nama_barang')->paginate(12);
        return view('frontend.katalog', $data);
    }

    public function tentangKami()
    {
        $data = $this->settings();
        $data['tentang_konten'] = SiteSetting::get('tentang_konten');
        $data['tentang_visi']   = SiteSetting::get('tentang_visi');
        $data['tentang_misi']   = SiteSetting::get('tentang_misi');
        $data['tentang_foto']   = SiteSetting::get('tentang_foto');
        return view('frontend.tentang-kami', $data);
    }

    public function galeri()
    {
        $data = $this->settings();
        $data['galeri'] = Galeri::where('aktif', true)->orderBy('urutan')->paginate(12);
        return view('frontend.galeri', $data);
    }

    public function artikel()
    {
        $data = $this->settings();
        $data['artikel'] = Artikel::where('aktif', true)->latest('published_at')->paginate(9);
        return view('frontend.artikel', $data);
    }

    public function artikelDetail(string $slug)
    {
        $data = $this->settings();
        $data['artikel']       = Artikel::where('slug', $slug)->where('aktif', true)->firstOrFail();
        $data['artikel_lain']  = Artikel::where('aktif', true)->where('slug', '!=', $slug)->latest('published_at')->take(3)->get();
        return view('frontend.artikel-detail', $data);
    }

    public function kontak()
    {
        $data = $this->settings();
        $data['maps_embed'] = SiteSetting::get('maps_embed');
        return view('frontend.kontak', $data);
    }
}

