<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaturanWebController extends Controller
{
    public function index()
    {
        $settings = [
            'nama_perusahaan' => SiteSetting::get('nama_perusahaan', 'Sifabrik'),
            'tagline'         => SiteSetting::get('tagline', 'Sistem Informasi Gudang Fabrikasi'),
            'deskripsi'       => SiteSetting::get('deskripsi'),
            'alamat'          => SiteSetting::get('alamat'),
            'telepon'         => SiteSetting::get('telepon'),
            'email'           => SiteSetting::get('email'),
            'logo'            => SiteSetting::get('logo'),
            'hero_judul'      => SiteSetting::get('hero_judul'),
            'hero_subjudul'   => SiteSetting::get('hero_subjudul'),
            'hero_foto'       => SiteSetting::get('hero_foto'),
            'tentang_konten'  => SiteSetting::get('tentang_konten'),
            'tentang_visi'    => SiteSetting::get('tentang_visi'),
            'tentang_misi'    => SiteSetting::get('tentang_misi'),
            'tentang_foto'    => SiteSetting::get('tentang_foto'),
            'maps_embed'      => SiteSetting::get('maps_embed'),
            'instagram'       => SiteSetting::get('instagram'),
            'facebook'        => SiteSetting::get('facebook'),
            'whatsapp'        => SiteSetting::get('whatsapp'),
        ];

        return view('content.admin.pengaturan.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $fields = [
            'nama_perusahaan', 'tagline', 'deskripsi', 'alamat', 'telepon', 'email',
            'hero_judul', 'hero_subjudul', 'tentang_konten', 'tentang_visi', 'tentang_misi',
            'maps_embed', 'instagram', 'facebook', 'whatsapp'
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                SiteSetting::set($field, $request->input($field));
            }
        }

        // Upload Logo
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('site', 'public');
            SiteSetting::set('logo', $path);
        }

        // Upload Hero Foto
        if ($request->hasFile('hero_foto')) {
            $path = $request->file('hero_foto')->store('site', 'public');
            SiteSetting::set('hero_foto', $path);
        }

        // Upload Tentang Foto
        if ($request->hasFile('tentang_foto')) {
            $path = $request->file('tentang_foto')->store('site', 'public');
            SiteSetting::set('tentang_foto', $path);
        }

        return redirect()->back()->with('success', 'Pengaturan website berhasil diperbarui!');
    }
}

