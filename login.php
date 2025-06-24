<?php
session_start();
include 'conn.php'; // pastikan $conn valid

// ==== LOGIN ====
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM user_admin WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        $_SESSION['user'] = $user;

        if ($user['role'] == 'admin') {
            $_SESSION['berhasil'] = 'Login Admin Berhasil';
            header("Location: admin/index.php");
            exit;
        } elseif ($user['role'] == 'user') {
            $_SESSION['berhasil'] = 'Login User Berhasil';
            header("Location: index.php");
            exit;
        } else {
            $_SESSION['validasi'] = 'Role tidak ada yang sesuai';
        }
    } else {
        $_SESSION['validasi'] = 'Email atau Password tidak sesuai';
        echo "<script>window.location='login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login & Register</title>
    <link rel="stylesheet" href="css/login.css" />

</head>

<body>

    <div class="form-wrapper">
        <!-- LOGIN FORM -->
        <form id="login-form" class="form-box login-container active" action="login.php" method="post">
            <h2>Login</h2>
            <div class="form-group">
                <input type="email" name="email" placeholder="Email" required />
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required />
            </div>
            <button type="submit" name="login">Login</button>
            <div class="toggle-link">Belum punya akun? <a onclick="toggleForm('register')">Daftar</a></div>
        </form>

        <!-- REGISTER FORM -->
        <form id="register-form" class="form-box register-container" action="register.php" method="post">
            <h2>Register</h2>
            <div class="form-row">
                <div class="form-column">
                    <div class="form-group">
                        <input type="text" name="nama" placeholder="Nama Lengkap" required />
                    </div>
                    <div class="form-group">
                        <input type="text" name="username" placeholder="Username" required />
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email" required />
                    </div>
                    <div class="form-group">
                        <input type="text" name="telepon" placeholder="Nomor Telepon" required />
                    </div>
                    <div class="form-group">
                        <select name="jenis_kelamin" required>
                            <option value="" disabled selected>Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="form-column">
                    <div class="form-group">
                        <textarea name="alamat" placeholder="Alamat Lengkap" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <input type="date" name="tanggal_lahir" required />
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Password" required />
                    </div>
                    <div class="form-group">
                        <input type="password" name="confirm_password" placeholder="Konfirmasi Password" required />
                    </div>
                </div>
            </div>
            <button type="submit" name="register">Daftar</button>
            <div class="toggle-link">Sudah punya akun? <a onclick="toggleForm('login')">Login</a></div>
        </form>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function toggleForm(form) {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            if (form === 'register') {
                loginForm.classList.remove('active');
                registerForm.classList.add('active');
            } else {
                registerForm.classList.remove('active');
                loginForm.classList.add('active');
            }
        }
    </script>

    <!-- SweetAlert Notifikasi -->
    <?php if (isset($_SESSION['validasi'])): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '<?= $_SESSION['validasi']; ?>',
                toast: true,
                position: 'top-end',
                timer: 3000,
                showConfirmButton: false
            });
        </script>
        <?php unset($_SESSION['validasi']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['berhasil'])): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '<?= $_SESSION['berhasil']; ?>',
                toast: true,
                position: 'top-end',
                timer: 3000,
                showConfirmButton: false
            });
        </script>
        <?php unset($_SESSION['berhasil']); ?>
    <?php endif; ?>
</body>

</html>