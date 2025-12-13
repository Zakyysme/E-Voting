# 🗳️ Sistem E-Voting Berbasis Laravel

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)

Sistem E-Voting ini adalah aplikasi berbasis web yang dibangun menggunakan framework **Laravel**. Aplikasi ini dirancang untuk memfasilitasi proses pemilihan umum (Ketua OSIS, Kepala Desa, atau Organisasi) secara digital, aman, transparan, dan *real-time*.

## ✨ Fitur Utama

### 👥 Panel Admin
* **Dashboard Statistik:** Melihat jumlah pemilih, kandidat, dan status suara secara *real-time*.
* **Manajemen Kandidat:** Tambah, edit, dan hapus data kandidat (termasuk foto & visi misi).
* **Manajemen Pemilih (Voters):** Import data pemilih, generate token/password unik.
* **Manajemen Posisi:** Mengatur kategori pemilihan (misal: Ketua, Wakil, Sekretaris).
* **Laporan Hasil:** Cetak hasil pemilihan dalam format PDF/Excel.

### 👤 Panel Pemilih (User)
* **Login Aman:** Autentikasi menggunakan Token/NIS/Email.
* **E-Ballot Interface:** Antarmuka pemilihan yang mudah digunakan (*user-friendly*).
* **Konfirmasi Suara:** Mencegah kesalahan pemilihan sebelum submit.
* **Pencegahan Double Vote:** Sistem memastikan satu akun hanya bisa memilih satu kali.

## 🛠️ Teknologi yang Digunakan

* **Backend:** Laravel 10/11 (PHP)
* **Frontend:** Blade Templates, Bootstrap 5 / Tailwind CSS (Sesuaikan)
* **Database:** MySQL
* **Scripting:** JavaScript (jQuery/Alpine.js)
* **Chart:** Chart.js (Untuk visualisasi hasil suara)

## ⚙️ Persyaratan Sistem

Sebelum menjalankan proyek ini, pastikan komputer Anda memiliki:

* PHP >= 8.1
* Composer
* MySQL / MariaDB
* Node.js & NPM (Opsional, jika menggunakan Vite)

## 🚀 Panduan Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek di komputer lokal Anda:

1.  **Clone Repositori**
    ```bash
    git clone [https://github.com/username-anda/nama-repo-evoting.git](https://github.com/username-anda/nama-repo-evoting.git)
    cd nama-repo-evoting
    ```

2.  **Install Dependensi PHP**
    ```bash
    composer install
    ```

3.  **Install Dependensi Frontend** (Jika menggunakan NPM)
    ```bash
    npm install && npm run build
    ```

4.  **Konfigurasi Environment**
    Duplikat file `.env.example` menjadi `.env`:
    ```bash
    cp .env.example .env
    ```

5.  **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

6.  **Konfigurasi Database**
    Buka file `.env` dan sesuaikan pengaturan database Anda:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=db_evoting
    DB_USERNAME=root
    DB_PASSWORD=
    ```

7.  **Migrasi dan Seeding Data**
    Jalankan perintah ini untuk membuat tabel dan data dummy (Admin default):
    ```bash
    php artisan migrate --seed
    ```

8.  **Jalankan Server Lokal**
    ```bash
    php artisan serve
    ```
    Buka browser dan akses: `http://localhost:8000`

## 🔐 Akun Default (Untuk Testing)

Gunakan akun berikut untuk masuk ke sistem setelah melakukan *seeding*:

| Role | Username / Email | Password |
| :--- | :--- | :--- |
| **Administrator** | `admin@admin.com` | `password` |
| **Pemilih** | `user@user.com` | `password` |

*(Catatan: Ganti password segera setelah deploy ke produksi)*

## 📸 Tangkapan Layar (Screenshots)

| Halaman Login | Dashboard Admin |
| :---: | :---: |
| ![Login](path/to/image.png) | ![Dashboard](path/to/image.png) |

| Halaman Voting | Hasil Suara |
| :---: | :---: |
| ![Voting](path/to/image.png) | ![Result](path/to/image.png) |

## 🤝 Kontribusi

Kontribusi selalu diterima! Silakan buat *Pull Request* atau lapor *Issues* jika menemukan bug.

1.  Fork repositori ini
2.  Buat branch fitur baru (`git checkout -b fitur-keren`)
3.  Commit perubahan Anda (`git commit -m 'Menambahkan fitur keren'`)
4.  Push ke branch (`git push origin fitur-keren`)
5.  Buat Pull Request

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

---
Dibuat dengan ❤️ oleh [Zakyy]
