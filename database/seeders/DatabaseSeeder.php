<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Akun default untuk development
        User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@sifabric.test',
            'role'     => 'admin',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name'     => 'Kasir',
            'email'    => 'kasir@sifabric.test',
            'role'     => 'kasir',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name'     => 'Pimpinan',
            'email'    => 'pimpinan@sifabric.test',
            'role'     => 'pimpinan',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name'     => 'Pelanggan Demo',
            'email'    => 'pelanggan@sifabric.test',
            'role'     => 'pelanggan',
            'password' => Hash::make('password'),
        ]);

        // Data dummy generik
        $this->call([
            KategoriSeeder::class,
            SupplierSeeder::class,
            BarangSeeder::class,
            SiteSettingSeeder::class,
            ContentDummySeeder::class,
            TransaksiDummySeeder::class,
        ]);
    }
}
