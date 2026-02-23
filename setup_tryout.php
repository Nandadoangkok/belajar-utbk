<?php
include 'service/database.php';

// Create tryout_periods table if not exists
$sql = "CREATE TABLE IF NOT EXISTS tryout_periods (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tryout_type ENUM('TPS', 'Literasi') NOT NULL,
    sub_test_name VARCHAR(100) NOT NULL,
    jumlah_soal INT NOT NULL,
    waktu_menit INT NOT NULL,
    test_date DATE NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table tryout_periods created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Clear existing data and insert new sample data
$conn->query("TRUNCATE TABLE tryout_periods");

// Sample data for TPS
$tps_tests = [
    ['Penalaran Umum', 30, 30],
    ['Pengetahuan dan Pemahaman Umum', 20, 15],
    ['Kemampuan Memahami Bacaan dan Menulis', 20, 25],
    ['Pengetahuan Kuantitatif', 15, 20]
];

// Sample data for Literasi
$literasi_tests = [
    ['Literasi dalam Bahasa Indonesia', 30, 45],
    ['Literasi dalam Bahasa Inggris', 20, 15],
    ['Penalaran Matematika', 20, 45]
];

// Period dates
$periods = [
    ['2026-02-25', '07:00:00', '18:00:00'],
    ['2026-02-26', '07:00:00', '18:00:00']
];

// Insert TPS data
foreach ($tps_tests as $test) {
    foreach ($periods as $period) {
        $stmt = $conn->prepare("INSERT INTO tryout_periods (tryout_type, sub_test_name, jumlah_soal, waktu_menit, test_date, start_time, end_time) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiisss", $tryout_type, $sub_test_name, $jumlah_soal, $waktu_menit, $test_date, $start_time, $end_time);
        
        $tryout_type = 'TPS';
        $sub_test_name = $test[0];
        $jumlah_soal = $test[1];
        $waktu_menit = $test[2];
        $test_date = $period[0];
        $start_time = $period[1];
        $end_time = $period[2];
        
        $stmt->execute();
    }
}

// Insert Literasi data
foreach ($literasi_tests as $test) {
    foreach ($periods as $period) {
        $stmt = $conn->prepare("INSERT INTO tryout_periods (tryout_type, sub_test_name, jumlah_soal, waktu_menit, test_date, start_time, end_time) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiisss", $tryout_type, $sub_test_name, $jumlah_soal, $waktu_menit, $test_date, $start_time, $end_time);
        
        $tryout_type = 'Literasi';
        $sub_test_name = $test[0];
        $jumlah_soal = $test[1];
        $waktu_menit = $test[2];
        $test_date = $period[0];
        $start_time = $period[1];
        $end_time = $period[2];
        
        $stmt->execute();
    }
}

echo "Sample data inserted successfully!<br>";

// Display inserted data
$result = $conn->query("SELECT * FROM tryout_periods");
echo "<h3>Data Tryout:</h3>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Type</th><th>Sub Test</th><th>Soal</th><th>Waktu</th><th>Date</th><th>Start</th><th>End</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['tryout_type'] . "</td>";
    echo "<td>" . $row['sub_test_name'] . "</td>";
    echo "<td>" . $row['jumlah_soal'] . "</td>";
    echo "<td>" . $row['waktu_menit'] . " menit</td>";
    echo "<td>" . $row['test_date'] . "</td>";
    echo "<td>" . $row['start_time'] . "</td>";
    echo "<td>" . $row['end_time'] . "</td>";
    echo "</tr>";
}
echo "</table>";

$conn->close();
?>
