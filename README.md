# A-Gym – Sistem Manajemen Inventaris Perlengkapan Gym

A-Gym adalah aplikasi web berbasis Laravel untuk membantu pengelolaan inventaris perlengkapan gym. Aplikasi ini menyediakan fitur pengelolaan produk, kategori, supplier, serta pencatatan stok masuk dan stok keluar.

## Teknologi

- PHP 8.3
- Laravel 12
- MySQL
- Blade Template Engine
- HTML, CSS
- Composer
- Git dan GitHub

## Fitur

- Registrasi, login, dan logout.
- Dashboard ringkasan inventaris.
- Pengelolaan produk.
- Pengelolaan kategori.
- Pengelolaan supplier.
- Pencatatan stok masuk.
- Pencatatan stok keluar.
- Riwayat pergerakan stok.
- Pembagian hak akses admin dan staff.

## Hak Akses

| Fitur | Admin | Staff |
|---|---|---|
| Dashboard | Ya | Ya |
| Melihat produk | Ya | Ya |
| Menambah dan mengubah produk | Ya | Tidak |
| Menghapus produk | Ya | Tidak |
| Mengelola kategori | Ya | Tidak |
| Mengelola supplier | Ya | Tidak |
| Mencatat stok masuk/keluar | Ya | Ya |
| Melihat riwayat stok | Ya | Ya |

Hak akses di atas harus disesuaikan dengan middleware dan route yang benar-benar diterapkan pada project.

## Struktur Database

Database A-Gym menggunakan MySQL dengan tabel utama:

1. `users`
2. `categories`
3. `suppliers`
4. `products`
5. `stock_movements`

Relasi utama:

- Satu kategori dapat memiliki banyak produk.
- Satu supplier dapat memasok banyak produk.
- Satu produk dapat memiliki banyak catatan pergerakan stok.
- Satu user dapat mencatat banyak pergerakan stok.

## Persyaratan

- PHP 8.2 atau lebih baru.
- Composer.
- MySQL 8 atau versi yang kompatibel.
- Node.js dan npm jika asset frontend perlu dikompilasi.

## Instalasi Lokal

Clone repository:

```bash
git clone https://github.com/USERNAME/agym-inventory.git
cd agym-inventory
```

Install dependency PHP:

```bash
composer install
```

Salin konfigurasi environment:

Windows:

```powershell
copy .env.example .env
```

Linux/macOS:

```bash
cp .env.example .env
```

Buat database MySQL bernama `agym`, kemudian sesuaikan konfigurasi database pada file `.env`.

Generate application key:

```bash
php artisan key:generate
```

Jalankan migration dan seeder:

```bash
php artisan migrate --seed
```

Bersihkan cache konfigurasi:

```bash
php artisan optimize:clear
```

Jalankan aplikasi:

```bash
php artisan serve
```

Buka:

```text
http://127.0.0.1:8000
```

## Akun Demo Lokal

Admin:

- Email: `admin@agym.test`
- Password: `Admin123!`

Staff:

- Email: `staff@agym.test`
- Password: `Staff123!`

Akun tersebut merupakan akun demo lokal. Untuk deployment, pastikan akun demo dibuat di database production dan password-nya sudah diuji.

## Database Export

Database dapat diekspor melalui phpMyAdmin:

1. Pilih database `agym`.
2. Pilih menu Export.
3. Pilih format SQL.
4. Download hasil export.
5. Simpan file sebagai `database/agym.sql` atau sertakan sebagai lampiran submission.

Jangan menyertakan data pribadi atau password asli dalam file SQL.

## Deployment

Deployment dilakukan dengan menyiapkan server yang mendukung PHP dan MySQL, mengunggah source code, memasang dependency Composer, mengatur file `.env`, menjalankan migration dan seeder, serta mengarahkan document root ke folder `public`.

Konfigurasi production harus menggunakan:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://alamat-aplikasi.example
```

Kredensial database dan `APP_KEY` harus diisi sesuai server dan tidak boleh dipublikasikan.

## Dokumentasi

Dokumentasi rancangan sistem dapat ditemukan pada folder `docs/`:

- `erd.md` – Entity Relationship Diagram.
- `architecture.md` – Diagram arsitektur dan alur aplikasi.
- `screenshots/` – Bukti tampilan aplikasi.

## Pengembang

Nama: [Nama Mahasiswa]  
NIM: [NIM Mahasiswa]  
Kelas: WAD05  
Mata Kuliah: Web Application Development  
Universitas Cakrawala
