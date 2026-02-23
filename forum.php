<?php
session_start();
include 'service/database.php';

// Cek jika belum login, redirect ke login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Diskusi - Belajar UTBK</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            background: url('image/background.jpg') no-repeat center center fixed;
            background-size: cover;
            padding: 20px;
        }
        
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }

        .header {
            background: white;
            padding: 20px 40px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #333;
            font-size: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .header h1 img {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        .back-btn {
            padding: 10px 20px;
            background: #11998e;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: transform 0.2s;
        }

        .back-btn:hover {
            transform: translateY(-2px);
            background: #0f8a80;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .page-title {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            text-align: center;
            margin-bottom: 30px;
        }

        .page-title h2 {
            color: #333;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .page-title p {
            color: #666;
            font-size: 16px;
        }

        .forum-card {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            margin-bottom: 15px;
            border-left: 5px solid #eb3349;
        }

        .forum-card h3 {
            color: #333;
            margin-bottom: 10px;
        }

        .forum-card p {
            color: #666;
            margin-bottom: 15px;
        }

        .forum-meta {
            display: flex;
            justify-content: space-between;
            color: #999;
            font-size: 14px;
        }

        .btn-buat {
            display: inline-block;
            padding: 12px 24px;
            background: #eb3349;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .btn-buat:hover {
            background: #d63031;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><img src="image/header-icon.png" alt="Logo"> Belajar UTBK</h1>
            <a href="main.php" class="back-btn">← Kembali ke Menu</a>
        </div>

        <div class="page-title">
            <h2>💬 Forum Diskusi</h2>
            <p>Berdiskusi dengan peserta lain</p>
        </div>

        <a href="#" class="btn-buat">+ Buat Diskusi Baru</a>

        <div class="forum-card">
            <h3>Tips Belajar Matematika untuk UTBK</h3>
            <p>Saya ingin berbagi tips belajar matematika yang帮我提高成绩...</p>
            <div class="forum-meta">
                <span>👤 Ahmad Fauzi</span>
                <span>15 komentar</span>
            </div>
        </div>

        <div class="forum-card">
            <h3>Prediksi Materi yang Akan Keluar</h3>
            <p>Berdasarkan analisis soal tahun lalu, materi ini kemungkinan...</p>
            <div class="forum-meta">
                <span>👤 Siti Nurhaliza</span>
                <span>23 komentar</span>
            </div>
        </div>

        <div class="forum-card">
            <h3>Strategi Waktu Saat Try Out</h3>
            <p>Bagaimana cara manage waktu saat mengerjakan soal TPS...</p>
            <div class="forum-meta">
                <span>👤 Budi Santoso</span>
                <span>8 komentar</span>
            </div>
        </div>

        <div class="forum-card">
            <h3>Rekomendasi Buku Latihan</h3>
            <p>Buku latihan apa yang bagus untuk persiapan UTBK Saintek...</p>
            <div class="forum-meta">
                <span>👤 Dewi Lestari</span>
                <span>12 komentar</span>
            </div>
        </div>

        <div class="forum-card">
            <h3>Pengalaman Saat Ujian</h3>
            <p>Sharing pengalaman saat mengikuti ujian UTBK tahun lalu...</p>
            <div class="forum-meta">
                <span>👤 Rudi Hermawan</span>
                <span>18 komentar</span>
            </div>
        </div>
    </div>
</body>
</html>
