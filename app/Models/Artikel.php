<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Artikel extends Model
{
    protected $table = 'artikel';
    protected $fillable = ['judul', 'slug', 'gambar', 'ringkasan', 'konten', 'penulis', 'aktif', 'published_at'];

    protected $casts = [
        'aktif'        => 'boolean',
        'published_at' => 'datetime',
    ];

    /**
     * Auto-generate slug dari judul sebelum disimpan.
     */
    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($artikel) {
            if (empty($artikel->slug)) {
                $artikel->slug = Str::slug($artikel->judul);
            }
            if (is_null($artikel->published_at)) {
                $artikel->published_at = now();
            }
        });
    }
}

