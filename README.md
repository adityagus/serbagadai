# Website Serba Gadai

Website resmi dan CMS untuk **Serba Gadai** — layanan gadai barang elektronik (Smartphone, Laptop, Kamera, TV, dan gadget lainnya) yang cepat, transparan, dan diawasi oleh OJK.

---

## Tech Stack

- **Backend:** PHP `^8.2`, Laravel `^11.0`
- **Frontend:** Blade Templates, Vanilla CSS & JavaScript, Vite `^5.0`
- **Peta & UI Tambahan:** Leaflet.js `1.9.4` (OpenStreetMap), Font Awesome `6.4.0`, Google Fonts (`Outfit` & `Plus Jakarta Sans`)
- **Paket Laravel Utama:**
  - `yajra/laravel-datatables` (`^11.0`)
  - `maatwebsite/excel` (`^3.1`)
  - `laravel/ui`
- **Containerization:** Docker & Docker Compose (`php-fpm` + `nginx:alpine`)

---

## Struktur Direktori

```text
serbagadaimulia/
├── application/            # Core aplikasi Laravel 11
│   ├── app/                # Controllers (FrontEnd & BackEnd), Models, Utils
│   ├── config/             # Konfigurasi Laravel
│   ├── database/           # Migrations, seeders, dan factories
│   ├── resources/views/    # Blade views (frontend & admin)
│   ├── routes/web.php      # Definisi route frontend & admin
│   ├── composer.json       # Dependensi PHP
│   └── package.json        # Dependensi Vite / Node.js
├── serbamulia/             # Aset frontend utama (style.css, theme.js, assets/)
├── backend/                # Aset admin panel
├── frontend/               # Aset frontend tambahan
├── storage/                # File upload & storage publik
├── .docker/                # Konfigurasi Dockerfile PHP & Nginx
├── docker-compose.yml      # Setup container app & web (Nginx port 8024)
└── index.php               # Entry point aplikasi
```

---

## Fitur Utama

### Halaman Publik (Frontend)
- **Beranda (`/`)**: Hero slider, ringkasan layanan, keunggulan, testimoni, dan CTA WhatsApp.
- **Tentang Kami (`/about`)**: Profil perusahaan, visi misi, nilai perusahaan, area layanan, dan legalitas.
- **Produk & Layanan (`/services`, `/product/{slug}`)**: Daftar produk gadai elektronik dan detail masing-masing layanan.
- **Simulasi Taksiran (`/simulasi`)**: Cek estimasi rentang pencairan gadai elektronik dengan fitur pencarian autocomplete (`/simulasi/search`), chip populer, tampilan responsif mobile, dan tombol pengajuan langsung ke WhatsApp.
- **Lokasi Cabang (`/outlet`)**: Pencarian cabang, filter per wilayah/provinsi, peta interaktif Leaflet dengan deteksi cabang terdekat (*geolocation*), petunjuk arah Google Maps, dan WhatsApp cabang.
- **Karir (`/career`)**: Daftar lowongan kerja, detail posisi, serta form pengiriman lamaran.
- **Artikel (`/article`)**: Berita, tips, dan edukasi seputar gadai elektronik.
- **Hubungi Kami (`/contact`)**: Form pesan kontak dan informasi kontak resmi.

### Panel Admin (`/admin`)
- Dashboard & notifikasi
- Manajemen konten halaman **Beranda**, **Tentang**, dan **Produk & Layanan**
- Manajemen **Outlet / Cabang**, **Provinsi**, dan **Lokasi**
- Manajemen **Karir & Lamaran**, **Artikel**, **Promo**, dan **Kontak Masuk**
- Manajemen **Orders**, **Members**, **Categories**, **Units**, **Users**, dan **Settings**
- Ekspor data ke Excel dan tabel server-side menggunakan DataTables

---

## Cara Menjalankan

### 1. Menggunakan Docker (Direkomendasikan)

Pastikan Docker dan Docker Compose sudah terpasang, lalu jalankan dari root repository:

```bash
docker compose up -d --build
```

Secara default, Nginx berjalan di port `8024` (dapat diubah melalui environment variable `APP_PORT`):

```text
http://localhost:8024
```

Untuk menjalankan perintah Artisan atau Composer di dalam container:

```bash
docker exec -it serbagadai-app composer install
docker exec -it serbagadai-app php artisan key:generate
docker exec -it serbagadai-app php artisan migrate
```

### 2. Menjalankan Secara Lokal (Tanpa Docker)

1. Masuk ke folder `application/`:
   ```bash
   cd application
   ```
2. Salin file environment dan sesuaikan konfigurasi database:
   ```bash
   cp .env.example .env
   ```
3. Install dependensi PHP dan JavaScript:
   ```bash
   composer install
   npm install
   ```
4. Generate app key dan jalankan migrasi database:
   ```bash
   php artisan key:generate
   php artisan migrate
   ```
5. Jalankan server pengembangan:
   ```bash
   php artisan serve
   ```
   (Opsional) Jika mengembangkan aset Vite:
   ```bash
   npm run dev
   ```

---

## Route Utama

| Halaman | Path | Nama Route |
| :--- | :--- | :--- |
| Beranda | `/` | `home` |
| Tentang | `/about` | `about` |
| Produk & Layanan | `/services` | `services` |
| Detail Produk | `/product/{slug?}` | `product.detail` |
| Simulasi Taksiran | `/simulasi` | `simulasi` |
| Lokasi Cabang | `/outlet` | `outlet` |
| Karir | `/career` | `career` |
| Artikel | `/article` | `article` |
| Hubungi Kami | `/contact` | `contact` |
| Login Admin | `/admin/login` | `admin.login` |
| Dashboard Admin | `/admin` | `admin.dashboard` |
