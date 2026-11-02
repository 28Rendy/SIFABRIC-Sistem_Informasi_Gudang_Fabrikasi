<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';

    protected $fillable = [
        'kode_pesanan',
        'user_id',
        'nama_pemesan',
        'no_hp',
        'alamat_pengiriman',
        'catatan',
        'total_harga',
        'status',
        'alasan_batal',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(DetailPesanan::class, 'pesanan_id');
    }
}
