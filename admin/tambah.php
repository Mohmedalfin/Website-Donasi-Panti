<?php
include '../conn.php';
date_default_timezone_set('Asia/Jakarta');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $status = $_POST['status'];
    $category_id = $_POST['category_id'];
    $time = date('Y-m-d H:i:s', time());
    $slug = $_POST['slug'];
    $scheduled_at = null;
    if ($status === 'draft' && isset($_POST['scheduled_at'])) {
        $scheduled_at = $_POST['scheduled_at'];
    }
    echo '<pre>';
    print_r($_FILES);
    echo '</pre>';


    $conn->begin_transaction();
    try {
        $stmt = $conn->prepare("INSERT INTO posts (slug, title, content, status, category_id, scheduled_at, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die("Prepare failed: " . htmlspecialchars($conn->error));
        }
        $stmt->bind_param('ssssssss', $slug, $title, $content, $status, $category_id, $scheduled_at, $time, $time);

        if (!$stmt->execute()) {
            throw new Exception("Error inserting post: " . htmlspecialchars($stmt->error));
        }
        $post_id = $stmt->insert_id;
        // Handle image upload (optional)
        // Handle image upload (single image)
        if (isset($_FILES['image']) && $_FILES['image']['error'] !== 4) {
            $file_name = $_FILES['image']['name'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_error = $_FILES['image']['error'];
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
            $upload_dir = '../assets/uploads/';
            $new_filename = 'img_' . bin2hex(random_bytes(8)) . '.' . $file_ext;

            $target_path = $upload_dir . $new_filename;

            // Buat folder jika belum ada
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            // Validasi ekstensi
            if (!in_array($file_ext, $allowed_ext)) {
                throw new Exception("Ekstensi file tidak diizinkan.");
            }

            // Validasi gambar
            if (getimagesize($file_tmp) === false) {
                throw new Exception("File yang diupload bukan gambar valid.");
            }

            // Validasi error
            if ($file_error !== UPLOAD_ERR_OK) {
                throw new Exception("Terjadi error saat upload file. Kode: $file_error");
            }

            // Upload dan simpan ke database
            if (move_uploaded_file($file_tmp, $target_path)) {
                $image_url = $new_filename;
                $image_stmt = $conn->prepare("INSERT INTO images (post_id, image_url) VALUES (?, ?)");
                $image_stmt->bind_param("is", $post_id, $image_url);
                if (!$image_stmt->execute()) {
                    throw new Exception("Gagal menyimpan image: " . $image_stmt->error);
                }
            } else {
                throw new Exception("Gagal memindahkan file ke folder upload.");
            }
        }

        $conn->commit();

        header("Location: index.php");
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
                    <h1 class="h3 mb-2 text-gray-800">Tambah Artikel</h1>
                    <!-- Form Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Tambah Artikel</h6>
                            <button type="submit" form="addForm" class="btn btn-primary">Simpan</button>
                        </div>
                        <div class="card-body">
                            <form id="addForm" action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="title">Judul</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                    <input type="text" class="form-control" id="slug" name="slug" hidden required>
                                </div>
                                <div class="form-group">
                                    <label for="category">Kategori</label>
                                    <select name="category_id" id="category" class="form-control">
                                        <option value="">-- Pilih Kategori --</option>
                                        <?php
                                        // Fetch categories from the database
                                        $categories = $conn->query("SELECT id, name FROM categories");
                                        while ($row = $categories->fetch_assoc()) {
                                            echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="content">Konten</label>
                                    <textarea name="content" class="form-control" rows="15"
                                        placeholder="Content"></textarea>
                                </div>

                                <!-- Select untuk status -->
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control"
                                        onchange="toggleDateTimePicker()">
                                        <option value="published">Published</option>
                                        <option value="draft">Draft</option>
                                        <option value="archived">Archived</option>
                                    </select>
                                </div>

                                <!-- DateTime Picker (Hanya muncul saat status draft) -->
                                <div class="form-group" id="datetime-container" style="display: none;">
                                    <label for="datetime">Jadwal Upload</label>
                                    <input type="datetime-local" name="scheduled_at" id="datetime" class="form-control">
                                </div>

                                <!-- Upload Gambar -->
                                <!-- Upload Gambar -->
                                <div class="form-group">
                                    <label for="image">Upload Gambar</label>
                                    <input type="file" name="image" id="image" class="form-control" accept="image/*"
                                        required>
                                    <small class="form-text text-muted">Pilih satu gambar untuk diunggah.</small>
                                </div>


                                <button type="submit" class="btn btn-primary">Simpan</button>
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

    <script src="assets/tinymce/js/tinymce/tinymce.min.js"></script>
    <script type='text/javascript'>
    tinymce.init({
        selector: 'textarea',
        plugins: ' code anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat | code',
        tinycomments_mode: 'embedded',
        license_key: 'hqg6c15o9ymi9hrk3qoz9wt1oeaprtauunnqj0jyw41t062t'
    });
    </script>

    <script type="text/javascript">
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
    </script>
    <script>
    document.getElementById('title').addEventListener('input', function() {
        var title = this.value;
        var slug = title
            .toLowerCase()
            .replace(/\s+/g, '-')
            .replace(/[^\w\-]+/g, '') // Menghapus karakter selain huruf, angka, dan tanda -
            .replace(/\-\-+/g, '-') // Menghapus tanda - berulang
            .replace(/^-+/, '') // Menghapus tanda - di awal
            .replace(/-+$/, ''); // Menghapus tanda - di akhir

        document.getElementById('slug').value = slug; // Menetapkan slug yang sudah dibentuk ke input slug
    });
    </script>

    <?php
    include 'partials/script.php';
    ?>

</body>

</html>