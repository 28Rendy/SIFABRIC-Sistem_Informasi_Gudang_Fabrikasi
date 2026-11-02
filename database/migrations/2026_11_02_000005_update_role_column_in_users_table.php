<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Untuk SQLite dan MySQL, ubah kolom role menjadi string biasa agar fleksibel mendukung role pelanggan
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 50)->default('pelanggan')->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 50)->default('admin')->change();
        });
    }
};
