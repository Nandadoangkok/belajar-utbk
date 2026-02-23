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
    <title>Prediksi Soal - Belajar UTBK</title>
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

        .prediksi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .prediksi-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            border-top: 5px solid #667eea;
        }

        .prediksi-card h3 {
            color: #333;
            margin-bottom: 10px;
        }

        .prediksi-card .mapel {
            display: inline-block;
            padding: 5px 12px;
            background: #667eea;
            color: white;
            border-radius: 20px;
            font-size: 12px;
            margin-bottom: 15px;
        }

        .prediksi-card p {
            color: #666;
            margin-bottom: 15px;
        }

        .prediksi-card .info {
            display: flex;
            justify-content: space-between;
            color: #999;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .btn-lihat {
            display: inline-block;
            padding: 10px 20px;
            background: #667eea;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            width: 100%;
            text-align: center;
        }

        .btn-lihat:hover {
            background: #5a6fd6;
        }

        .hot {
            border-top: 5px solid #ff4757;
        }

        .hot .mapel {
            background: #ff4757;
        }

        .hot .btn-lihat {
            background: #ff4757;
        }

        .hot .btn-lihat:hover {
            background: #ff6b7a;
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
            <h2>🎯 Prediksi Soal UTBK</h2>
            <p>Prediksi soal UTBK terkini berdasarkan analisis tahun sebelumnya</p>
        </div>

        <div class="prediksi-grid">
            <div class="prediksi-card hot">
                <span class="mapel">Matematika</span>
                <h3>Prediksi Matematika TKA Saintek 2024</h3>
                <p>Soal prediksi dengan tingkat kesulitan tinggi</p>
                <div class="info">
                    <span>📝 25 Soal</span>
                    <span>🔥 Hot</span>
                </div>
                <a href="#" class="btn-lihat">Lihat Prediksi</a>
            </div>

            <div class="prediksi-card">
                <span class="mapel">Fisika</span>
                <h3>Prediksi Fisika TKA Saintek 2024</h3>
                <p>Materi Termodinamika dan Listrik Magnet</p>
                <div class="info">
                    <span>📝 20 Soal</span>
                    <span>📅 Baru</span>
                </div>
                <a href="#" class="btn-lihat">Lihat Prediksi</a>
            </div>

            <div class="prediksi-card">
                <span class="mapel">Kimia</span>
                <h3>Prediksi Kimia TKA Saintek 2024</h3>
                <p>Reaksi Redoks dan Elektrokimia</p>
                <div class="info">
                    <span>📝 18 Soal</span>
                    <span>📅 Baru</span>
                </div>
                <a href="#" class="btn-lihat">Lihat Prediksi</a>
            </div>

            <div class="prediksi-card">
                <span class="mapel">TPS</span>
                <h3>Prediksi TPS Penalaran 2024</h3>
                <p>Penalaran Logis dan Kuantitatif</p>
                <div class="info">
                    <span>📝 30 Soal</span>
                    <span>⭐ Populer</span>
                </div>
                <a href="#" class="btn-lihat">Lihat Prediksi</a>
            </div>

            <div class="prediksi-card">
                <span class="mapel">Sejarah</span>
                <h3>Prediksi Sejarah Soshum 2024</h3>
                <p>Sejarah Indonesia dan Dunia</p>
                <div class="info">
                    <span>📝 22 Soal</span>
                    <span>📅 Baru</span>
                </div>
                <a href="#" class="btn-lihat">Lihat Prediksi</a>
            </div>

            <div class="prediksi-card">
                <span class="mapel">Ekonomi</span>
                <h3>Prediksi Ekonomi Soshum 2024</h3>
                <p>Makroekonomi dan Mikroekonomi</p>
                <div class="info">
                    <span>📝 20 Soal</span>
                    <span>📅 Baru</span>
                </div>
                <a href="#" class="btn-lihat">Lihat Prediksi</a>
            </div>
        </div>
    </div>
</body>
</html>
