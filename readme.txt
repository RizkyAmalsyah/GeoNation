Ujian Teknis Fullstack Developer
================================

Daftar Isi:
-----------
1. Ringkasan
2. Desain Basis Data
3. Endpoint API
4. Fitur
5. Instalasi
6. Penggunaan

1. Ringkasan:
-------------
Repositori ini berisi pengumpulan tugas untuk Ujian Teknis Fullstack Developer. 
Tugas ini meliputi perancangan basis data, implementasi API dengan pola repository, 
dan pembuatan visualisasi untuk data.

2. Desain Basis Data:
---------------------
Basis data terdiri dari tiga tabel: direktorat, kawasan, dan negara. 
Relasi antar tabel adalah sebagai berikut:

- direktorat: Berisi informasi tentang berbagai direktorat.
- kawasan: Terhubung dengan tabel direktorat, berisi informasi tentang kawasan.
- negara: Terhubung dengan tabel kawasan dan direktorat, berisi informasi tentang negara.

3. Endpoint API:
----------------
Berikut adalah endpoint API yang telah diimplementasikan:

- Menambah Negara
  - Metode: POST
  - Endpoint: /api/negara
  - Deskripsi: Menambahkan negara baru ke tabel negara.

- Menghapus Negara
  - Metode: DELETE
  - Endpoint: /api/negara/{id}
  - Deskripsi: Menghapus negara dari tabel negara berdasarkan ID yang diberikan.

4. Fitur:
---------
- Visualisasi Geomap: Menampilkan peta dengan wilayah yang diberi warna berdasarkan direktorat, 
  dengan tooltip yang menunjukkan detail negara.
- Datatables: Tabel yang menampilkan negara-negara dengan fitur pencarian, paginasi, dan tombol hapus.

5. Instalasi:
-------------
Untuk mengatur proyek ini secara lokal, ikuti langkah-langkah berikut:

1. Clone Repositori:
   git clone https://github.com/RizkyAmalsyah/GeoNation.git
   cd repository-name

2. Instal Dependensi:
   composer install
   npm install

3. Atur Basis Data:
   - Buat database MySQL baru.
   - Konfigurasikan file .env dengan kredensial database Anda.
   - Jalankan migrasi:
     php artisan migrate

4. Jalankan Aplikasi:
   php artisan serve
   npm run dev

6. Penggunaan:
--------------
- Pengujian API:
  Gunakan Postman atau alat serupa untuk menguji endpoint API.

- Mengakses Visualisasi:
  Akses geomap dan datatables melalui antarmuka web yang disediakan oleh aplikasi.
