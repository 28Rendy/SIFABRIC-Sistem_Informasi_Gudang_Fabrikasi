
<img width="1408" height="768" alt="ZyG19JsDvmltMe6lzK5UtFenoPfcpfffHRh1vLnK" src="https://github.com/user-attachments/assets/8aa94452-00e9-4bbc-a532-c9f5faa9094e" />

<h1 align="center"> SIFABRIC</h1>
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

> **Atribusi:** Project ini merupakan pengembangan lanjutan dari [SIFABRIC oleh Dewi Fatimah Azzahra](https://github.com/28Rendy/SIFABRIC-Sistem_Informasi_Gudang_Fabrikasi) yang dimodifikasi dan dikembangkan untuk tujuan portfolio pribadi oleh [Rendy](https://github.com/rendy28).

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
<h1 align="center"> FrontEnd-SIFABRIC</h1>

<img width="1920" height="4245" alt="Beranda - Sistem Informasi Gudang Fabrikasi" src="https://github.com/user-attachments/assets/57570765-c0a4-4ee7-b47a-53f3bb12e1eb" />

<h1 align="center"> Login-SIFABRIC</h1>

<img width="947" height="428" alt="Login - Sistem Informasi Gudang Fabrikasi" src="https://github.com/user-attachments/assets/0f47677b-b6cc-4dd6-b94d-54e69de07a86" />

<h1 align="center"> Backend Admin-SIFABRIC</h1>

<img width="1920" height="1697" alt="backend admin-Sistem Inventory" src="https://github.com/user-attachments/assets/17ff65bb-f943-47f3-8e3f-2526246902bb" />

<h1 align="center"> Backend Pelanggan-SIFABRIC</h1>

<img width="1920" height="879" alt="Pelanggan Sistem Inventory" src="https://github.com/user-attachments/assets/72b2bc5e-12f2-45f1-9953-72baf1f61544" />

<h1 align="center"> Backend Kasir-SIFABRIC</h1>

<img width="1920" height="1008" alt="Kasir - Sistem Inventory" src="https://github.com/user-attachments/assets/ad6e098a-e14e-45ac-8482-58ab59619315" />

<h1 align="center"> Backend Pemilik-SIFABRIC</h1>

<img width="1920" height="2058" alt="Pemilik - Sistem Inventory" src="https://github.com/user-attachments/assets/a4a13c0d-0050-442a-8fd7-d6f8ea1d97b1" />



<p align="center">Made with OK by <a href="https://github.com/rendy28">Rendy</a></p>


