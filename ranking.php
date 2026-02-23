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
    <title>Ranking - Belajar UTBK</title>
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
            max-width: 800px;
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

        .ranking-table {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            overflow: hidden;
        }

        .ranking-header {
            display: grid;
            grid-template-columns: 60px 1fr 150px 100px;
            padding: 15px 20px;
            background: #667eea;
            color: white;
            font-weight: 600;
        }

        .ranking-row {
            display: grid;
            grid-template-columns: 60px 1fr 150px 100px;
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            align-items: center;
        }

        .ranking-row:last-child {
            border-bottom: none;
        }

        .ranking-row:hover {
            background: #f8f9fa;
        }

        .ranking-row.gold { background: #fff8e1; }
        .ranking-row.silver { background: #f5f5f5; }
        .ranking-row.bronze { background: #fff3e0; }

        .rank-badge {
            font-size: 20px;
            font-weight: bold;
        }

        .user-name {
            color: #333;
            font-weight: 500;
        }

        .score {
            color: #667eea;
            font-weight: 600;
        }

        .badge-icon {
            font-size: 24px;
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
            <h2>🏅 Ranking</h2>
            <p>Lihat posisi Anda di leaderboard</p>
        </div>

        <div class="ranking-table">
            <div class="ranking-header">
                <span>Peringkat</span>
                <span>Nama</span>
                <span>Skor Total</span>
                <span>Badge</span>
            </div>

            <div class="ranking-row gold">
                <span class="rank-badge">🥇</span>
                <span class="user-name">Ahmad Fauzi</span>
                <span class="score">8.500</span>
                <span class="badge-icon">⭐</span>
            </div>

            <div class="ranking-row silver">
                <span class="rank-badge">🥈</span>
                <span class="user-name">Siti Nurhaliza</span>
                <span class="score">8.200</span>
                <span class="badge-icon">🌟</span>
            </div>

            <div class="ranking-row bronze">
                <span class="rank-badge">🥉</span>
                <span class="user-name">Budi Santoso</span>
                <span class="score">7.950</span>
                <span class="badge-icon">💫</span>
            </div>

            <div class="ranking-row">
                <span class="rank-badge">4</span>
                <span class="user-name">Dewi Lestari</span>
                <span class="score">7.800</span>
                <span class="badge-icon"></span>
            </div>

            <div class="ranking-row">
                <span class="rank-badge">5</span>
                <span class="user-name">Rudi Hermawan</span>
                <span class="score">7.650</span>
                <span class="badge-icon"></span>
            </div>

            <div class="ranking-row">
                <span class="rank-badge">6</span>
                <span class="user-name">Fitri Ayu</span>
                <span class="score">7.500</span>
                <span class="badge-icon"></span>
            </div>

            <div class="ranking-row">
                <span class="rank-badge">7</span>
                <span class="user-name">Joko Widodo</span>
                <span class="score">7.350</span>
                <span class="badge-icon"></span>
            </div>

            <div class="ranking-row">
                <span class="rank-badge">8</span>
                <span class="user-name">Nita Wahyuni</span>
                <span class="score">7.200</span>
                <span class="badge-icon"></span>
            </div>

            <div class="ranking-row">
                <span class="rank-badge">9</span>
                <span class="user-name">Hendra Pratama</span>
                <span class="score">7.050</span>
                <span class="badge-icon"></span>
            </div>

            <div class="ranking-row">
                <span class="rank-badge">10</span>
                <span class="user-name">Lina Susilowati</span>
                <span class="score">6.900</span>
                <span class="badge-icon"></span>
            </div>
        </div>
    </div>
</body>
</html>
