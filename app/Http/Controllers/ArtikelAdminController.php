<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArtikelAdminController extends Controller
{
    public function index()
    {
        $artikel = Artikel::latest()->paginate(10);
        return view('content.admin.artikel.index', compact('artikel'));
    }

    public function create()
    {
        return view('content.admin.artikel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'   => 'required|string|max:255',
            'konten'  => 'required',
            'gambar'  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('artikel', 'public');
        }

        Artikel::create([
            'judul'        => $request->judul,
            'slug'         => Str::slug($request->judul) . '-' . time(),
            'ringkasan'    => $request->ringkasan ?? Str::limit(strip_tags($request->konten), 150),
            'konten'       => $request->konten,
            'gambar'       => $path,
            'penulis'      => auth()->user()->name ?? 'Admin',
            'aktif'        => $request->has('aktif') ? 1 : 0,
            'published_at' => now(),
        ]);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diterbitkan!');
    }

    public function edit($id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('content.admin.artikel.edit', compact('artikel'));
    }

    public function update(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);

        $request->validate([
            'judul'   => 'required|string|max:255',
            'konten'  => 'required',
            'gambar'  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = [
            'judul'     => $request->judul,
            'ringkasan' => $request->ringkasan ?? Str::limit(strip_tags($request->konten), 150),
            'konten'    => $request->konten,
            'aktif'     => $request->has('aktif') ? 1 : 0,
        ];

        if ($request->hasFile('gambar')) {
            if ($artikel->gambar && Storage::disk('public')->exists($artikel->gambar)) {
                Storage::disk('public')->delete($artikel->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('artikel', 'public');
        }

        $artikel->update($data);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $artikel = Artikel::findOrFail($id);
        if ($artikel->gambar && Storage::disk('public')->exists($artikel->gambar)) {
            Storage::disk('public')->delete($artikel->gambar);
        }
        $artikel->delete();

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus!');
    }
}

