<?php
session_start();
include 'service/database.php';

// Cek jika belum login, redirect ke login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materi Pembelajaran - Belajar UTBK</title>
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
            background: linear-gradient(135deg, #d0ea66 0%, #fffb00 100%);
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

        /* Accordion Styles */
        .accordion {
            display: grid;
            gap: 15px;
        }

        .accordion-item {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            overflow: hidden;
        }

        .accordion-header {
            padding: 20px 25px;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background 0.3s;
        }

        .accordion-header:hover {
            background: linear-gradient(135deg, #2a5298 0%, #1e3c72 100%);
        }

        .accordion-header h3 {
            font-size: 18px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        h2 img {

            width: 100px;
            height: 100px;
            object-fit: contain;   
        }

        .accordion-icon {
            font-size: 20px;
            transition: transform 0.3s;
        }

        .accordion-item.active .accordion-icon {
            transform: rotate(180deg);
        }

        .accordion-content {
            display: none;
            padding: 0;
        }

        .accordion-item.active .accordion-content {
            display: block;
        }

        .sub-item {
            padding: 15px 25px;
            border-bottom: 1px solid #eee;
            transition: background 0.3s;
        }

        .sub-item:last-child {
            border-bottom: none;
        }

        .sub-item:hover {
            background: #f5f5f5;
        }

        .sub-item a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #333;
            text-decoration: none;
            font-size: 15px;
        }

        .sub-item a:hover {
            color: #1e3c72;
        }

        .sub-item .icon {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><img src="image/logo.png" alt="Logo"> Belajar UTBK</h1>
            <a href="main.php" class="back-btn">← Kembali ke Menu</a>
        </div>

        <div class="page-title">
            <h2><img src="image/icon-materi.png" alt="Logo"></h2>
            <h2> Materi Pembelajaran</h2>
            <p>Kumpulan materi UTBK lengkap untuk persiapan ujian</p>
        </div>

        <div class="accordion">
            <!-- TPS Accordion -->
            <div class="accordion-item">
                <div class="accordion-header" onclick="toggleAccordion(this)">
                    <h3>📊 Tes Potensi Skolastik (TPS)</h3>
                    <span class="accordion-icon">▼</span>
                </div>
                <div class="accordion-content">
                    <div class="sub-item">
                        <a href="materi/tps/penalaran-umum.php">
                            <span class="icon">🧠</span>
                            <span>Penalaran Umum</span>
                        </a>
                    </div>
                    <div class="sub-item">
                        <a href="materi/tps/pengetahuan-umum.php">
                            <span class="icon">📚</span>
                            <span>Pengetahuan dan Pemahaman Umum</span>
                        </a>
                    </div>
                    <div class="sub-item">
                        <a href="materi/tps/bacaan-menulis.php">
                            <span class="icon">📝</span>
                            <span>Kemampuan Memahami Bacaan dan Menulis</span>
                        </a>
                    </div>
                    <div class="sub-item">
                        <a href="materi/tps/pengetahuan-kuantitatif.php">
                            <span class="icon">🔢</span>
                            <span>Pengetahuan Kuantitatif</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tes Literasi Accordion -->
            <div class="accordion-item">
                <div class="accordion-header" onclick="toggleAccordion(this)">
                    <h3>📖 Tes Literasi</h3>
                    <span class="accordion-icon">▼</span>
                </div>
                <div class="accordion-content">
                    <div class="sub-item">
                        <a href="materi/literasi/bahasa-indonesia.php">
                            <span class="icon">🇮🇩</span>
                            <span>Literasi dalam Bahasa Indonesia</span>
                        </a>
                    </div>
                    <div class="sub-item">
                        <a href="materi/literasi/bahasa-inggris.php">
                            <span class="icon">🇬🇧</span>
                            <span>Literasi dalam Bahasa Inggris</span>
                        </a>
                    </div>
                    <div class="sub-item">
                        <a href="materi/literasi/penalaran-matematika.php">
                            <span class="icon">📐</span>
                            <span>Penalaran Matematika</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleAccordion(header) {
            const item = header.parentElement;
            item.classList.toggle('active');
        }
    </script>
</body>
</html>
