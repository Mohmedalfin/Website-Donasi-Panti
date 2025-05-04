<?php
include '../conn.php';
date_default_timezone_set('Asia/Jakarta');

if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc();

    if (!$post) {
        die("Artikel tidak ditemukan.");
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $status = $_POST['status'];
        $time = date('Y-m-d H:i:s', time());

        $scheduled_at = null;
        if ($status === 'draft' && isset($_POST['scheduled_at'])) {
            $scheduled_at = $_POST['scheduled_at'];
        }

        try {
            $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ?, status = ?, scheduled_at = ?, updated_at = ? WHERE id = ?");
            $stmt->bind_param('sssssi', $title, $content, $status, $scheduled_at, $time, $post_id);

            if (!$stmt->execute()) {
                throw new Exception("Error updating post: " . htmlspecialchars($stmt->error));
            }

            if (isset($_FILES['image']) && $_FILES['image']['error'] !== 4) {
                // Hapus gambar lama dari database dan folder
                $stmt = $conn->prepare("SELECT image_url FROM images WHERE post_id = ?");
                $stmt->bind_param("i", $post_id);
                $stmt->execute();
                $result = $stmt->get_result();
            
                while ($row = $result->fetch_assoc()) {
                    $old_image_path = $row['image_url'];
                    if (file_exists($old_image_path)) {
                        unlink($old_image_path); // hapus file fisik
                    }
                }
            
                // Hapus dari database
                $stmt = $conn->prepare("DELETE FROM images WHERE post_id = ?");
                $stmt->bind_param("i", $post_id);
                $stmt->execute();
            
                // Upload gambar baru
                $file_name = $_FILES['image']['name'];
                $file_tmp = $_FILES['image']['tmp_name'];
                $file_error = $_FILES['image']['error'];
                $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
                $upload_dir = 'assets/uploads/';
                $new_filename = 'img_' . bin2hex(random_bytes(8)) . '.' . $file_ext;
                $target_path = $upload_dir . $new_filename;
            
                if (!in_array($file_ext, $allowed_ext)) {
                    throw new Exception("Ekstensi file tidak diizinkan.");
                }
            
                if (getimagesize($file_tmp) === false) {
                    throw new Exception("File yang diupload bukan gambar valid.");
                }
            
                if ($file_error !== UPLOAD_ERR_OK) {
                    throw new Exception("Terjadi error saat upload file. Kode: $file_error");
                }
            
                if (move_uploaded_file($file_tmp, $target_path)) {
                    $image_stmt = $conn->prepare("INSERT INTO images (post_id, image_url) VALUES (?, ?)");
                    $image_stmt->bind_param("is", $post_id, $target_path);
                    if (!$image_stmt->execute()) {
                        throw new Exception("Gagal menyimpan gambar baru ke database: " . $image_stmt->error);
                    }
                } else {
                    throw new Exception("Gagal memindahkan file ke folder upload.");
                }
            }
            
            header("Location: index.php");
            exit();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
} else {
    echo "ID tidak ditemukan.";
}
?>

<!-- HTML untuk Form Edit Artikel -->
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
                    <h1 class="h3 mb-2 text-gray-800">Edit Artikel</h1>
                    <!-- Form Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Artikel</h6>
                            <button type="submit" form="editForm" class="btn btn-primary">Simpan</button>
                        </div>
                        <div class="card-body">
                            <form id="editForm" action="edit.php?id=<?php echo $post['id']; ?>" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea name="content" class="form-control" rows="15" placeholder="Content"><?php echo htmlspecialchars($post['content']); ?></textarea>
                                </div>

                                <!-- Select untuk status -->
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control" onchange="toggleDateTimePicker()">
                                        <option value="published" <?php echo $post['status'] == 'published' ? 'selected' : ''; ?>>Published</option>
                                        <option value="draft" <?php echo $post['status'] == 'draft' ? 'selected' : ''; ?>>Draft</option>
                                        <option value="archived" <?php echo $post['status'] == 'archived' ? 'selected' : ''; ?>>Archived</option>
                                    </select>
                                </div>

                                <!-- DateTime Picker (Hanya muncul saat status draft) -->
                                <div class="form-group" id="datetime-container" style="display: <?php echo $post['status'] == 'draft' ? 'block' : 'none'; ?>;">
                                    <label for="datetime">Schedule Upload</label>
                                    <input type="datetime-local" name="scheduled_at" id="datetime" class="form-control" value="<?php echo $post['scheduled_at']; ?>">
                                </div>

                                <!-- Upload Gambar -->
                                <div class="form-group">
                                    <label for="images">Upload Gambar</label>
                                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                                    <small class="form-text text-muted">Pilih beberapa gambar untuk diunggah.</small>
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include 'partials/modal.php'; ?>

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

    <?php include 'partials/script.php'; ?>
</body>

</html>