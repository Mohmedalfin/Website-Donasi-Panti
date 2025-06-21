<?php
include '../conn.php';
header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Ambil data JSON dari Midtrans callback JS
$data = json_decode(file_get_contents('php://input'), true);

// Validasi awal
if (!$data) {
    echo json_encode(['success' => false, 'error' => 'Data kosong atau tidak valid']);
    exit;
}

// Ambil dan sanitasi data
$nama           = $data['nama'] ?? '';
$email          = $data['email'] ?? '';
$telepon        = $data['telepon'] ?? '';
$catatan        = $data['catatan'] ?? '';
$nominal        = (float) ($data['nominal'] ?? 0);
$transaction_id = $data['transaction_id'] ?? '';
$payment_type   = $data['payment_type'] ?? '';
$status         = $data['status'] ?? '';
$tanggal        = date('Y-m-d H:i:s');

// Validasi minimal field wajib
if (!$nama || !$email || !$transaction_id || !$status || !$nominal) {
    echo json_encode(['success' => false, 'error' => 'Field wajib kosong']);
    exit;
}

// Simpan ke DB
$stmt = $conn->prepare("INSERT INTO datadonasi 
(nama_lengkap, email, nominal, no_handphone, tgl_donasi, catatan, transaction_id, payment_type, status)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("ssdssssss", $nama, $email, $nominal, $telepon, $tanggal, $catatan, $transaction_id, $payment_type, $status);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $stmt->error]);
}