<?php
include '../conn.php';

$stmt = $conn->prepare("SELECT * FROM profile WHERE id = ?");
if ($stmt === false) {
    die("Prepare failed: " . htmlspecialchars($conn->error));
}
$id = 1;
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
if (!$data) {
    echo "Data tidak ditemukan!";
    exit();
}
$nama = $data['nama'];
$logo = $data['logo'];
$phone = $data['phone'];
if (preg_match("/^\+62[0-9]{9,13}$/", $phone)) {
    $phone = $data['phone'];
} else {
    echo "Nomor HP tidak valid.";
}
$email = $data['email'];
$alamat = $data['alamat'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    if ($_FILES['logo']['name']) {
        $rand = rand();
        $ekstensi = array('png', 'jpg', 'jpeg', 'gif');
        $filename = $_FILES['logo']['name'];
        $ukuran = $_FILES['logo']['size'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        if (!in_array($ext, $ekstensi)) {
            header("Location: profile.php?alert=gagal_ekstensi");
            exit();
        } else {
            if ($ukuran < 1044070) {
                $xx = $rand . '_' . $filename;
                $target_dir = 'assets/img/upload/';
                $target_file = $target_dir . $xx;
                move_uploaded_file($_FILES['logo']['tmp_name'], $target_file);

                $stmt = $conn->prepare("UPDATE profile SET nama = ?, alamat = ?, email = ?, phone = ?, logo = ? WHERE id = ?");
                if ($stmt === false) {
                    die("Prepare failed: " . htmlspecialchars($conn->error));
                }
                $stmt->bind_param('sssssi', $nama, $alamat, $email, $phone, $xx, $id);
                if ($stmt->execute()) {
                    header("Location: profile.php");
                    exit();
                } else {
                    echo "Error: " . htmlspecialchars($stmt->error);
                }
            } else {
                header("Location: profile.php?alert=gagal_ukuran");
                exit();
            }
        }
    } else {
        $stmt = $conn->prepare("UPDATE profile SET nama = ?, alamat = ?, email = ?, phone = ? WHERE id = ?");
        if ($stmt === false) {
            die("Prepare failed: " . htmlspecialchars($conn->error));
        }
        $stmt->bind_param('ssssi', $nama, $alamat, $email, $phone, $id);
        if ($stmt->execute()) {
            header("Location: profile.php");
            exit();
        } else {
            echo "Error: " . htmlspecialchars($stmt->error);
        }
    }

    $stmt->close();
    $conn->close();
}
?>

<?php include 'partials/head.php'; ?>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include 'partials/sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php include 'partials/navbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">Identitas</h1>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <h6 class="m-0 font-weight-bold text-primary">Identitas</h6>
                                </div>
                                <div class="card-body">
                                    <form id="editForm" action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="nama">Nama </label>
                                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat Lengkap</label>
                                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?php echo $alamat ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Nomor Telepon (+62)</label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone ?>" pattern="^\+62[0-9]{9,13}$" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="logo">Logo</label>
                                            <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-update">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Identitas</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3 text-center">
                                        <img src="assets/img/upload/<?php echo $logo ?>" alt="Logo Aplikasi" class="img-fluid" style="max-width: 150px;">
                                    </div>
                                    <p><strong>Nama Bisnis:</strong> <?php echo $nama ?></p>
                                    <p><strong>Alamat:</strong> <?php echo $alamat ?></p>
                                    <p><strong>Email:</strong> <?php echo $email ?></p>
                                    <p><strong>Nomor Telepon:</strong> <?php echo $phone ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include 'partials/footer.php'; ?>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php include 'partials/modal.php'; ?>

    <?php include 'partials/script.php'; ?>
</body>

</html>