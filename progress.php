<?php
session_start();
include 'service/database.php';

// Cek jika belum login, redirect ke login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progress - Belajar UTBK</title>
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

        .progress-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            margin-bottom: 20px;
        }

        .progress-card h3 {
            color: #333;
            margin-bottom: 15px;
        }

        .progress-item {
            margin-bottom: 15px;
        }

        .progress-label {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            color: #555;
        }

        .progress-bar {
            height: 20px;
            background: #e1e1e1;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 10px;
            transition: width 0.5s ease;
        }

        .progress-fill.blue { background: linear-gradient(90deg, #1e3c72, #2a5298); }
        .progress-fill.green { background: linear-gradient(90deg, #11998e, #38ef7d); }
        .progress-fill.orange { background: linear-gradient(90deg, #f093fb, #f5576c); }
        .progress-fill.purple { background: linear-gradient(90deg, #667eea, #764ba2); }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><img src="image/header-icon.png" alt="Logo"> Belajar UTBK</h1>
            <a href="main.php" class="back-btn">← Kembali ke Menu</a>
        </div>

        <div class="page-title">
            <h2>📈 Progress Belajar</h2>
            <p>Lihat perkembangan belajar Anda</p>
        </div>

        <div class="progress-card">
            <h3>📊 Ringkasan Progress</h3>
            
            <div class="progress-item">
                <div class="progress-label">
                    <span>Materi Selesai</span>
                    <span>60%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill blue" style="width: 60%;"></div>
                </div>
            </div>

            <div class="progress-item">
                <div class="progress-label">
                    <span>Try Out Dikerjakan</span>
                    <span>40%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill green" style="width: 40%;"></div>
                </div>
            </div>

            <div class="progress-item">
                <div class="progress-label">
                    <span>Forum Diskusi</span>
                    <span>25%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill orange" style="width: 25%;"></div>
                </div>
            </div>

            <div class="progress-item">
                <div class="progress-label">
                    <span>Prediksi Soal</span>
                    <span>50%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill purple" style="width: 50%;"></div>
                </div>
            </div>
        </div>

        <div class="progress-card">
            <h3>📅 Aktivitas Terakhir</h3>
            <p style="color: #666;">Belum ada aktivitas. Mulai belajar sekarang!</p>
        </div>
    </div>
</body>
</html>
