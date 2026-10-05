# ReShare

Platform donasi barang bekas berbasis PHP dan MySQL.

## Struktur utama

- frontend/ — halaman dan komponen antarmuka
- backend/ — autentikasi, proses data, database access, dan utility
- assets/ — gambar dan icon
- database/ — SQL schema
- js/ dan style/ — asset frontend global
- .htaccess — entry routing aplikasi

## Entry point

Aplikasi dibuka dari root project:

http://localhost/reshare/

Root request diarahkan oleh .htaccess ke frontend/index.php. Alur halaman tetap sama: landing → login/register → welcome → home → fitur aplikasi.
