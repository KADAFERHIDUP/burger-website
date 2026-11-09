# Burger: Toko Burger Online (CodeIgniter 4 + MySQL)

Website toko burger dengan keranjang belanja, checkout, dan panel admin. Dibuat oleh **Ahmad Umraithi** untuk portofolio, menggunakan **CodeIgniter 4**, **PHP 8.1+**, dan **MySQL**.

Folder ini adalah bagian **backend** dari repo [burger-website](../). Versi statis (frontend) online di GitHub Pages: https://burger.kadaferhidup.my.id

## Fitur

**Pembeli**
- Daftar menu dari database, pencarian menu (langsung saat mengetik dan lewat server)
- Keranjang belanja di session: tambah, ubah jumlah, hapus
- Checkout dengan validasi form, pesanan disimpan ke database dalam satu transaksi
- Halaman pesanan berisi kode unik (contoh `BRG-261107-4F2A`) dan tombol konfirmasi WhatsApp yang sudah berisi rincian pesanan
- Form kontak yang tersimpan ke database

**Admin** (`/admin`)
- Login dengan password ter-hash (`password_hash`) dan proteksi CSRF di semua form
- Dashboard: pesanan baru, total pesanan, pendapatan, jumlah menu, pesan belum dibaca
- Kelola menu: tambah, edit, upload foto, tandai habis/tersedia, hapus
- Kelola pesanan: filter per status, detail pesanan, ubah status (baru, diproses, diantar, selesai, batal), chat pelanggan via WhatsApp
- Kotak pesan dari form kontak

## Struktur penting

```
app/
├── Config/Burger.php          data toko (nama, WhatsApp, alamat)
├── Config/Routes.php          semua route
├── Controllers/               Home, Cart, Checkout, Contact, Auth, Admin/*
├── Database/Migrations/       tabel users, menus, orders, order_items, messages
├── Database/Seeds/            data menu awal + akun admin
├── Filters/AdminAuth.php      wajib login + cek CSRF untuk /admin
├── Helpers/burger_helper.php  rupiah(), wa_url(), status pesanan
├── Libraries/Cart.php         keranjang di session
├── Models/                    model tiap tabel
└── Views/                     tampilan pembeli (shop/), admin (admin/), login (auth/)
public/                        css, js, images
```

## Cara menjalankan di laptop

Yang dibutuhkan: **XAMPP atau Laragon** (PHP 8.1+ dan MySQL) dan **Composer**.

1. Clone repo ini, lalu masuk ke folder `backend`:
   ```
   git clone https://github.com/KADAFERHIDUP/burger-website.git
   cd burger-website/backend
   ```
2. Jalankan installer. Script ini mengunduh CodeIgniter 4 dan membuat file `.env`:
   - Windows: `install.bat`
   - Linux/Mac: `./install.sh`
3. Nyalakan **MySQL** di XAMPP/Laragon. Kalau user/password MySQL kamu bukan `root` tanpa password, ubah di file `.env`.
4. Buat database, tabel, dan data awal:
   ```
   php spark db:create burger_db
   php spark migrate
   php spark db:seed DatabaseSeeder
   ```
5. Jalankan server:
   ```
   php spark serve
   ```
   Buka **http://localhost:8080** untuk website dan **http://localhost:8080/admin** untuk panel admin.

### Login admin awal
- Email: `umraithi769@gmail.com`
- Password: `burger123`

Ganti password ini sebelum dipakai serius: ubah `ADMIN_PASSWORD` di `.env` sebelum langkah seeding. Kalau sudah terlanjur di-seed, kosongkan tabel `users`, lalu jalankan `php spark db:seed AdminSeeder` lagi.

## Masalah yang sering muncul

| Pesan error | Solusi |
|---|---|
| `ext-intl` / `Class "Locale" not found` | Buka `php.ini` di XAMPP, hapus tanda `;` di depan `extension=intl`, lalu restart Apache |
| `Unable to connect to the database` | Pastikan MySQL menyala dan isi `database.default.*` di `.env` benar |
| Foto menu gagal diupload | Pastikan folder `public/images/menu` ada dan bisa ditulis |
| Halaman `404` untuk `/keranjang` | Pastikan `app.indexPage = ''` di `.env`, atau buka lewat `php spark serve` |

## Ubah data toko

Nomor WhatsApp, email, dan alamat ada di `app/Config/Burger.php`. Menu dan harga dikelola dari panel admin.
