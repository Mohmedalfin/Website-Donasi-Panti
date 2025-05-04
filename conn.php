<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/config.php';

$host = $_ENV['DB_HOST'];
$port = $_ENV['DB_PORT'];
$dbname = $_ENV['DB_DATABASE'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];


$conn = new mysqli($host, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("❌ Koneksi Gagal: " . $conn->connect_error);
}
// echo "✅ Koneksi Berhasil";