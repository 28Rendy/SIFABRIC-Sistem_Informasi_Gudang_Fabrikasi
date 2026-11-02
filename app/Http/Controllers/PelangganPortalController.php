<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailPesanan;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PelangganPortalController extends Controller
{
    public function dashboard()
    {
        $user = Auth::guard('pelanggan')->user();
        $totalPesanan = Pesanan::where('user_id', $user->id)->count();
        $menunggu     = Pesanan::where('user_id', $user->id)->where('status', 'menunggu')->count();
        $diproses     = Pesanan::where('user_id', $user->id)->where('status', 'diproses')->count();
        $selesai      = Pesanan::where('user_id', $user->id)->where('status', 'selesai')->count();

        $pesananTerbaru = Pesanan::where('user_id', $user->id)
            ->with('details')
            ->latest()
            ->take(5)
            ->get();

        return view('pelanggan.dashboard', compact('user', 'totalPesanan', 'menunggu', 'diproses', 'selesai', 'pesananTerbaru'));
    }

    public function riwayatPesanan()
    {
        $user = Auth::guard('pelanggan')->user();
        $pesanan = Pesanan::where('user_id', $user->id)
            ->with('details')
            ->latest()
            ->paginate(10);

        return view('pelanggan.riwayat', compact('pesanan'));
    }

    public function formOrder($barang_id = null)
    {
        $barangList = Barang::where('stok', '>', 0)->orderBy('nama_barang')->get();
        $selectedBarang = $barang_id ? Barang::find($barang_id) : null;
        $user = Auth::guard('pelanggan')->user();

        return view('pelanggan.order', compact('barangList', 'selectedBarang', 'user'));
    }

    public function submitOrder(Request $request)
    {
        $request->validate([
            'barang_id'         => 'required|exists:barang,id',
            'jumlah'            => 'required|integer|min:1',
            'nama_pemesan'      => 'required|string|max:255',
            'no_hp'             => 'required|string|max:20',
            'alamat_pengiriman' => 'required|string',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        if ($request->jumlah > $barang->stok) {
            return back()->with('error', 'Jumlah pesanan melebihi stok yang tersedia (' . $barang->stok . ' ' . $barang->satuan . ').')->withInput();
        }

        $harga = $barang->harga_jual ?? $barang->harga_beli;
        $total = $harga * $request->jumlah;
        $kodePesanan = 'ORD-' . date('Ymd') . '-' . strtoupper(Str::random(4));

        $pesanan = Pesanan::create([
            'kode_pesanan'      => $kodePesanan,
            'user_id'           => Auth::guard('pelanggan')->id(),
            'nama_pemesan'      => $request->nama_pemesan,
            'no_hp'             => $request->no_hp,
            'alamat_pengiriman' => $request->alamat_pengiriman,
            'catatan'           => $request->catatan,
            'total_harga'       => $total,
            'status'            => 'menunggu',
        ]);

        DetailPesanan::create([
            'pesanan_id'  => $pesanan->id,
            'barang_id'   => $barang->id,
            'nama_barang' => $barang->nama_barang,
            'harga'       => $harga,
            'jumlah'      => $request->jumlah,
            'subtotal'    => $total,
        ]);

        return redirect()->route('pelanggan.riwayat')->with('success', 'Pesanan ' . $kodePesanan . ' berhasil dibuat! Tim kami akan segera memprosesnya.');
    }

    public function detailPesanan($id)
    {
        $user = Auth::guard('pelanggan')->user();
        $pesanan = Pesanan::where('user_id', $user->id)->with('details.barang')->findOrFail($id);

        return view('pelanggan.detail-pesanan', compact('pesanan'));
    }
}
