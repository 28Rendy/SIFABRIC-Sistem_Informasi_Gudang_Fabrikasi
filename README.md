<h1 align="center">🏭 SIFABRIC</h1>
<p align="center"><strong>Sistem Informasi Gudang Fabrikasi</strong></p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11-red?logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2-blue?logo=php" alt="PHP">
  <img src="https://img.shields.io/badge/License-MIT-green" alt="License">
</p>

---

## 📖 Tentang Project

**SIFABRIC** adalah sistem informasi manajemen gudang berbasis web yang dirancang untuk membantu pabrik dalam mengelola stok barang, transaksi penjualan, barang masuk, supplier, dan laporan keuangan secara terintegrasi.

Project ini dikembangkan sebagai personal portfolio dan akan terus dikembangkan menjadi platform yang dapat digunakan oleh berbagai pabrik (multi-tenant).

> **Atribusi:** Project ini dikembangkan dan diperluas dari base project oleh [Dewi Fatimah Azzahra](https://github.com/28Rendy/SIFABRIC-Sistem_Informasi_Gudang_Fabrikasi) sebagai Tugas Akhir. Pengembangan lanjutan oleh [Rendy](https://github.com/rendy28).

---

## ✨ Fitur

### Backend Admin
- 🔐 Autentikasi multi-role (Admin, Kasir, Pimpinan)
- 📦 Manajemen barang & kategori
- 🚚 Manajemen supplier & barang masuk
- 🛒 Transaksi penjualan
- 📊 Dashboard grafik penjualan bulanan
- 📋 Laporan (export Excel)
- 💰 Manajemen pengeluaran

### Dalam Pengembangan 🚧
- 🌐 Frontend publik (landing page & katalog)
- 👤 Backend pelanggan (register, pesanan, riwayat transaksi)
- 🏭 Multi-tenant (banyak pabrik dalam 1 sistem)

---

## 🛠️ Teknologi

| Komponen | Teknologi |
|---|---|
| Backend | Laravel 11 |
| Frontend | Blade + Bootstrap 5 |
| Database | SQLite (dev) / MySQL (prod) |
| Export | Maatwebsite Excel |
| Charts | Chart.js |

---

## 🚀 Cara Instalasi

### Prasyarat
- PHP >= 8.2
- Composer
- Node.js & NPM

### Langkah-langkah

```bash
# 1. Clone repository
git clone https://github.com/rendy28/Sifabrik.git
cd Sifabrik

# 2. Install dependencies
composer install
npm install

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. Jalankan migrasi & seeder
php artisan migrate --seed

# 5. Build assets
npm run dev

# 6. Jalankan server
php artisan serve
```

### Akun Default (Development)

| Role | Email | Password |
|---|---|---|
| Admin | admin@sifabric.test | password |
| Kasir | kasir@sifabric.test | password |
| Pimpinan | pimpinan@sifabric.test | password |

---

## 📁 Struktur Singkat

```
app/
├── Http/Controllers/     # Controller per fitur
├── Models/               # Eloquent models
└── Exports/              # Kelas export Excel
database/
├── migrations/           # Skema database
└── seeders/              # Data dummy
resources/views/          # Blade templates
routes/                   # Definisi routing
```

---

## 🗺️ Roadmap

- [x] Manajemen gudang (barang, supplier, penjualan)
- [x] Dashboard & grafik
- [x] Export laporan Excel
- [ ] Frontend publik
- [ ] Backend pelanggan
- [ ] Notifikasi real-time
- [ ] Multi-tenant / multi-pabrik
- [ ] API (mobile-ready)

---

## 📄 Lisensi

Project ini menggunakan lisensi [MIT](LICENSE).

---

<p align="center">Made with ❤️ by <a href="https://github.com/rendy28">Rendy</a></p>
