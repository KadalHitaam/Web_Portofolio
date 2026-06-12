readme_content = """# MyProfile Website 🐾

Website portofolio pribadi interaktif berbasis web untuk menampilkan deskripsi diri, hobi, data pengunjung (buku tamu), serta konten multimedia favorit. Projek ini dikembangkan menggunakan **PHP Native** dan **MySQL** sebagai pemenuhan tugas/praktik mahasiswa Teknik Informatika di Universitas Muhammadiyah Sukabumi.

---

## 🚀 Fitur Utama

1. **Halaman Landing Pop-up (`index.php`)**
   - Tampilan selamat datang yang bersih dan minimalis dengan aksen pastel.
   - Menyediakan tombol navigasi langsung menuju halaman login.

2. **Sistem Autentikasi Keamanan (`login.php`)**
   - Form login aman bagi pengguna sebelum mengakses dashboard utama menggunakan kredensial yang tersimpan di database.

3. **Dashboard Profil Berbasis Session (`dashboard.php`)**
   - Menampilkan ringkasan informasi singkat pemilik website (Naufal, mahasiswa Teknik Informatika UMS).

4. **Sistem Buku Tamu Interaktif (`guestbook.php`)**
   - **Form Pengunjung**: Input nama, status kehadiran, fitur *upload file* multi-format, hingga fitur canggih **Tanda Tangan Digital** langsung pada canvas.
   - **Data Pengunjung**: Ditampilkan secara dinamis menggunakan integrasi *DataTables* (lengkap dengan fitur *Search*, *Pagination*, dan modal *Detail* untuk melihat tanda tangan serta file yang diunggah).

5. **Halaman Multimedia (`multimedia.php`)**
   - Pemutar video terintegrasi (menampilkan cuplikan Anime favorit) dan pemutar audio/musik kesukaan secara *native*.

---

## 📸 Cuplikan Tampilan (Screenshots)

Berikut adalah visualisasi alur dan antarmuka dari aplikasi web **MyProfile**:

### 1. Halaman Utama (Landing Page)
Tampilan awal yang menyambut pengunjung saat pertama kali membuka website.
![Landing Page](Screenshot%202026-06-12%20080212.png)

### 2. Halaman Login
Form otentikasi sistem sebelum masuk ke area dashboard.
![Login Page](Screenshot%202026-06-12%20080221.png)

### 3. Dashboard Admin / Profil
Menampilkan data sekilas profil pemilik website setelah berhasil login.
![Dashboard](Screenshot%202026-06-12%20080247.png)

### 4. Manajemen Buku Tamu (Guestbook)
Fasilitas bagi pengunjung untuk mengisi kehadiran, tanda tangan digital, dan mengunggah file pendukung.
![Buku Tamu](Screenshot%202026-06-12%20080256.png)

### 5. Detail Data Pengunjung
Modal pop-up yang menampilkan berkas unggahan dan hasil tanda tangan digital pengunjung.
![Detail Pengunjung](Screenshot%202026-06-12%20080308.png)

### 6. Galeri Multimedia
Ruang interaktif untuk memutar video anime dan musik favorit secara langsung di browser.
![Multimedia](Screenshot%202026-06-12%20080413.jpg)

---

## 🛠️ Struktur Database & Kode Sumber

### Struktur Tabel MySQL (`db_myprofile`)
Projek ini didukung oleh database relasional dengan 3 tabel utama: `buku_tamu`, `file_tamu`, dan `users`.
![Database phpMyAdmin](Screenshot%202026-06-12%20080612.jpg)

### Lingkungan Pengembangan (Development Environment)
- **Code Editor:** Visual Studio Code (VS Code) dengan struktur folder yang rapi (`assets`, `images`, `uploads`).
- **Server Lokal:** Laragon (`webporto.test`).
- **Version Control:** Git terintegrasi langsung dengan GitHub (`KadalHitaam/Web_Portofolio.git`).
![VS Code Environment](Screenshot%202026-06-12%20082403.png)

---

## ⚙️ Teknologi yang Digunakan

- **Backend:** PHP (Native)
- **Database:** MySQL / MariaDB (Dikelola via phpMyAdmin)
- **Frontend Framework:** Bootstrap 5 (dengan Google Fonts - Poppins & Font Awesome)
- **Libraries:** jQuery DataTables, Signature Pad (HTML5 Canvas)
- **Local Server:** Laragon Management Environment
"""

with open("README.md", "w", encoding="utf-8") as f:
    f.write(readme_content)

print("README.md berhasil dibuat!")