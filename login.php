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
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="wrapper">
        <div class="title-text">
            <div class="title login">Login Form</div>
            <div class="title signup">Signup Form</div>
        </div>
        <div class="form-container">
            <div class="slide-controls">
                <input type="radio" name="slide" id="login" checked />
                <input type="radio" name="slide" id="signup" />
                <label for="login" class="slide login">Login</label>
                <label for="signup" class="slide signup">Signup</label>
                <div class="slider-tab"></div>
            </div>
            <div class="form-inner">
                <form action="login.php" method="POST" class="login">
                    <div class="field">
                        <input type="text" name="email" placeholder="Email Address" required />
                    </div>
                    <div class="field">
                        <input type="password" name="password" placeholder="Password" required />
                    </div>
                    <!-- <div class="pass-link"><a href="#">Forgot password?</a></div> -->
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" name="login" value="Login" />
                    </div>
                </form>
                <form action="register.php" class="signup" name="register" method="post">
                    <div class="field">
                        <input type="text" name="email" placeholder="Email Address" required />
                    </div>
                    <div class="field">
                        <input type="password" name="password" placeholder="Password" required />
                    </div>
                    <div class="field">
                        <input type="password" name="confirm_pas" placeholder="Confirm password" required />
                    </div>
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" name="register" value="Signup" />
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- CDN JS Switch ALert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const loginText = document.querySelector(".title-text .login");
        const loginForm = document.querySelector("form.login");
        const loginBtn = document.querySelector("label.login");
        const signupBtn = document.querySelector("label.signup");
        const signupLink = document.querySelector("form .signup-link a");
        signupBtn.onclick = () => {
            loginForm.style.marginLeft = "-50%";
            loginText.style.marginLeft = "-50%";
        };
        loginBtn.onclick = () => {
            loginForm.style.marginLeft = "0%";
            loginText.style.marginLeft = "0%";
        };
        signupLink.onclick = () => {
            signupBtn.click();
            return false;
        };
    </script>

    <!-- alert validasi -->
    <?php if (isset($_SESSION['validasi'])): ?>

        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "error",
                title: "<?= $_SESSION['validasi'] ?>"
            });
        </script>

        <?php unset($_SESSION['validasi']); ?>

    <?php endif; ?>

    <!-- alert berhasil -->
    <?php if (isset($_SESSION['berhasil'])): ?>

        <script>
            const berhasil = Swal.mixin({
                toast: true,
                position: "top",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            berhasil.fire({
                icon: "success",
                title: "<?= $_SESSION['berhasil'] ?>"
            });
        </script>

        <?php unset($_SESSION['berhasil']); ?>

    <?php endif; ?>

    <!-- alert konfirmasi hapus -->
    <script>
        $('.tombol-hapus').on('click', function () {
            var getlink = $(this).attr('href');
            Swal.fire({
                title: "Yakin hapus?",
                text: "Data yang sudah dihapus tidak bisa dikembalikan",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, dihapus!",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = getlink
                }
            });
            return false;
        });
    </script>

</body>

</html>