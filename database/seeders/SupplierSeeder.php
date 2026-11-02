<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            [
                'nama'       => 'Budi Santoso',
                'perusahaan' => 'PT Nusa Bahan Utama',
                'alamat'     => 'Jl. Industri Raya No. 12, Bekasi',
                'no_telpon'  => '08111234001',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama'       => 'Siti Rahayu',
                'perusahaan' => 'CV Maju Bersama',
                'alamat'     => 'Jl. Pahlawan No. 45, Surabaya',
                'no_telpon'  => '08111234002',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama'       => 'Ahmad Fauzi',
                'perusahaan' => 'PT Sumber Makmur',
                'alamat'     => 'Jl. Raya Bogor KM 30, Depok',
                'no_telpon'  => '08111234003',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama'       => 'Dewi Lestari',
                'perusahaan' => 'UD Karya Mandiri',
                'alamat'     => 'Jl. Sudirman No. 8, Bandung',
                'no_telpon'  => '08111234004',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama'       => 'Hendra Wijaya',
                'perusahaan' => 'PT Graha Bahan Industri',
                'alamat'     => 'Jl. Gatot Subroto No. 99, Semarang',
                'no_telpon'  => '08111234005',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('supplier')->insert($suppliers);
    }
}

