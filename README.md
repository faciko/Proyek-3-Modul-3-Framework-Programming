# Activity Manager

Activity Manager adalah aplikasi Laravel untuk mengelola kegiatan, kategori, status publikasi, poster, dan pendaftaran peserta.

## Fitur

- CRUD kegiatan dengan validasi Form Request.
- Relasi Category hasMany Activity dan foreign key `category_id`.
- Kode kegiatan unik, kapasitas positif, serta waktu selesai tidak boleh sebelum waktu mulai.
- Transisi status `draft` ke `published` ke `completed` melalui service.
- Pencarian, filter kategori/status, sorting tanggal, pagination, dan eager loading kategori.
- Soft delete, halaman Trash, dan restore kegiatan.
- Pendaftaran atomik dengan transaction, proteksi email duplikat, validasi status/waktu/kapasitas.
- Upload poster opsional dengan validasi image maksimal 2 MB.

## Menjalankan Proyek

1. Salin konfigurasi environment dan buat application key.

   ```powershell
   Copy-Item .env.example .env
   php artisan key:generate
   ```

2. Pastikan konfigurasi database SQLite pada `.env`, lalu buat file database bila belum ada.

   ```powershell
   New-Item database/database.sqlite -ItemType File -Force
   ```

3. Install dependency dan data awal.

   ```powershell
   composer install
   php artisan migrate --seed
   php artisan storage:link
   ```

4. Jalankan server.

   ```powershell
   php artisan serve
   ```

Buka `http://127.0.0.1:8000/activities` untuk daftar kegiatan dan `/categories` untuk mengelola kategori.

## Pemeriksaan

```powershell
php artisan test
vendor/bin/pint
```

## Struktur Tanggung Jawab

- `StoreActivityRequest` dan `UpdateActivityRequest`: validasi input HTTP.
- `ActivityService`: upload poster dan aturan transisi status.
- `RegistrationService`: aturan pendaftaran dan transaction untuk Registration + `registered_count`.
- `Activity`: relationship, soft delete, serta query scope daftar kegiatan.
- Blade: hanya menampilkan data yang sudah disiapkan controller.
