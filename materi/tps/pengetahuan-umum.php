<?php
session_start();
include '../../service/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit;
}

$username = $_SESSION['username'];
$topic = "Pengetahuan dan Pemahaman Umum";
$description = "Materi Pengetahuan dan Pemahaman Umum untuk persiapan UTBK";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $topic; ?> - Belajar UTBK</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { min-height: 100vh; background: url('../../image/background.jpg') no-repeat center center fixed; background-size: cover; padding: 20px; }
        body::before { content: ''; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: -1; }
        .header { background: white; padding: 20px 40px; border-radius: 15px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .header h1 { color: #333; font-size: 24px; display: flex; align-items: center; gap: 10px; }
        .header h1 img { width: 40px; height: 40px; object-fit: contain; }
        .back-btn { padding: 10px 20px; background: #11998e; color: white; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; text-decoration: none; transition: transform 0.2s; }
        .back-btn:hover { transform: translateY(-2px); background: #0f8a80; }
        .container { max-width: 1000px; margin: 0 auto; }
        .page-title { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); text-align: center; margin-bottom: 30px; }
        .page-title h2 { color: #333; font-size: 28px; margin-bottom: 10px; }
        .page-title p { color: #666; font-size: 16px; }
        .pdf-container { background: white; border-radius: 15px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); padding: 20px; min-height: 600px; }
        .pdf-viewer { width: 100%; height: 600px; border: none; border-radius: 10px; }
        .no-pdf { text-align: center; padding: 50px; color: #666; }
        .no-pdf h3 { color: #333; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><img src="../../image/logo.png" alt="Logo"> Belajar UTBK</h1>
            <a href="../../materi.php" class="back-btn">← Kembali</a>
        </div>
        <div class="page-title">
            <h2>📚 <?php echo $topic; ?></h2>
            <p><?php echo $description; ?></p>
        </div>
        <div class="pdf-container">
            <?php
            $pdfPath = 'pengetahuan-umum.pdf';
            if (file_exists($pdfPath)) {
                echo '<embed src="' . $pdfPath . '" type="application/pdf" class="pdf-viewer">';
            } else {
            ?>
                <div class="no-pdf">
                    <h3>📄 Materi Belum Tersedia</h3>
                    <p>Mohon maaf, file PDF materi sedang diperbaharui.</p>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
