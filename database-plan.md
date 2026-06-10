# Rencana Struktur dan Relasi Database Telemedisin

Dokumen ini berisi rancangan arsitektur database untuk sistem telemedisin. Sesuai dengan struktur kode sumber yang sudah ada, **penamaan tabel dan kolom tetap menggunakan Bahasa Inggris** untuk mencegah kerusakan sistem (error), namun **semua penjelasan tetap dalam Bahasa Indonesia** agar mudah dipahami.

## 1. Arsitektur Relasi Database

Sistem ini memiliki 3 kelompok data utama:
1. **Data Pengguna & Entitas Utama** (users, patients, doctors)
2. **Data Alur Transaksi** (appointments, payments, consultations, messages)
3. **Data Klinis/Medis** (prescriptions, prescription_items, medical_records)

Berikut adalah detail bagaimana tabel-tabel tersebut saling terhubung:

### Pengguna Inti (Relasi Satu-ke-Satu / One-to-One)

Tabel `users` (Pengguna) yang sudah ada bertindak sebagai pusat login. Namun, pengguna dengan peran *pasien* dan *dokter* membutuhkan data spesifik tambahan.

*   **Tabel `users` (Pengguna)**: Menyimpan data login (`id`, `email`, `password`, `role`).
*   **Tabel `patients` (Pasien)**: Berelasi **1:1** dengan tabel `users`.
    *   Setiap baris memiliki `user_id` yang terhubung ke `users.id`.
    *   Menyimpan data fisik/medis dasar (Tanggal lahir, jenis kelamin, alergi).
*   **Tabel `doctors` (Dokter)**: Berelasi **1:1** dengan tabel `users`.
    *   Setiap baris memiliki `user_id` yang terhubung ke `users.id`.
    *   Menyimpan data profesi dokter (Spesialisasi, Nomor STR/SIP, Tarif, Status ketersediaan).

### Booking & Alur Konsultasi

Siklus transaksi antara pasien dan dokter:

*   **Tabel `appointments` (Janji Temu/Jadwal)**
    *   Berelasi **Banyak-ke-Satu** dengan `patients` (Satu pasien bisa membuat banyak janji).
    *   Berelasi **Banyak-ke-Satu** dengan `doctors` (Satu dokter bisa menerima banyak janji).
    *   Menyimpan jadwal (tanggal, jam) dan nomor antrean.
*   **Tabel `payments` (Pembayaran)**
    *   Berelasi **1:1** dengan `appointments`.
    *   Setiap janji temu membutuhkan satu catatan pembayaran.
*   **Tabel `consultations` (Sesi Konsultasi)**
    *   Berelasi **1:1** dengan `appointments`.
    *   Sesi (ruang konsultasi) dibuat jika janji temu disetujui.
    *   Menyimpan catatan dan diagnosis utama dari dokter.

### Interaksi (Chat/Pesan)

*   **Tabel `messages` (Riwayat Pesan/Chat)**
    *   Berelasi **Banyak-ke-Satu** dengan `consultations` (Satu sesi konsultasi berisi banyak pesan).
    *   Berelasi **Banyak-ke-Satu** dengan `users` (Siapa pengirim pesan tersebut).
    *   Menyimpan isi teks atau lampiran gambar dari pasien maupun dokter.

### Tindakan Klinis (Resep & Rekam Medis)

Dokumen medis yang dihasilkan setelah/selama konsultasi:

*   **Tabel `prescriptions` (Kertas Resep)**
    *   Berelasi **1:1** dengan `consultations`.
    *   Menyimpan catatan umum resep dan status apakah obat sudah ditebus.
*   **Tabel `prescription_items` (Daftar Obat dalam Resep)**
    *   Berelasi **Banyak-ke-Satu** dengan `prescriptions`.
    *   Menyimpan rincian obat: nama obat, dosis, frekuensi minum, dan durasi.
*   **Tabel `medical_records` (Rekam Medis)**
    *   Berelasi **Banyak-ke-Satu** dengan `patients` (Satu pasien punya banyak rekam medis historis).
    *   Berelasi **1:1** (Opsional) dengan `consultations`.
    *   Menyimpan ringkasan kesehatan permanen (tekanan darah, berat badan, kesimpulan konsultasi).

### Sistem Universal

*   **Tabel `notifications` (Notifikasi)**
    *   Berelasi **Banyak-ke-Satu** dengan `users`.
    *   Menyimpan pemberitahuan sistem.

---

## 2. Struktur Tabel Lengkap

Berikut adalah spesifikasi kolom untuk masing-masing tabel (Tabel `users` sudah ada dan diabaikan dari daftar pembuatan baru, namun digunakan sebagai referensi).

### 1. Tabel `patients` (Pasien)
* `id` (Kunci Utama / Primary Key)
* `user_id` (Terkait dengan ID Pengguna)
* `date_of_birth` (Tanggal Lahir - DATE)
* `gender` (Jenis Kelamin: 'male' atau 'female')
* `address` (Alamat Lengkap - TEXT)
* `allergies` (Riwayat Alergi - Opsional)
* `pre_existing_conditions` (Penyakit Bawaan - Opsional)
* `emergency_contact` (Nomor Kontak Darurat - VARCHAR)
* *Timestamps* (created_at, updated_at)

