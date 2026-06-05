# COURTEE - Sistem Pemesanan Lapangan Online

## Deskripsi Proyek

**COURTEE** adalah aplikasi web berbasis Laravel yang dirancang untuk memudahkan proses pemesanan lapangan olahraga secara online. Sistem ini menghubungkan penyewa lapangan dengan pemilik/pengelola lapangan melalui platform digital yang terintegrasi.

### Fitur Utama

**Untuk Penyewa:**
- Pencarian lapangan berdasarkan lokasi, jenis olahraga, tanggal, dan harga
- Melihat detail lengkap venue dan ketersediaan jadwal
- Membuat pemesanan dengan pilihan slot waktu
- Pembayaran online melalui **QRIS** atau Mobile Banking
- Melihat riwayat pemesanan dan status pembayaran
- Manajemen profil dan preferensi olahraga favorit

**Untuk Pengelola Lapangan:**
- Manajemen venue dan lapangan (tambah, edit, hapus)
- Pengaturan jadwal ketersediaan lapangan
- Monitoring daftar pemesanan masuk
- Verifikasi pembayaran dari penyewa
- Manajemen refund dan pembatalan
- Dashboard dengan analitik pendapatan dan tingkat okupansi

## Persyaratan Sistem

- **PHP** 8.5 atau lebih tinggi
- Laravel 13
- MariaDB/MySQL
- Node.js (untuk asset compilation)
- Composer

## Instalasi

### 1. Clone Repository

```bash git clone <repository-url> cd courtee ```

### 2. Install Dependencies

```bash composer install npm install ```

### 3. Setup Environment File

```bash cp .env.example .env ```

Kemudian edit file `.env` dan sesuaikan konfigurasi database:

```env DB_CONNECTION=mysql DB_HOST=**127**.0.0.1 DB_PORT=**3306** DB_DATABASE=courtee DB_USERNAME=root DB_PASSWORD= ```

### 4. Generate Application Key

```bash php artisan key:generate ```

### 5. Jalankan Database Migration

```bash php artisan migrate ```

### 6. Seed Data Dummy (Opsional)

```bash php artisan db:seed ```

### 7. Compile Assets

```bash npm run dev ```

Atau untuk production:

```bash npm run build ```

## Menjalankan Aplikasi

### Mode Development

```bash php artisan serve ```

Aplikasi akan berjalan di `[http://localhost:**8000**`](http://localhost:**8000**`)

### Mode Production

Pastikan `APP_ENV` di `.env` diubah menjadi `production` dan jalankan:

```bash php artisan serve --env=production ```

## Struktur Folder

``` courtee/ ├── app/ │   ├── Http/ │   │   ├── Controllers/ │   │   ├── Middleware/ │   │   └── Requests/ │   ├── Models/ │   └── Services/ ├── database/ │   ├── migrations/ │   └── seeders/ ├── resources/ │   ├── views/ │   │   ├── auth/ │   │   ├── customer/ │   │   └── owner/ │   └── css/ ├── routes/ │   └── web.php ├── storage/ │   ├── app/ │   └── logs/ └── tests/ ```

## Konfigurasi Penting

### Authentication

Sistem autentikasi menggunakan Laravel Auth dengan session management. Role-based access control diimplementasikan melalui middleware:

- **Guest**: Dapat melihat halaman home dan detail venue
- **User (Penyewa)**: Dapat mencari, memesan, dan membayar lapangan
- **Owner (Pengelola)**: Dapat mengelola venue, lapangan, dan melihat laporan

### Database Schema

Tabel utama dalam sistem:
- `users` - Data pengguna (penyewa & pengelola)
- `user_profiles` - Profil detail pengguna
- `venues` - Data venue/lokasi lapangan
- `fields` - Data lapangan olahraga
- `bookings` - Data pemesanan
- `payments` - Data transaksi pembayaran

## Akun Test

Anda dapat membuat akun baru melalui halaman register, atau gunakan data seeder untuk membuat akun test otomatis.

### User Test (Penyewa)

- Email: `[user@example.com](mailto:user@example.com)`
- Password: `password`

### Owner Test (Pengelola)

- Email: `[owner@example.com](mailto:owner@example.com)`
- Password: `password`

## Development Tools

### Menjalankan Tests

```bash php artisan test ```

### Membersihkan Cache

```bash php artisan cache:clear php artisan config:clear php artisan view:clear ```

### Generate Dokumentasi API

```bash php artisan ide-helper:generate ```

## Troubleshooting

### Masalah: Migration Error

**Solusi:** Pastikan database sudah dibuat terlebih dahulu. Jika perlu, reset database:

```bash php artisan migrate:refresh --seed ```

### Masalah: Storage Permission Error

**Solusi:** Ubah permission folder storage:

```bash chmod -R **755** storage chmod -R **755** bootstrap/cache ```

### Masalah: CSRF Token Mismatch

**Solusi:** Clear session dan cache:

```bash php artisan cache:clear php artisan session:clear ```

## Tim Pengembang

- **Affan Abyarahman** (**245150207111020**)
- **Reyhan Hadyan Nabil** (**245150207111034**)
- **Yoga Kurniawan** (**245150200111012**)

**Dosen:** Mahardeka Tri Ananta, S.Kom., M.T., M.Sc.

**Program Studi:** S1 Teknik Informatika, Universitas Brawijaya