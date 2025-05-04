<?php
include '../conn.php';
date_default_timezone_set('Asia/Jakarta');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $conn->begin_transaction();
    try {
        $stmt = $conn->prepare("INSERT INTO categories (name, slug) VALUES (?, ?)");
        if ($stmt === false) {
            die("Prepare failed: " . htmlspecialchars($conn->error));
        }
        $stmt->bind_param('ss', $name, $slug,);

        if (!$stmt->execute()) {
            throw new Exception("Error inserting post: " . htmlspecialchars($stmt->error));
        }
        $post_id = $stmt->insert_id;

      
        $conn->commit();

        header("Location: kategori.php");
        exit();
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
}
?>

<?php
include 'partials/head.php';
?>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php
        include 'partials/sidebar.php';
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php
                include 'partials/navbar.php';
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tambah Kategori</h1>
                    <!-- Form Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Tambah Kategori</h6>
                            <button type="submit" form="addForm" class="btn btn-primary">Simpan</button>
                        </div>
                        <div class="card-body">
                            <form id="addForm" action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="title">Nama Kategori</label>
                                    <input type="text" class="form-control" id="title" name="name" required>
                                </div>
                                <div class="form-group">
                                    
                                    <input type="text" class="form-control" id="slug" name="slug" hidden required>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
            include 'partials/footer.php';
            ?>
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
    <?php
    include 'partials/modal.php';
    ?>

    <script>
        document.getElementById('title').addEventListener('input', function() {
            var title = this.value;
            var slug = title
                .toLowerCase() // Mengubah semua huruf menjadi lowercase
                .replace(/\s+/g, '-') // Mengganti spasi dengan tanda -
                .replace(/[^\w\-]+/g, '') // Menghapus karakter selain huruf, angka, dan tanda -
                .replace(/\-\-+/g, '-') // Menghapus tanda - berulang
                .replace(/^-+/, '') // Menghapus tanda - di awal
                .replace(/-+$/, ''); // Menghapus tanda - di akhir

            document.getElementById('slug').value = slug; // Menetapkan slug yang sudah dibentuk ke input slug
        });
    </script>
    <!-- <script type="text/javascript">
        function toggleDateTimePicker() {
            const status = document.getElementById("status").value;
            const datetimeContainer = document.getElementById("datetime-container");

            if (status === "draft") {
                datetimeContainer.style.display = "block";
            } else {
                datetimeContainer.style.display = "none";
            }
        }

        window.onload = function() {
            toggleDateTimePicker();
        }
    </script> -->

    <?php
    include 'partials/script.php';
    ?>

</body>

</html>