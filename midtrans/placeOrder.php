<?php
require_once __DIR__ . '/../vendor/autoload.php';
include '../conn.php'; // sesuaikan path koneksi DB

// Konfigurasi Midtrans
\Midtrans\Config::$serverKey = 'SB-Mid-server-SHsoYIKeZetjtVNr6-5lP17w';
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

// Ambil data dari form
$nama = $_POST['nama'] ?? '';
$email = $_POST['email'] ?? '';
$telepon = $_POST['telepon'] ?? '';
$catatan = $_POST['catatan'] ?? '';
$custom_nominal = $_POST['custom_nominal'] ?? '';
$total = ($_POST['custom_nominal'] ?? 0) > 0 ? (int) $_POST['custom_nominal'] : (int) $_POST['total'];
$tgl_donasi = date('Y-m-d H:i:s');

// Buat order ID unik
$transaction_id = 'DONASI-' . time();
$payment_type = '';
$status = 'pending';

// === INSERT KE DATABASE ===
$stmt = $conn->prepare("INSERT INTO datadonasi 
(nama_lengkap, email, nominal, no_handphone, tgl_donasi, catatan, transaction_id, payment_type, status) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param(
    "ssdssssss",
    $nama,
    $email,
    $total,
    $telepon,
    $tgl_donasi,
    $catatan,
    $transaction_id,
    $payment_type,
    $status
);

if (!$stmt->execute()) {
    echo json_encode(['error' => 'Gagal menyimpan donasi: ' . $stmt->error]);
    exit;
}

// === PERSIAPAN SNAP TOKEN ===
$params = array(
    'transaction_details' => array(
        'order_id' => $transaction_id,
        'gross_amount' => $total,
    ),
    'customer_details' => array(
        'first_name' => $nama,
        'email' => $email,
        'phone' => $telepon,
    ),
    'item_details' => array(
        array(
            'id' => 'donation',
            'price' => $total,
            'quantity' => 1,
            'name' => 'Donasi',
        )
    ),
    'custom_fields' => array(
        'custom_field1' => $catatan,
    ),
);

$snapToken = \Midtrans\Snap::getSnapToken($params);

echo json_encode(['snapToken' => $snapToken]);