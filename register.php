<?php

session_start();
include 'conn.php'; // pastikan $conn valid

// ==== REGISTER ====
if (isset($_POST['register'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm_pas'];

    // Validasi
    if ($password !== $confirm) {
        echo "<script>alert('Konfirmasi password tidak cocok!');</script>";
        exit;
    }

    // Cek email
    $check = $conn->prepare("SELECT id FROM user_admin WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<script>alert('Email sudah terdaftar!');</script>";
        exit;
    }

    // Insert
    $insert = $conn->prepare("INSERT INTO user_admin (username, email, password, role) VALUES ('user', ?, ?, 'user')");
    $insert->bind_param("ss", $email, $password);
    $result = $insert->execute();

    if ($result) {
        $_SESSION['berhasil'] = 'Register berhasil, silahkan LogIn akun';
        echo "<script>
            window.location.href='login.php';
        </script>";
        exit;
    } else {
        echo "<script>alert('Gagal mendaftar!');</script>";
    }
}

?>