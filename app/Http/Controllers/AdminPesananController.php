<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPesananController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');

        $query = Pesanan::with(['user', 'details'])->latest();

        if ($status) {
            $query->where('status', $status);
        }

        $pesanan = $query->paginate(10);
        $totalMasuk = Pesanan::where('status', 'menunggu')->count();

        return view('content.admin.pesanan.index', compact('pesanan', 'totalMasuk', 'status'));
    }

    public function show($id)
    {
        $pesanan = Pesanan::with(['user', 'details.barang'])->findOrFail($id);
        return view('content.admin.pesanan.show', compact('pesanan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diproses,dikirim,selesai,dibatalkan',
        ]);

        $pesanan = Pesanan::with('details.barang')->findOrFail($id);
        $statusLama = $pesanan->status;
        $statusBaru = $request->status;

        DB::beginTransaction();
        try {
            // Jika pesanan disetujui (diproses) dan sebelumnya belum diproses, kurangi stok barang
            if ($statusBaru === 'diproses' && $statusLama === 'menunggu') {
                foreach ($pesanan->details as $detail) {
                    $barang = Barang::find($detail->barang_id);
                    if ($barang) {
                        if ($barang->stok < $detail->jumlah) {
                            return back()->with('error', 'Gagal memproses pesanan: Stok ' . $barang->nama_barang . ' tidak mencukupi (sisa: ' . $barang->stok . ').');
                        }
                        $barang->decrement('stok', $detail->jumlah);
                    }
                }
            }

            // Jika pesanan selesai, catat ke tabel penjualan & detail_penjualan agar masuk grafik & laporan
            if ($statusBaru === 'selesai' && $statusLama !== 'selesai') {
                $penjualan = Penjualan::create([
                    'tanggal'   => now(),
                    'total'     => $pesanan->total_harga,
                    'bayar'     => $pesanan->total_harga,
                    'kembalian' => 0,
                    'kasir_id'  => auth()->id(),
                ]);

                foreach ($pesanan->details as $detail) {
                    DetailPenjualan::create([
                        'penjualan_id' => $penjualan->id,
                        'barang_id'    => $detail->barang_id,
                        'nama_barang'  => $detail->nama_barang,
                        'harga'        => $detail->harga,
                        'jumlah'       => $detail->jumlah,
                        'subtotal'     => $detail->subtotal,
                    ]);
                }
            }

            $pesanan->status = $statusBaru;
            if ($request->filled('alasan_batal')) {
                $pesanan->alasan_batal = $request->alasan_batal;
            }
            $pesanan->save();

            DB::commit();
            return back()->with('success', 'Status pesanan ' . $pesanan->kode_pesanan . ' berhasil diubah menjadi: ' . strtoupper($statusBaru));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
