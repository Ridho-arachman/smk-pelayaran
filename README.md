# SMK Pelayaran - Sistem Informasi Sekolah

## Deskripsi

Sistem informasi terpadu untuk SMK Pelayaran yang mencakup manajemen PPDB, E-Learning, dan Perpustakaan Digital, dibangun dengan Laravel dan Filament Admin.

## Fitur Utama

### 1. Sistem PPDB (Penerimaan Peserta Didik Baru)

#### Form Pendaftaran

-   Informasi Siswa:
    -   Nama lengkap
    -   NISN
    -   Email
    -   Nomor telepon
    -   Tanggal lahir
    -   Tempat lahir
    -   Jenis kelamin (male/female)
-   Informasi Sekolah:
    -   Asal sekolah
    -   Nama orang tua
    -   Nomor telepon orang tua
    -   Alamat lengkap
-   Upload Dokumen:
    -   Foto siswa
    -   Dokumen persyaratan

#### Panel Admin PPDB

-   Tabel aplikasi dengan kolom:
    -   Nomor registrasi
    -   Nama
    -   NISN
    -   Email
    -   Status (pending/accepted/rejected)
    -   Tanggal pendaftaran
    -   Foto siswa
-   Fitur filter berdasarkan status
-   Aksi:
    -   Lihat detail
    -   Kirim ulang email
    -   Update status
-   Notifikasi otomatis via email
-   Pembuatan akun siswa otomatis

### 2. E-Learning

-   Manajemen mata pelajaran
-   Upload materi pembelajaran
-   Progress tracking
-   Dashboard guru dan siswa

### 3. Perpustakaan Digital

-   Katalog buku
-   Sistem peminjaman
-   Manajemen inventori

## Tech Stack

### Backend

-   PHP 8.2
-   Laravel 12.0
-   MySQL/MariaDB
-   Filament Admin 3.3

### Frontend

-   Blade Templates
-   TailwindCSS
-   DaisyUI
-   Alpine.js

## Instalasi

### Prasyarat

```bash
PHP >= 8.2
Composer
Node.js & NPM
MySQL/MariaDB
```

### Langkah Instalasi

1. Clone repository

```bash
git clone https://github.com/yourusername/smk-pelayaran.git
cd smk-pelayaran
```

````

2. Install dependensi
```bash
composer install
npm install
````

3. Setup environment

```bash
copy .env.example .env
php artisan key:generate
```

4. Konfigurasi database di .env

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=smk_pelayaran
DB_USERNAME=root
DB_PASSWORD=
```

5. Migrasi database

```bash
php artisan migrate --seed
```

6. Link storage

```bash
php artisan storage:link
```

7. Build assets

```bash
npm run build
```

8. Jalankan aplikasi

```bash
php artisan serve
```

## Struktur Aplikasi

```plaintext
├── app/
│   ├── Filament/
│   │   ├── Resources/
│   │   │   └── PPDBResource.php    # PPDB management
│   │   └── Widgets/                # Dashboard widgets
│   ├── Http/
│   │   └── Controllers/
│   ├── Models/
│   │   └── PPDB.php               # PPDB model
│   └── Notifications/
│       └── PPDBAcceptedNotification.php
├── database/
│   ├── migrations/
│   └── seeders/
└── resources/
    └── views/
```

## Panduan Penggunaan

### Admin Panel

```
1. Akses /admin
2. Navigasi ke PPDB Applications
3. Fitur tersedia:
   - Review pendaftaran
   - Update status
   - Kirim notifikasi
   - Download dokumen
```

### Guru Panel

```
1. Akses /teacher
2. Kelola kelas dan materi
3. Monitor progress siswa
```

### Siswa

1. Akses homepage
2. Daftar PPDB
3. Akses pembelajaran

```
## Keamanan
- CSRF Protection
- Form validation
- File upload validation
- Role-based access
- Rate limiting
```

## Maintenance

-   Regular backup
-   Log monitoring
-   Performance optimization

```
## Support
Email: support@smkpelayaran.sch.id
```

## License

MIT License

This README provides:

1. Detailed PPDB system documentation
2. Complete installation guide
3. Project structure
4. Usage instructions
5. Security features
6. Maintenance guidelines

Remember to:

-   Update repository URL
-   Customize contact information
-   Add specific configuration requirements
-   Update features as implemented
