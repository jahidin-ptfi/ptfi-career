CARA SETUP

Skenario A: Import Pertama Kali (Database Kosong)

```sh
php artisan import:all-legacy --fresh
```

Ini akan:

1. Meminta konfirmasi (karena --fresh akan hapus semua tabel).
2. Reset semua tabel (migrate:fresh).
3. Seed Laravolt (provinces, cities, districts, villages).
4. Import 15.371 user + profil.
5. Import 17 lowongan.
6. Import semua pendidikan, pengalaman, keluarga, dll.

Skenario B: Update Data (Tanpa Hapus Database)

```sh
php artisan import:all-legacy
```

Ini akan menambahkan data baru tanpa menghapus yang sudah ada (menggunakan insertOrIgnore dan upsert).

Skenario C: Mode Otomatis (Tanpa Konfirmasi, untuk CI/CD)

```sh
php artisan import:all-legacy --fresh --force
```

APP NOTES :

# Catatan Migrasi Aplikasi: CodeIgniter 3 ke Laravel 13

Notes ini mencatat seluruh proses, keputusan teknis, masalah yang dihadapi, dan solusi yang diterapkan selama migrasi aplikasi career dari **CodeIgniter 3 (CI3)** ke **Laravel 13**.

Tanggal Mulai Migrasi: **Oktober 2026**

---

## 1. Strategi Migrasi

### Pendekatan: Strangler Fig Pattern (Bertahap)

Menulis ulang seluruh aplikasi sekaligus (_Big Bang Rewrite_), dengan menggunakan pendekatan bertahap:

1. **Aplikasi CI3 lama tetap berjalan** selama proses migrasi.
2. **Aplikasi Laravel baru dibangun di sampingnya**, modul demi modul.
3. Setelah modul di Laravel stabil dan teruji, routing Nginx diarahkan ke Laravel.
4. Modul lama di CI3 di-_retire_ satu per satu.

### Alasan Pemilihan

- Mengurangi risiko kehilangan data dan _downtime_.
- Tim bisa menguji setiap modul secara independen sebelum go-live.
- Jika ada bug di Laravel, aplikasi lama masih bisa dijadikan _fallback_.

---

## 2. Lingkungan & Stack

| Komponen       | CI3 (Lama)            | Laravel 13 (Baru)              |
| -------------- | --------------------- | ------------------------------ |
| **Backend**    | CodeIgniter 3 (PHP 7) | Laravel 13 (PHP 8.3+)          |
| **Frontend**   | Bootstrap 4 + jQuery  | Tailwind CSS v4 + Alpine.js    |
| **Build Tool** | Manual (assets)       | Vite 8                         |
| **Database**   | MySQL (`fk_career`)   | MySQL (`career`)               |
| **Auth**       | Custom session        | Laravel Auth + Bcrypt          |
| **Wilayah**    | Tabel `wilayah` (BPS) | Package `laravolt/indonesia`   |
| **Datepicker** | Bootstrap Datepicker  | Flatpickr + Year Select Plugin |

---

## 3. Keputusan Desain Database

### 3.1 Normalisasi & Relasi Modern

Database CI3 lama menggunakan `username` sebagai _foreign key_ di hampir semua tabel. Kami memutuskan untuk menggunakan **`user_id`** (integer) di Laravel demi:

- **Integritas Data**: ID tidak pernah berubah, sedangkan username bisa diubah user.
- **Performa**: JOIN dengan integer lebih cepat daripada string.
- **Standar Laravel**: Eloquent dirancang untuk relasi berbasis ID.

### 3.2 Pemisahan Tabel Profil

Tabel `user_profil` di CI3 memiliki 25+ kolom. Kami **memisahkannya** menjadi:

- **`users`**: Data autentikasi inti (`username`, `email`, `password`, `role`, `is_active`).
- **`user_profiles`**: Data biodata lengkap (alamat, KTP, kontak, medsos).
- **Tabel relasi terpisah** untuk pendidikan, pengalaman, keluarga, dll.

**Alasan**:

- Tabel `users` menjadi ramping dan cepat saat proses _login_ (tidak perlu _load_ 25+ kolom).
- Data profil yang berat hanya dimuat saat user membuka halaman profil.

### 3.3 Pemecahan Tabel Riwayat

Tabel-tabel CI3 yang menampung banyak baris per user dipecah menjadi tabel terpisah dengan relasi `hasMany`:

| CI3                           | Laravel                   | Relasi                        |
| ----------------------------- | ------------------------- | ----------------------------- |
| `p_pendidikan`                | `user_educations`         | `User hasMany UserEducation`  |
| `p_pengalaman_kerja`          | `user_experiences`        | `User hasMany UserExperience` |
| `p_kursus`                    | `user_courses`            | `User hasMany UserCourse`     |
| `p_skill` + `tb_skill`        | `user_skills` + `skills`  | Many-to-Many via pivot        |
| `p_keluarga1` + `p_keluarga2` | `user_families`           | Digabung + kolom `tipe`       |
| `p_kontak_darurat`            | `user_emergency_contacts` | `User hasMany ...`            |

### 3.4 Fitur Baru: Dokumen & Interview Note

- **`user_documents`**: Tabel lama `p_dokumen` tidak dipakai di CI3. Kami buat baru dengan relasi `user_id` yang benar.
- **`job_interview_notes`**: Tabel lama `p_interview_notes` hanya berisi `username` (tidak terkait ke lamaran spesifik). Kami **tidak migrasi data lamanya**, dan membuat tabel baru yang terhubung ke `job_application_id` agar catatan wawancara tidak tercampur antar-lowongan.

---

## 4. Proses Impor Data

### 4.1 Perintah Artisan Kustom

Semua migrasi data dilakukan via Artisan Command agar dapat diulang (_idempotent_):

```bash
php artisan import:all-legacy --fresh --force
```
