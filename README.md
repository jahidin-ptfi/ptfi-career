# 🚀 Fukuryo Career Portal

Aplikasi portal karier dan rekrutmen modern yang dibangun dengan **Laravel 13**, **Tailwind CSS v4**, dan **Alpine.js**. Proyek ini merupakan hasil migrasi total dari aplikasi legacy berbasis **CodeIgniter 3** dan **Bootstrap**.

---

## 📋 Daftar Isi

- [Fitur Utama](#-fitur-utama)
- [Tech Stack](#-tech-stack)
- [Persyaratan Sistem](#-persyaratan-sistem)
- [Instalasi & Setup](#-instalasi--setup)
- [Struktur Database](#-struktur-database)
- [Perintah Artisan Kustom](#-perintah-artisan-kustom)
- [Catatan Migrasi Data](#-catatan-migrasi-data)
- [Struktur Folder Penting](#-struktur-folder-penting)
- [Lisensi](#-lisensi)

---

## ✨ Fitur Utama

### Untuk Kandidat (Public)

- 🔍 **Pencarian & Filter Lowongan**: Cari berdasarkan kata kunci, lokasi, tipe kontrak, dan sistem kerja (Remote/Hybrid/Onsite).
- 📝 **Manajemen Profil**: Edit data diri, alamat (dengan _cascading dropdown_ wilayah Indonesia), foto profil, dan media sosial.
- 📚 **Manajemen Riwayat**: Tambah/edit/hapus pendidikan, pengalaman kerja, kursus, keahlian, dan data keluarga.
- 📄 **Unggah Dokumen**: Unggah CV, KTP, Ijazah (PDF/JPG/PNG) langsung dari halaman profil.
- 📨 **Sistem Lamaran**: Melamar lowongan sekali klik (dengan validasi kelengkapan profil otomatis).
- 📊 **Riwayat Lamaran**: Pantau status lamaran (Applied, Interview, Diterima, Ditolak) dengan progress bar kelengkapan profil.
- 🌙 **Dark/Light Mode**: Tema yang nyaman digunakan siang dan malam.

### Untuk Admin/HRD (Coming Soon)

- 🛠️ Panel Admin untuk mengelola lowongan.
- 👥 Manajemen status lamaran kandidat.
- 📝 Catatan hasil wawancara (`JobInterviewNote`).
- Fitur lain on development

---

## 🛠️ Tech Stack

| Kategori             | Teknologi                                                                |
| -------------------- | ------------------------------------------------------------------------ |
| **Backend**          | Laravel 13 (PHP 8.3+)                                                    |
| **Frontend**         | Tailwind CSS v4, Alpine.js                                               |
| **Build Tool**       | Vite 8                                                                   |
| **Database**         | MySQL                                                                    |
| **Library Tambahan** | Flatpickr, `@mikesha/flatpickr-year-select-plugin`, `laravolt/indonesia` |

---

## 💻 Persyaratan Sistem

- **PHP** >= 8.3
- **Composer** >= 2.10
- **Node.js** >= 20 & **NPM** >= 10
- **MySQL** >= 8.0
- Ekstensi PHP: `bcmath`, `ctype`, `fileinfo`, `json`, `mbstring`, `openssl`, `pdo`, `tokenizer`, `xml`

---

## 🚀 Instalasi & Setup

### 1. Clone & Install Dependensi

```bash
git clone <repository-url> career
cd career
composer install
npm install
```
