# BelajarUTBK - Platform Persiapan UTBK

BelajarUTBK adalah platform web untuk membantu siswa Indonesia mempersiapkan diri menghadapi UTBK (Ujian Tulis Berbasis Komputer). Platform ini menyediakan berbagai fitur seperti tryout, materi pembelajaran, forum diskusi, dan lainnya.

## Fitur Utama

- **Tryout**: Ujian simulasi UTBK dengan berbagai kategori
- **Materi Pembelajaran**: Materi TPS dan Literasi
- **Forum Diskusi**: Tempat bertanya dan berdiskusi dengan sesama peserta
- **Prediksi**: Prediksi skor UTBK berdasarkan performansi
- **Progress**: Pantau perkembangan belajar Anda
- **Ranking**: Kompetisi dengan peserta lain

## Struktur Folder

```
belajarutbk/
├── image/              # Gambar dan icon
├── materi/             # Materi pembelajaran
│   ├── literasi/       # Materi literasi
│   └── tps/           # Materi TPS
├── prediksi/          # File prediksi
├── service/           # Layanan database
├── tryout/            # File tryout
├── user/              # File user
├── index.php          # Halaman utama
├── login.php          # Halaman login
├── register.php       # Halaman registrasi
├── main.php           # Dashboard utama
├── materi.php         # Halaman materi
├── tryout.php         # Halaman tryout
├── forum.php          # Halaman forum
├── ranking.php        # Halaman ranking
├── progress.php       # Halaman progress
└── prediksi.php       # Halaman prediksi
```

## Requirements

- PHP 7.4 atau lebih tinggi
- MySQL / MariaDB
- XAMPP (disarankan)

## Instalasi

1. Clone repository ini ke folder htdocs XAMPP Anda:
   
```
bash
   git clone https://github.com/username/belajarutbk.git
   
```

2. Import database dari file SQL (jika ada)

3. Konfigurasi database di `service/database.php`

4. Buka browser dan akses `http://localhost/belajarutbk`

## Kontribusi

Silakan hubungi pengembang jika Anda ingin berkontribusi pada proyek ini.

## Lisensi

Copyright © 2024 BelajarUTBK
