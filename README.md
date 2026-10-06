# ReShare

> Platform donasi dan berbagi barang layak pakai untuk membantu sesama sekaligus mengurangi barang yang berakhir sebagai limbah.

ReShare adalah aplikasi web berbasis **PHP dan MySQL/MariaDB** yang memungkinkan pengguna untuk membagikan barang bekas yang masih layak pakai, menemukan barang yang tersedia, mengikuti event, serta mengelola informasi akun melalui satu platform.

Project ini menggunakan struktur terpisah antara **frontend**, **backend**, **database**, dan **asset** agar kode lebih mudah dipelajari, dikembangkan, dan dipelihara.

---

## Fitur Utama

### Authentication
- Registrasi akun baru.
- Login menggunakan username atau email.
- Password disimpan menggunakan hashing.
- Session-based authentication.
- Logout melalui menu Pengaturan.

### Berbagi Barang
- Upload barang donasi.
- Menentukan kategori barang.
- Menentukan kondisi barang.
- Menambahkan deskripsi, alamat, dan foto.
- Melihat detail barang.
- Menampilkan status barang yang masih tersedia atau sudah diambil.

### Katalog
- Melihat daftar barang yang tersedia.
- Pencarian barang.
- Filter berdasarkan kategori.
- Melihat detail barang sebelum mengambilnya.

### Event
- Melihat daftar event.
- Melihat detail event.
- Upload dan menampilkan event.
- Menampilkan poster, deskripsi, alamat, dan tanggal event.

### Akun & Pengaturan
Pengguna dapat mengelola:
- Username.
- Password.
- Email.
- Nomor telepon.
- Logout.

Menu **Pengaturan** menggunakan dropdown interaktif dan terhubung dengan session pengguna yang sedang login.

### Dashboard/Home
Halaman Home menyediakan:
- Rekomendasi barang.
- Kategori barang.
- Event pilihan.
- Leaderboard/donatur teratas.
- Navigasi utama aplikasi.

### Inbox
Tersedia halaman inbox untuk aktivitas atau informasi terkait pengguna.

---

## Tech Stack

| Teknologi | Penggunaan |
|---|---|
| **PHP** | Backend dan server-side rendering |
| **MySQL / MariaDB** | Database |
| **HTML5** | Struktur halaman |
| **JavaScript** | Interaksi dropdown dan fitur frontend |
| **Tailwind CSS** | Styling antarmuka |
| **Apache (.htaccess)** | Routing entry point |
| **XAMPP** | Local development environment |
| **phpMyAdmin** | Import dan pengelolaan database |

Tailwind CSS digunakan melalui CDN sehingga project ini tidak membutuhkan proses build Node.js/npm untuk menjalankannya.

---

## Struktur Project

```text
ReShare-Platform-Donasi-Barang-Bekas/
│
├── .htaccess
├── README.md
│
├── assets/
│   ├── events/
│   ├── icons/
│   └── images/
│
├── backend/
│   ├── auth/
│   ├── config/
│   ├── events/
│   ├── items/
│   ├── leaderboard/
│   ├── user/
│   └── utils/
│
├── database/
│   └── reshare_db.sql
│
├── frontend/
│   ├── components/
│   ├── settings/
│   ├── detail_barang.php
│   ├── detail_event.php
│   ├── event.php
│   ├── home.php
│   ├── inbox.php
│   ├── index.php
│   ├── katalog.php
│   ├── katalog_events.php
│   ├── login.php
│   ├── register.php
│   ├── upload_barang.php
│   ├── upload_event.php
│   └── welcome.php
│
├── js/
│   ├── back.js
│   └── dropdown.js
│
└── style/
    └── main.css
```

### Penjelasan folder

**`frontend/`**  
Berisi halaman yang langsung berinteraksi dengan pengguna, termasuk landing page, login, register, home, katalog, event, upload, inbox, dan pengaturan akun.

**`frontend/components/`**  
Berisi komponen yang digunakan ulang oleh beberapa halaman seperti navbar, dropdown Pengaturan, footer, card, dan leaderboard.

**`frontend/settings/`**  
Berisi halaman untuk mengubah username, password, email, dan nomor telepon.

**`backend/`**  
Berisi proses server-side untuk authentication, item, event, user, leaderboard, konfigurasi database, dan utility.

**`database/`**  
Berisi SQL dump untuk membuat database ReShare.

**`assets/`**  
Berisi gambar, ikon, poster event, logo, dan aset visual lainnya.

**`js/`**  
Berisi JavaScript global untuk interaksi frontend.

**`style/`**  
Berisi CSS global tambahan.

---

## Database

Database utama project bernama:

```text
reshare_db
```

Schema database tersedia pada:

```text
database/reshare_db.sql
```

