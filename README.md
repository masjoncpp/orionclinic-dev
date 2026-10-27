<p align="center">
  <img src="public/assets/img/logoorion.png" alt="Orion Clinic Logo" width="120">
</p>

<h1 align="center">🏥 Orion Clinic — Platform Telemedisin</h1>

<p align="center">
  <strong>Sistem konsultasi kesehatan digital berbasis web untuk klinik modern</strong>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-8.2-8892BF?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.2">
  <img src="https://img.shields.io/badge/CodeIgniter-4.7-EF4223?style=for-the-badge&logo=codeigniter&logoColor=white" alt="CodeIgniter 4.7">
  <img src="https://img.shields.io/badge/MariaDB-10.11_LTS-003545?style=for-the-badge&logo=mariadb&logoColor=white" alt="MariaDB 10.11">
  <img src="https://img.shields.io/badge/Docker-Compose-2496ED?style=for-the-badge&logo=docker&logoColor=white" alt="Docker Compose">
  <img src="https://img.shields.io/badge/Tailwind_CSS-CDN-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white" alt="Tailwind CSS">
</p>

---

## 📋 Tentang Proyek

**Orion Clinic** adalah platform telemedisin terpadu yang menghubungkan pasien, dokter, apoteker, dan administrator klinik dalam satu ekosistem digital. Dibangun menggunakan **CodeIgniter 4** dengan antarmuka responsif **Tailwind CSS**, sistem ini mendukung alur konsultasi kesehatan dari booking jadwal hingga penebusan resep obat secara *end-to-end*.

> Proyek ini dikembangkan sebagai bagian dari tugas mata kuliah Semester 5 (SMT5) — Universitas Dian Nuswantoro.

---

## ✨ Fitur Utama

### 👤 Pasien
- Pendaftaran akun & manajemen profil lengkap (alergi, riwayat penyakit, golongan darah)
- Pencarian & booking konsultasi dokter berdasarkan jadwal praktik & filter spesialisasi real-time
- Sistem antrean digital dengan kode unik
- Pembayaran konsultasi dengan upload bukti transfer & cetak invoice
- Chat real-time dengan dokter selama sesi konsultasi (mendukung lampiran gambar & dokumen)
- Riwayat konsultasi, detail rekam medis, & fitur cetak ringkasan medis
- E-resep digital dan penebusan obat
- Pengelolaan data anggota keluarga (*dependents*)
- Notifikasi real-time untuk status booking & resep
- Halaman Wellness interaktif dengan pengingat harian

### 🩺 Dokter
- Dashboard ringkasan jadwal & pasien hari ini
- Manajemen jadwal praktik per hari (Senin–Minggu)
- Persetujuan / penolakan janji temu pasien
- Ruang chat konsultasi dengan pratinjau lampiran file
- Penulisan catatan klinis, tanda vital, diagnosis, tindak lanjut, dan e-resep
- Riwayat lengkap pasien yang pernah ditangani & cetak ringkasan medis
- Toggle status ketersediaan (*Online / Offline*)

### 💊 Farmasi (Apoteker)
- Dashboard penerimaan resep digital dari dokter
- Alur status obat: *Redeemed → Preparing → Ready → Completed*
- Notifikasi otomatis ke pasien saat status obat berubah

### 🛡️ Administrator
- Dashboard statistik klinik (pendapatan, jumlah pasien, jumlah dokter)
- Manajemen akun pengguna (semua role) dengan filter pencarian instan
- Verifikasi & pencabutan verifikasi kredensial dokter (STR/SIP)
- Kelola master spesialisasi dokter
- Laporan keuangan, verifikasi bukti transfer, & cetak laporan transaksi
- Audit log aktivitas admin

---

## 🐳 Menjalankan dengan Docker (Rekomendasi Tim)

Lingkungan pengembangan Docker telah dikonfigurasi agar seluruh anggota tim dapat menjalankan aplikasi tanpa perlu menginstal PHP, Composer, maupun MySQL/MariaDB secara manual di komputer host.

### Arsitektur Container
- **`app` (`orionclinic-app`)**: PHP `8.2-apache-bookworm` dengan `DocumentRoot` pada `public/`, modul `rewrite` & `headers`, ekstensi PHP (`intl`, `mbstring`, `mysqli`, `pdo_mysql`, `gd`, `zip`, `opcache`), serta Composer `2.8`.
- **`db` (`orionclinic-db`)**: `mariadb:10.11` (LTS) dengan *healthcheck* otomatis dan penyimpanan persisten menggunakan named volume `db_data`.

### Langkah-langkah Setup Awal

**1. Instal Docker**
Pastikan **Docker Engine** beserta **Docker Compose plugin** (Linux) atau **Docker Desktop** (Windows/macOS) sudah terpasang dan aktif:
```bash
docker --version
docker compose version
```

