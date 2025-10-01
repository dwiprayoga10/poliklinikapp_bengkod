## ⚙️ Lingkungan Pengembangan: Laragon, Composer, & VS Code

Pada modul ini, dijelaskan bahwa langkah awal adalah melakukan instalasi **XAMPP** sebagai lingkungan pengembangan.  
Namun, saya menggunakan **Laragon** sebagai pengganti XAMPP.

> 💡 Laragon telah berhasil diinstal dan dikonfigurasi di perangkat saya.  
> Berikut tampilan dan pengaturannya dapat dilihat pada screenshot di bawah ini.

<p align="center">
  <img src="./gambar/laragon.png" alt="Tampilan Laragon" width="600">
</p>

---

Selain itu, saya juga telah menginstal **Composer** sebagai dependency manager untuk Laravel, serta **Visual Studio Code (VS Code)** sebagai text editor utama dalam pengembangan proyek.

> 🧩 Berikut adalah tampilan instalasi **Composer** dan **VS Code**:

<p align="center">
  <img src="./gambar/composer.png" alt="Tampilan Composer" width="600">
</p>

<p align="center">
  <img src="./gambar/vscode.png" alt="Tampilan VS Code" width="600">
</p>

## 🧱 Modul 2: Desain Database & Migrasi Laravel

Pada modul ini, fokus utama adalah **mendesain struktur database** serta memahami cara kerja **migrasi di Laravel**.  
Migrasi Laravel memudahkan kita dalam membuat, mengubah, dan mengelola tabel database menggunakan kode, sehingga lebih **terstruktur**, **terkontrol**, dan **mudah untuk diubah di masa depan.**

### 💡 Langkah-langkah yang dilakukan:
1. **Mendesain struktur database** sesuai kebutuhan proyek (misalnya tabel `pasien`, `dokter`, `poli`, dan `kunjungan`).
2. Membuat **file migrasi** menggunakan perintah artisan:
   ```bash
   php artisan make:migration create_nama_tabel_table
Menyesuaikan kolom pada file migrasi di folder database/migrations.

Menjalankan migrasi untuk membuat tabel di database:

bash
Salin kode
php artisan migrate
Mengecek hasilnya di database menggunakan phpMyAdmin (melalui Laragon).

📸 Berikut contoh hasil desain database dan proses migrasi Laravel:

<p align="center"> <img src="./gambar/database_design.png" alt="Desain Database" width="600"> </p> <p align="center"> <img src="./gambar/migrasi_laravel.png" alt="Proses Migrasi Laravel" width="600"> </p> ```
