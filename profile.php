<?php
session_start();
include 'conn.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Ambil ID user dari session
$userId = $_SESSION['user']['id'];

// Ambil data lengkap user dari database
$stmt = $conn->prepare("SELECT * FROM user_admin WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "User tidak ditemukan.";
    exit;
}

$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Panti Mizan Amanah</title>

<!-- Boostrep -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

<!-- Icon CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

<!-- Style CSS -->
<link rel="stylesheet" href="css/style.css" />

<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

<!-- Font Style -->
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
<style>
    body {
        background: #eaf8ef;
    }

    .profile-container {
        max-width: 700px;
        margin: 110px auto;
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    }

    .profile-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
    }

    .profile-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .profile-header h3 {
        margin-top: 10px;
        color: #018577;
    }

    .info-label {
        font-size: 17px;
        font-weight: 500;
        color: #018577;
    }
</style>
</head>

<body>
    <!-- Navbar -->
    <?php include 'admin/assets/include/header.php'; ?>

    <div class="profile-container">
        <div class="profile-header">
            <img src="https://ui-avatars.com/api/?name=<?= urlencode($user['username']) ?>&background=random&color=fff"
                alt="avatar" class="profile-avatar">
            <h3><?= htmlspecialchars($user['nama'] ?? '-') ?></h3>
            <p class="text-muted mb-0"><?= $user['role'] ?></p>
        </div>

        <hr>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="info-label">Username</label>
                <div>
                    <p><?= htmlspecialchars($user['username']) ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <label class="info-label">Email</label>
                <div>
                    <p><?= htmlspecialchars($user['email']) ?></p>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="info-label">Telepon</label>
                <div>
                    <p><?= htmlspecialchars($user['telepon'] ?? '-') ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <label class="info-label">Jenis Kelamin</label>
                <div>
                    <p><?= htmlspecialchars($user['jenis_kelamin'] ?? '-') ?></p>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="info-label">Alamat</label>
            <div>
                <p><?= htmlspecialchars($user['alamat'] ?? '-') ?></p>
            </div>
        </div>

        <div class="mb-3">
            <label class="info-label">Tanggal Lahir</label>
            <div>
                <p><?= htmlspecialchars($user['tanggal_lahir'] ?? '-') ?></p>
            </div>
        </div>
    </div>
    </div>
    <!-- Footter -->
    <footer>
        <?php
        include 'admin/assets/include/footer.php';
        ?>
    </footer>
    <!-- Bootstrap JS Bundle (dropdown needs JS) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CDN JS Switch ALert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- PureCounter.js -->
    <script src="https://cdn.jsdelivr.net/npm/@srexi/purecounterjs/dist/purecounter_vanilla.js"></script>

    <!-- Bootstrap JS (bundle includes Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>

    <!-- Custom JS -->
    <script src="js/main.js" defer></script>

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
        $('.btn-logout').on('click', function () {
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