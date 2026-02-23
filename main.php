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

// Ambil data user dari database
$stmt = $conn->prepare("SELECT username, email, created_at FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Utama - Belajar UTBK</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            background:linear-gradient(135deg, #00ccff 0%, #1e3c72 100%);
            padding: 20px;
            padding-top: 100px;
        }

        .header {
            background: #ffffff;
            padding: 15px 40px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            border-radius: 0;
            transition: transform 0.3s ease-in-out;
        }

        .header.hidden {
            transform: translateY(-100%);
        }

        .header h1 {
            color: #333;
            font-size: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .header h1 img {
            width: 50px;
            height: 50px;
            object-fit: contain;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-info span {
            color: #555;
            font-weight: 500;
        }

        .logout-btn {
            padding: 10px 20px;
            background: #ff4757;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: transform 0.2s;
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            background: #ff6b7a;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .welcome-banner {
            background: linear-gradient(135deg, #6fc6fd 0%, #a8fcff 100%);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            text-align: center;
            margin-bottom: 30px;
        }

        .welcome-banner h2 {
            color: #333;
            font-size: 32px;
            margin-bottom: 10px;
        }

        .welcome-banner p {
            color: #666;
            font-size: 16px;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .menu-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            text-align: center;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
            text-decoration: none;
            display: block;
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 50px rgba(0,0,0,0.3);
        }

        .menu-card .icon {
            font-size: 50px;
            margin-bottom: 15px;
        }
        
        .menu-card .icon img {
            width: 100px;
            height: 100px;
            object-fit: contain;
        }

        .menu-card h3 {
            color: #333;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .menu-card p {
            color: #666;
            font-size: 14px;
        }

        .menu-card.yellow { background: linear-gradient(135deg, #d0ea66 0%, #fffb00 100%); }
        .menu-card.green { background: linear-gradient(135deg, #11998e 0%, #00c9ff 100%); }
        .menu-card.orange { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
        .menu-card.purple { background: linear-gradient(135deg, #c572f6 0%, #9c72d3 100%); }
        .menu-card.red { background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%); }
        .menu-card.blue { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }

        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-overlay.show {
            display: flex;
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            width: 90%;
            max-width: 400px;
            position: relative;
            animation: slideDown 0.3s ease-in-out;
        }

        @keyframes slideDown {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .modal-close {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 24px;
            cursor: pointer;
            color: #999;
            transition: color 0.2s;
        }

        .modal-close:hover {
            color: #333;
        }

        .detail-row {
            display: flex;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-weight: 600;
            color: #555;
            width: 150px;
        }

        .detail-value {
            color: #333;
        }

        .profile-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: #11998e;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s;
            text-decoration: none;
        }

        .profile-btn:hover {
            transform: translateY(-2px);
            background: #0f8a80;
        }

        .profile-btn.active {
            background: #0f8a80;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><img src="image/logo.png" alt="Logo">Belajar UTBK</h1>
            <div class="user-info">
                <button class="profile-btn" onclick="toggleProfile()">
                    <span>👤</span>
                    <span>Profil</span>
                </button>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </div>

        <div class="welcome-banner">
            <h2>🎓 Selamat Datang, <?php echo htmlspecialchars($username); ?>!</h2>
            <p>Anda berhasil login ke Belajar UTBK</p>
        </div>

        <div class="menu-grid">
            <a href="materi.php" class="menu-card yellow">
                <div class="icon"><img src="image/icon-materi.png" alt="Materi"></div>
                <h3>Materi Pembelajaran</h3>
                <p>Akses materi pembelajaran UTBK lengkap</p>
            </a>

            <a href="tryout.php" class="menu-card green">
                <div class="icon"><img src="image/icon-tryout.png" alt="Try Out"></div>
                <h3>Try Out</h3>
                <p>Latihan soal UTBK dengan timer</p>
            </a>

            <a href="progress.php" class="menu-card orange">
                <div class="icon"><img src="image/icon-progress.png" alt="Progress"></div>
                <h3>Progress</h3>
                <p>Lihat perkembangan belajar Anda</p>
            </a>

            <a href="ranking.php" class="menu-card purple">
                <div class="icon"><img src="image/icon-ranking.png" alt="Ranking"></div>
                <h3>Ranking</h3>
                <p>Lihat posisi Anda di leaderboard</p>
            </a>

            <a href="forum.php" class="menu-card red">
                <div class="icon"><img src="image/icon-forum.png" alt="Forum"></div>
                <h3>Forum Diskusi</h3>
                <p>Berdiskusi dengan peserta lain</p>
            </a>

            <a href="prediksi.php" class="menu-card blue">
                <div class="icon"><img src="image/icon-prediksi.png" alt="Prediksi"></div>
                <h3>Prediksi Soal</h3>
                <p>Prediksi soal UTBK terkini</p>
            </a>
        </div>

        <!-- Modal Popup Data Diri -->
        <div class="modal-overlay" id="userModal">
            <div class="modal-content">
                <span class="modal-close" onclick="closeProfile()">&times;</span>
                <h3 style="text-align: center; margin-bottom: 20px; color: #333;">👤 Data Diri</h3>
                <div class="detail-row">
                    <span class="detail-label">Username:</span>
                    <span class="detail-value"><?php echo htmlspecialchars($user['username']); ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Email:</span>
                    <span class="detail-value"><?php echo htmlspecialchars($user['email']); ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Tanggal Daftar:</span>
                    <span class="detail-value"><?php echo date('d F Y', strtotime($user['created_at'])); ?></span>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Hide header on scroll down, show on scroll up
        let lastScroll = 0;
        const header = document.querySelector('.header');

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            
            if (currentScroll <= 0) {
                header.classList.remove('hidden');
                return;
            }

            if (currentScroll > lastScroll && currentScroll > 100) {
                header.classList.add('hidden');
            } else {
                header.classList.remove('hidden');
            }
            
            lastScroll = currentScroll;
        });

        function toggleProfile() {
            const modal = document.getElementById('userModal');
            modal.classList.add('show');
        }

        function closeProfile() {
            const modal = document.getElementById('userModal');
            modal.classList.remove('show');
        }

        document.getElementById('userModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeProfile();
            }
        });
    </script>
</body>
</html>