Database saat ini menggunakan beberapa tabel utama seperti:

- `users` — data akun pengguna.
- `items` — data barang donasi.
- `events` — data event.

Relasi foreign key digunakan antara data barang/event dengan pengguna.

---

## Persyaratan

Sebelum menjalankan project, pastikan perangkat sudah memiliki:

- **XAMPP**
- **Apache**
- **MySQL atau MariaDB**
- **PHP 8.x atau kompatibel**
- **phpMyAdmin**
- Browser modern seperti Chrome, Edge, atau Firefox.

---

## Instalasi di Localhost

### 1. Clone repository

Masuk ke folder `htdocs` milik XAMPP:

```bash
cd C:\xampp\htdocs
```

Clone repository:

```bash
git clone https://github.com/RafieFirman/ReShare-Platform-Donasi-Barang-Bekas.git
```

Masuk ke folder project:

```bash
cd ReShare-Platform-Donasi-Barang-Bekas
```

---

### 2. Jalankan XAMPP

Buka XAMPP Control Panel lalu aktifkan:

- **Apache**
- **MySQL**

---

### 3. Buat database

Buka:

```text
http://localhost/phpmyadmin
```

Buat database:

```text
reshare_db
```

Kemudian import:

```text
database/reshare_db.sql
```

---

### 4. Konfigurasi database

Secara default project menggunakan konfigurasi lokal:

```text
Host     : localhost
Username : root
Password : kosong
Database : reshare_db
```

Konfigurasi dipusatkan di:

```text
backend/config/connection.php
```

Project juga mendukung environment variable berikut:

```text
RESHARE_DB_HOST
RESHARE_DB_USER
RESHARE_DB_PASS
RESHARE_DB_NAME
```

Jika environment variable tidak diatur, project akan menggunakan konfigurasi default XAMPP di atas.

---

### 5. Jalankan aplikasi

Buka URL sesuai nama folder project pada `htdocs`.

Contoh:

```text
http://localhost/ReShare-Platform-Donasi-Barang-Bekas/
```

Atau apabila folder project kamu diberi nama `reshare`:

```text
http://localhost/reshare/
```

File `.htaccess` akan menangani request root dan mengarahkannya ke:

```text
frontend/index.php
```

---

## Alur Aplikasi

Alur utama aplikasi:

```text
Landing Page
    │
    ├── Get Started
    │       │
    │       └── Login / Register
    │
    └── Login
            │
            ▼
        Welcome Page
            │
            ▼
          Home
            │
    ┌───────┼────────┬────────┐
    ▼       ▼        ▼        ▼
  Donasi  Katalog   Event    Inbox
    │       │        │
    ▼       ▼        ▼
  Upload   Detail   Detail
```

Pengelolaan akun dapat diakses melalui:

```text
Home
  └── Pengaturan
        ├── Ganti Username
        ├── Ganti Password
        ├── Ganti Email
        ├── Ganti Nomor
        └── Log Out
```

---

## Konsep Routing

Root aplikasi tidak menggunakan `index.php` di root project.

Sebagai gantinya:

```text
Request /
   │
   ▼
.htaccess
   │
   ▼
frontend/index.php
```

Pendekatan ini menjaga struktur project tetap terpisah antara halaman frontend dan proses backend tanpa mengubah alur penggunaan aplikasi.

---

## Keamanan yang Digunakan

Beberapa mekanisme yang sudah diterapkan:

- Password menggunakan `password_hash()`.
- Login menggunakan `password_verify()`.
- Prepared statement untuk query yang menerima input pengguna.
- Session digunakan untuk autentikasi.
- Session ID diregenerasi setelah login berhasil.
- Validasi input dilakukan pada proses registrasi dan perubahan akun.
- Username dan email dibuat unik pada database.
- Koneksi database menggunakan `mysqli` dengan mode exception.
- Detail error database tidak ditampilkan langsung kepada pengguna.

> Project ini masih ditujukan untuk kebutuhan pengembangan dan pembelajaran. Untuk deployment production, konfigurasi keamanan, secret management, CSRF protection, upload validation, rate limiting, dan hardening server masih perlu diperkuat.

---

## Author

**Muhammad Rafie Firman Rusidy**

Teknik Informatika — Universitas Negeri Surabaya

GitHub: [@RafieFirman](https://github.com/RafieFirman)

**Erlangga Aghna Fatah**
Teknik Informatika — Universitas Negeri Surabaya
github: [@Erlanggaaghnaf](https://github.com/Erlanggaaghnaf)


Repository: [ReShare - Platform Donasi Barang Bekas](https://github.com/RafieFirman/ReShare-Platform-Donasi-Barang-Bekas)

---

## License

Belum ada lisensi open-source khusus yang ditetapkan pada repository ini.
