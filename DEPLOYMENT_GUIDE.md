# Panduan Deploy ke 000WebHost

## Langkah 1: Buat Akun 000WebHost

1. Buka https://www.000webhost.com/
2. Klik "Sign Up" atau "Get Started"
3. Daftar menggunakan email Anda
4. Verifikasi email Anda

## Langkah 2: Buat Website Baru

1. Setelah login, klik "Create New Site"
2. Masukkan nama website (contoh: belajarutbk-anda)
3. Pilih opsi "Upload files"

## Langkah 3: Upload File ke 000WebHost

### Cara A: Upload via FileZilla
1. Download FileZilla dari https://filezilla-project.org/
2. Buka 000WebHost → Settings → FTP Details
3. Catat: Host, Username, Password
4. Buka FileZilla, masukkan detail tersebut
5. Upload semua file dari folder belajarutbk ke `public_html`

### Cara B: Upload via 000WebHost File Manager
1. Login ke 000WebHost
2. Klik "File Manager"
3. Buka folder `public_html`
4. Klik "Upload" dan upload semua file PHP

## Langkah 4: Buat Database MySQL

1. Di 000WebHost dashboard, klik "MySQL Databases"
2. Buat database baru:
   - Database Name: (nama database pilihan Anda)
   - Username: (username database)
   - Password: (password database)
3. Catat informasi tersebut!

## Langkah 5: Konfigurasi Koneksi Database

Edit file `service/database.php` dengan informasi database baru:

```
php
<?php

$hostname = "localhost";
$username = "username_anda_di_000webhost";
$password = "password_anda_di_000webhost";
$database = "nama_database_anda";

$conn = new mysqli(hostname: $hostname, username: $username, password: $password, database: $database);

if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
    die("Connection failed: " . $conn->connect_error);
}

?>
```

## Langkah 6: Buat Tabel Database

1. Di 000WebHost, klik "phpMyAdmin"
2. Pilih database Anda
3. Klik tab "SQL"
4. Copy dan paste kode berikut:

```
sql
-- Tabel Users
CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel Tryout Periods
CREATE TABLE IF NOT EXISTS tryout_periods (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tryout_type ENUM('TPS', 'Literasi') NOT NULL,
    sub_test_name VARCHAR(100) NOT NULL,
    jumlah_soal INT NOT NULL,
    waktu_menit INT NOT NULL,
    test_date DATE NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

5. Klik "Go" atau "Execute"

## Langkah 7: Akses Website

Buka browser dan akses: `https://belajarutbk-anda.000webhostapp.com`

## Troubleshooting

### Error "Connection Failed"
- Periksa kembali username, password, dan nama database di `service/database.php`
- Pastikan nama host adalah `localhost` (bukan IP)

### Error "Table doesn't exist"
- Pastikan Anda sudah menjalankan query SQL di phpMyAdmin
- Refresh halaman setelah membuat tabel

### Error "File not found"
- Pastikan semua file sudah diupload ke `public_html`
- Pastikan `index.php` ada di root `public_html`

## Struktur Database Lengkap

### Tabel: users
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | INT(11) | Primary Key, Auto Increment |
| username | VARCHAR(50) | Unique, NOT NULL |
| email | VARCHAR(100) | Unique, NOT NULL |
| password | VARCHAR(255) | NOT NULL (hash) |
| created_at | TIMESTAMP | Default current timestamp |

### Tabel: tryout_periods
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | INT | Primary Key, Auto Increment |
| tryout_type | ENUM('TPS', 'Literasi') | Jenis tryout |
| sub_test_name | VARCHAR(100) | Nama sub test |
| jumlah_soal | INT | Jumlah soal |
| waktu_menit | INT | Waktu dalam menit |
| test_date | DATE | Tanggal tryout |
| start_time | TIME | Jam mulai |
| end_time | TIME | Jam selesai |
| is_active | BOOLEAN | Status aktif |
| created_at | TIMESTAMP | Waktu dibuat |

## Catatan Penting

⚠️ **JANGAN upload file `service/database.php` ke GitHub!**
File ini sudah ada di `.gitignore` untuk keamanan.