**2. Clone Repository**
```bash
git clone https://github.com/masjoncpp/orionclinic-dev.git
cd orionclinic-dev
```

**3. Salin File Konfigurasi Environment**
Salin template `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```

**4. Sesuaikan Konfigurasi Development Lokal (Opsional)**
File `.env` yang disalin dari `.env.example` sudah dikonfigurasi siap pakai untuk Docker:
- Aplikasi berjalan di port host `APP_PORT=8080`.
- Koneksi aplikasi ke database menggunakan hostname internal service Docker `DB_HOST=db` pada port `3306`.
- Port database ke host hanya di-bind ke `127.0.0.1:3307` (`DB_FORWARD_PORT=3307`) agar aman dan tidak bentrok apabila di komputer Anda sudah terinstal MySQL/MariaDB lokal di port `3306`.

**5. Jalankan Aplikasi dengan Satu Perintah Utama**
```bash
docker compose up -d --build
```
Docker akan membangun image `app`, mengunduh `mariadb:10.11`, menginisialisasi database awal, menunggu healthcheck database berstatus `healthy`, lalu menyalakan web server Apache.

**6. Akses Aplikasi**
Buka browser dan kunjungi:
👉 **[http://localhost:8080](http://localhost:8080)**

---

### 🔍 Memeriksa Status & Log Container

Periksa apakah kedua service (`app` dan `db`) berjalan dan berstatus `healthy`:
```bash
docker compose ps
```

Melihat log aktivitas secara *real-time*:
```bash
# Semua service
docker compose logs -f

# Hanya service aplikasi atau database
docker compose logs -f app
docker compose logs -f db
```

---

### 🗄️ Strategi Inisialisasi Database, Migration & Seeder

Proyek ini menggunakan strategi inisialisasi otomatis yang aman dan bebas konflik:
1. **Inisialisasi Otomatis Pertama Kali**:
   Saat volume `db_data` masih kosong (pertama kali `docker compose up` dijalankan), container `db` (`mariadb:10.11`) secara otomatis mengeksekusi file [`orionclinic.sql`](orionclinic.sql) melalui `/docker-entrypoint-initdb.d/01-orionclinic.sql`.
2. **Sinkron dengan CI4 Migration**:
   File `orionclinic.sql` hanya berisi skema tabel dan data *dummy* khusus pengembangan (tanpa data pasien asli) serta sudah mencatat riwayat versi ke tabel `migrations`. Dengan demikian, menjalankan `php spark migrate` setelahnya bersifat **idempotent** (tidak akan membuat tabel duplikat atau error).
3. **Menjalankan Migration & Seeder secara Manual**:
   Apabila ada file migration baru yang ditambahkan oleh anggota tim, jalankan perintah berikut dari dalam container:
   ```bash
   docker compose exec app php spark migrate
   ```
   Untuk menjalankan ulang *seeder* pengembangan (`TelemedicineSeeder` sudah dilengkapi pengecekan duplikasi data):
   ```bash
   docker compose exec app php spark db:seed TelemedicineSeeder
   ```

---

### 🛠️ Perintah Operasional Harian (CLI, Stop, Rebuild, Reset)

**Menjalankan Perintah CLI CodeIgniter (`spark`) & Unit Test (`phpunit`) di Container:**
```bash
# Melihat daftar route
docker compose exec app php spark routes

# Memeriksa status migrasi
docker compose exec app php spark migrate:status

# Menjalankan automated testing (PHPUnit)
docker compose exec app vendor/bin/phpunit --no-coverage
```

**Menghentikan Container Tanpa Menghapus Data Database:**
```bash
docker compose down
```
*(Data pada named volume `db_data` tetap tersimpan dengan aman saat Anda menyalakan kembali dengan `docker compose up -d`).*

**Rebuild Aplikasi Setelah Perubahan Dependency (`composer.json` / `composer.lock`):**
```bash
docker compose up -d --build app
```

**Reset Database Secara Eksplisit (⚠️ PERINGATAN KEHILANGAN DATA):**
> [!CAUTION]
> Perintah di bawah ini akan **menghapus seluruh volume container (`db_data` dan `vendor_data`)** beserta seluruh perubahan data di dalam database Docker. Gunakan hanya jika Anda ingin mengembalikan database ke kondisi awal dari `orionclinic.sql`.

```bash
docker compose down -v
docker compose up -d --build
```

---

### 🩺 Troubleshooting

1. **Port Bentrok (`Bind for 0.0.0.0:8080 failed: port is already allocated`)**
   - **Penyebab**: Port `8080` (atau `3307` untuk forward port DB) sedang dipakai aplikasi lain di host.
   - **Solusi**: Ubah nilai `APP_PORT=8081` (dan `APP_BASE_URL='http://localhost:8081/'`) atau `DB_FORWARD_PORT=3308` di dalam file `.env`, lalu jalankan `docker compose up -d`.
2. **Database Belum Siap / Koneksi Ditolak Saat Startup**
   - **Penyebab**: MariaDB sedang menjalankan proses inisialisasi awal pada volume baru.
   - **Solusi**: Service `app` sudah diatur menggunakan `depends_on: condition: service_healthy`. Periksa progres inisialisasi dengan `docker compose logs -f db` hingga muncul pesan `mariadbd: ready for connections`.
3. **Masalah Permission pada Direktori `writable/` atau `public/uploads/`**
   - **Penyebab**: Kepemilikan file pada *bind mount* berubah di host Linux.
   - **Solusi**: Skrip entrypoint container otomatis mengatur permission `writable/` dan `public/uploads/` saat startup. Anda juga dapat memperbaikinya kapan saja dengan:
     ```bash
     docker compose exec app chown -R www-data:www-data /var/www/html/writable /var/www/html/public/uploads
     docker compose exec app chmod -R 775 /var/www/html/writable /var/www/html/public/uploads
     ```
4. **Konfigurasi `.env` Tidak Terbaca atau Menggunakan `localhost`**
   - **Penyebab**: File `.env` lama memiliki `database.default.hostname = localhost` (di dalam Docker, `localhost` mengacu pada container `app` itu sendiri, bukan container `db`).
   - **Solusi**: Pastikan `DB_HOST=db` dan `database.default.hostname = db` di file `.env`. Variabel environment pada `compose.yaml` juga secara otomatis memprioritaskan `DB_HOST` (`db`) di dalam container.

---

## 🏗️ Arsitektur Database

Sistem menggunakan **15 tabel** yang saling berelasi:

```
users ──┬── patients ──── appointments ──── consultations ──┬── prescriptions ──── prescription_items
        │                      │                │           └── medical_records
        │                      │                └── messages
        │                      └── payments
        ├── doctors ──── doctor_schedules
        ├── family_members
        ├── notifications
        └── audit_logs

specializations (Master Spesialisasi)
```

Diagram lengkap tersedia di [`database-schema.puml`](database-schema.puml) (format PlantUML).

---

## 📁 Struktur Proyek

```
orionclinic-dev/
├── app/
│   ├── Config/            # Konfigurasi framework (Routes, Database, Filters)
│   ├── Constants/         # Konstanta aplikasi (SVG Icons)
│   ├── Controllers/       # Controller utama (Auth, Patient, Doctor, Admin, Pharmacy, Chat)
│   ├── Database/
│   │   ├── Migrations/    # File migrasi skema database
│   │   └── Seeds/         # Seeder data awal (TelemedicineSeeder)
│   ├── Filters/           # Auth & Role middleware
│   ├── Helpers/           # Helper kustom (icon_helper)
│   ├── Models/            # 14 model CodeIgniter 4
│   └── Views/
│       ├── admin/         # Panel manajemen administrator
│       ├── auth/          # Login & register
│       ├── components/    # Sidebar & navigasi responsif
│       ├── doctor/        # Panel konsultasi & jadwal dokter
│       ├── layouts/       # Template utama
│       ├── patient/       # Panel reservasi & riwayat pasien
│       └── pharmacy/      # Panel penebusan resep farmasi
├── public/                # Document root Apache (index.php, .htaccess, assets, CSS, JS)
├── tests/                 # Pengujian otomatis PHPUnit
├── Dockerfile             # Definisi image PHP 8.2 + Apache untuk aplikasi
├── compose.yaml           # Orkestrasi multi-container (app + MariaDB 10.11)
├── .dockerignore          # Aturan eksklusi build context Docker
├── .env.example           # Template konfigurasi environment aman
├── orionclinic.sql        # Skema database & data awal pengembangan
└── database-schema.puml   # Diagram ER (PlantUML)
```

---

## 🛠️ Tech Stack

| Layer | Teknologi |
| :--- | :--- |
| **Backend** | PHP 8.2, CodeIgniter 4.7 |
| **Frontend** | Tailwind CSS (CDN), jQuery 3.7, SweetAlert2 |
| **Database** | MariaDB 10.11 LTS / MySQL dengan Foreign Key Constraints |
| **Container** | Docker & Docker Compose (`php:8.2-apache-bookworm`, `mariadb:10.11`) |
| **Font & Icon** | Plus Jakarta Sans (Google Fonts) & Custom Inline SVG Icon System |

---

## 👥 Tim Pengembang

| Nama | Peran |
| :--- | :--- |
| M. Jottie Ramadhan Putu Sigit | Fullstack Developer |

> **Universitas Dian Nuswantoro** — Semarang, 2026

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).
