<?php
// Include database connection
require_once 'service/database.php';

// SQL untuk membuat tabel users
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabel users berhasil dibuat!<br>";
} else {
    echo "Error membuat tabel: " . $conn->error . "<br>";
}

echo "<a href='register.php'>Lanjut ke Registrasi</a>";
?>
