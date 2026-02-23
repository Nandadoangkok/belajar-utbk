<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "buku_tamu";
$email = "";


$conn = new mysqli(hostname: $hostname, username: $username, password: $password, database: $database);

if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
    die("Connection failed: " . $conn->connect_error);
}

?>