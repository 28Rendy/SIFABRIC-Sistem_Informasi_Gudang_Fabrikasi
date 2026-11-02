<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $table = 'site_settings';
    protected $fillable = ['key', 'value'];

    /**
     * Ambil nilai setting berdasarkan key, dengan default jika tidak ada.
     */
    public static function get(string $key, string $default = ''): string
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Set atau update nilai setting.
     */
    public static function set(string $key, ?string $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}

