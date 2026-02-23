<?php
session_start();
include 'service/database.php';

// Cek jika belum login, redirect ke login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];

// Get current datetime with timezone WIB (UTC+7)
$timezone = new DateTimeZone('Asia/Jakarta');
$current_datetime = new DateTime('now', $timezone);
$current_date = $current_datetime->format('Y-m-d');
$current_time = $current_datetime->format('H:i:s');

// Query to check available tryouts within the period
$sql = "SELECT * FROM tryout_periods 
        WHERE test_date = ? 
        AND start_time <= ? 
        AND end_time >= ? 
        AND is_active = TRUE";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $current_date, $current_time, $current_time);
$stmt->execute();
$result = $stmt->get_result();

$available_tryouts = [];
$tps_available = false;
$literasi_available = false;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $available_tryouts[] = $row;
        if ($row['tryout_type'] === 'TPS') {
            $tps_available = true;
        } else {
            $literasi_available = true;
        }
    }
}

// Group tryouts by type
$tps_tests = array_filter($available_tryouts, function($t) { return $t['tryout_type'] === 'TPS'; });
$literasi_tests = array_filter($available_tryouts, function($t) { return $t['tryout_type'] === 'Literasi'; });

// Format date for display
function formatDate($date) {
    $datetime = new DateTime($date);
    $dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    $monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    
    $dayIndex = (int)$datetime->format('w');
    $monthIndex = (int)$datetime->format('n') - 1;
    
    return $dayNames[$dayIndex] . ', ' . $datetime->format('d') . ' ' . $monthNames[$monthIndex] . ' ' . $datetime->format('Y');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Try Out - Belajar UTBK</title>
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

        .user-info {
            color: #666;
            font-size: 14px;
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

        .current-time {
            background: #fff3cd;
            color: #856404;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .tryout-section {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            margin-bottom: 30px;
        }

        .tryout-section h3 {
            color: #11998e;
            font-size: 24px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #11998e;
        }

        .tryout-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .tryout-card {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 12px;
            border-left: 5px solid #11998e;
            text-align: center;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .tryout-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }

        .tryout-card h4 {
            color: #333;
            margin-bottom: 10px;
            font-size: 18px;
        }

        .tryout-card .jumlah-soal {
            color: #666;
            margin-bottom: 8px;
        }

        .tryout-card .waktu {
            color: #999;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .btn-mulai {
            display: inline-block;
            padding: 12px 24px;
            background: #11998e;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: transform 0.2s;
        }

        .btn-mulai:hover {
            transform: translateY(-2px);
            background: #0f8a80;
        }

        .btn-disabled {
            display: inline-block;
            padding: 12px 24px;
            background: #6c757d;
            color: white;
            border-radius: 8px;
            font-weight: 600;
            cursor: not-allowed;
        }

        .not-available {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            text-align: center;
        }

        .not-available h3 {
            color: #dc3545;
            font-size: 24px;
            margin-bottom: 15px;
        }

        .not-available p {
            color: #666;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .not-available .next-period {
            background: #e7f3ff;
            padding: 20px;
            border-radius: 10px;
            color: #0056b3;
        }

        .period-info {
            background: #e7f3ff;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            color: #0056b3;
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><img src="image/logo.png" alt="Logo"> Belajar UTBK</h1>
            <div style="display: flex; align-items: center; gap: 20px;">
<span class="user-info"><?php echo htmlspecialchars($username); ?></span>
                <a href="main.php" class="back-btn">← Kembali ke Menu</a>
            </div>
        </div>

        <div class="page-title">
            <h2>✏️ Try Out UTBK</h2>
            <p>Latihan soal UTBK dengan timer untuk mengukur kemampuan</p>
        </div>

        <div class="current-time">
            🕐 Waktu Saat Ini: <?php echo formatDate($current_date) . ' ' . $current_time; ?>
        </div>

        <?php if ($tps_available || $literasi_available): ?>
            
            <?php if ($tps_available): ?>
            <div class="tryout-section">
                <h3>📊 Tes Potensi Skolastik (TPS)</h3>
                <div class="period-info">
                    Periode Aktif: 
                    <?php 
                    $unique_dates = array_unique(array_map(function($t) { return $t['test_date']; }, $tps_tests));
                    foreach ($unique_dates as $date) {
                        echo formatDate($date) . ' (07.00 - 18.00)<br>';
                    }
                    ?>
                </div>
                <div class="tryout-grid">
                    <?php foreach ($tps_tests as $test): ?>
                    <div class="tryout-card">
                        <h4><?php echo htmlspecialchars($test['sub_test_name']); ?></h4>
                        <p class="jumlah-soal"><?php echo $test['jumlah_soal']; ?> Soal</p>
                        <p class="waktu">Waktu: <?php echo $test['waktu_menit']; ?> menit</p>
                        <a href="#" class="btn-mulai">Mulai Try Out</a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($literasi_available): ?>
            <div class="tryout-section">
                <h3>📚 Literasi dan Penalaran Matematika</h3>
                <div class="period-info">
                    Periode Aktif: 
                    <?php 
                    $unique_dates = array_unique(array_map(function($t) { return $t['test_date']; }, $literasi_tests));
                    foreach ($unique_dates as $date) {
                        echo formatDate($date) . ' (07.00 - 18.00)<br>';
                    }
                    ?>
                </div>
                <div class="tryout-grid">
                    <?php foreach ($literasi_tests as $test): ?>
                    <div class="tryout-card">
                        <h4><?php echo htmlspecialchars($test['sub_test_name']); ?></h4>
                        <p class="jumlah-soal"><?php echo $test['jumlah_soal']; ?> Soal</p>
                        <p class="waktu">Waktu: <?php echo $test['waktu_menit']; ?> menit</p>
                        <a href="#" class="btn-mulai">Mulai Try Out</a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

        <?php else: ?>
            <div class="not-available">
                <h3>❌ Try Out Tidak Tersedia</h3>
                <p>Saat ini tidak ada periode tryout yang aktif. Silakan coba lagi pada waktu yang ditentukan.</p>
                <div class="next-period">
                    <strong>Jadwal Try Out Berikutnya:</strong><br>
                    📅 Rabu, 25 Februari 2026 (pukul 07.00 - 18.00)<br>
                    📅 Kamis, 26 Februari 2026 (pukul 07.00 - 18.00)
                </div>
            </div>
        <?php endif; ?>

    </div>
</body>
</html>