### 2. Tabel `doctors` (Dokter)
* `id` (Kunci Utama / Primary Key)
* `user_id` (Terkait dengan ID Pengguna)
* `specialization` (Bidang Spesialisasi - VARCHAR)
* `experience_years` (Lama Pengalaman dalam tahun - INT)
* `str_number` (Nomor STR - VARCHAR)
* `sip_number` (Nomor SIP - VARCHAR)
* `consultation_fee` (Tarif Konsultasi - DECIMAL/INT)
* `is_verified` (Status Verifikasi oleh Admin - BOOLEAN)
* `status` (Ketersediaan: 'online', 'offline', 'busy')
* *Timestamps* (created_at, updated_at)

### 3. Tabel `appointments` (Janji Temu / Booking)
* `id` (Kunci Utama / Primary Key)
* `patient_id` (Terkait dengan ID Pasien)
* `doctor_id` (Terkait dengan ID Dokter)
* `appointment_date` (Tanggal Janji Temu - DATE)
* `time_slot` (Waktu/Jam Janji Temu - TIME)
* `reason` (Keluhan Awal / Alasan Berobat - TEXT)
* `queue_number` (Nomor Antrean - INT)
* `status` (Status Janji: 'pending', 'confirmed', 'cancelled', 'completed')
* *Timestamps* (created_at, updated_at)

### 4. Tabel `consultations` (Sesi Konsultasi)
* `id` (Kunci Utama / Primary Key)
* `appointment_id` (Terkait dengan ID Janji Temu)
* `doctor_notes` (Catatan Pribadi Dokter - TEXT)
* `diagnosis` (Hasil Diagnosis Dokter - TEXT)
* `status` (Status Sesi: 'active', 'ended')
* *Timestamps* (created_at, updated_at)

### 5. Tabel `messages` (Pesan / Chat)
* `id` (Kunci Utama / Primary Key)
* `consultation_id` (Terkait dengan ID Konsultasi)
* `sender_id` (Terkait dengan ID Pengguna pengirim pesan)
* `message` (Isi Pesan Teks - TEXT)
* `attachment_path` (Lokasi File Lampiran - VARCHAR Opsional)
* `is_read` (Status pesan dibaca - BOOLEAN)
* `created_at` (Waktu pesan dikirim)

### 6. Tabel `prescriptions` (Lembar Resep)
* `id` (Kunci Utama / Primary Key)
* `consultation_id` (Terkait dengan ID Konsultasi)
* `status` (Status Resep: 'issued', 'redeemed')
* `notes` (Catatan Tambahan untuk Apoteker - TEXT Opsional)
* *Timestamps* (created_at, updated_at)

### 7. Tabel `prescription_items` (Rincian Obat)
* `id` (Kunci Utama / Primary Key)
* `prescription_id` (Terkait dengan ID Resep)
* `medicine_name` (Nama Obat - VARCHAR)
* `dosage` (Dosis - VARCHAR)
* `frequency` (Aturan Pakai - VARCHAR)
* `duration` (Lama Konsumsi - VARCHAR)
* `quantity` (Jumlah Obat - INT)

### 8. Tabel `medical_records` (Rekam Medis)
* `id` (Kunci Utama / Primary Key)
* `patient_id` (Terkait dengan ID Pasien)
* `consultation_id` (Terkait dengan ID Konsultasi - Opsional)
* `blood_pressure` (Tekanan Darah - VARCHAR Opsional)
* `weight` (Berat Badan - DECIMAL Opsional)
* `height` (Tinggi Badan - DECIMAL Opsional)
* `summary` (Ringkasan Medis - TEXT)
* *Timestamps* (created_at, updated_at)

### 9. Tabel `payments` (Pembayaran)
* `id` (Kunci Utama / Primary Key)
* `appointment_id` (Terkait dengan ID Janji Temu)
* `amount` (Total Tagihan - DECIMAL)
* `payment_method` (Metode Pembayaran - VARCHAR)
* `status` (Status Bayar: 'pending', 'paid', 'failed')
* *Timestamps* (created_at, updated_at)

### 10. Tabel `notifications` (Notifikasi)
* `id` (Kunci Utama / Primary Key)
* `user_id` (Terkait dengan ID Pengguna)
* `title` (Judul Pemberitahuan - VARCHAR)
* `message` (Isi Pemberitahuan - TEXT)
* `is_read` (Status dibaca - BOOLEAN)
* `created_at` (Waktu notifikasi dikirim)

---

## 3. Aturan Penghapusan Data (Foreign Key Constraint)
*   **Hapus Otomatis (Cascade):** Diterapkan pada hierarki data seperti `appointments` -> `consultations` -> `messages` & `prescriptions`.
*   **Cegah Hapus (Restrict):** Diterapkan pada `users`, `patients`, dan `doctors`. Entitas master ini tidak bisa dihapus jika masih memiliki riwayat janji temu atau rekam medis.
