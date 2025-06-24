<?php
session_start();
include 'conn.php'; // pastikan $conn valid

if (isset($_POST['register'])) {
    // Ambil data dari form
    $nama = trim($_POST['nama']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $telepon = trim($_POST['telepon']);
    $alamat = trim($_POST['alamat']);
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];
    $role = 'user'; // default role

    // Validasi
    if ($password !== $confirm) {
        $_SESSION['validasi'] = "Konfirmasi password tidak cocok!";
        header("Location: login.php");
        exit;
    }

    // Cek apakah email sudah digunakan
    $check = $conn->prepare("SELECT id FROM user_admin WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $_SESSION['validasi'] = "Email sudah terdaftar!";
        header("Location: login.php");
        exit;
    }

    // Simpan password tanpa enkripsi
    $stmt = $conn->prepare("INSERT INTO user_admin 
        (username, email, password, role, nama, telepon, alamat, jenis_kelamin, tanggal_lahir)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param(
        "sssssssss",
        $username,
        $email,
        $password,  // ← tidak di-hash
        $role,
        $nama,
        $telepon,
        $alamat,
        $jenis_kelamin,
        $tanggal_lahir
    );

    if ($stmt->execute()) {
        $_SESSION['berhasil'] = "Registrasi berhasil, silakan login.";
        header("Location: login.php");
        exit;
    } else {
        $_SESSION['validasi'] = "Gagal menyimpan data.";
        header("Location: login.php");
        exit;
    }
}
?>