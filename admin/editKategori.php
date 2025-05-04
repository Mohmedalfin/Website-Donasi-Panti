<?php
include '../conn.php';
date_default_timezone_set('Asia/Jakarta');

if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM categories WHERE id = ?");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc();

    if (!$post) {
        die("Artikel tidak ditemukan.");
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $slug = $_POST['slug'];
    
        try {
            $stmt = $conn->prepare("UPDATE categories SET name = ?, slug = ? WHERE id = ?");
            $stmt->bind_param('ssi', $name, $slug, $post_id);

            if (!$stmt->execute()) {
                throw new Exception("Error updating post: " . htmlspecialchars($stmt->error));
            }
            header("Location: kategori.php");
            exit();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
} else {
    echo "ID tidak ditemukan.";
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
                    <h1 class="h3 mb-2 text-gray-800">Edit Artikel</h1>
                    <!-- Form Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Artikel</h6>
                            <button type="submit" form="editForm" class="btn btn-primary">Simpan</button>
                        </div>
                        <div class="card-body">
                            <form id="editForm" action="editKategori.php?id=<?php echo $post['id']; ?>" method="post" enctype="multipart/form-data">
                              
                                <div class="form-group">
                                    <label for="title">Nama Kategori</label>
                                    <input type="text" class="form-control" id="title" name="name" value="<?php echo htmlspecialchars($post['name']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="slug" value="<?php echo htmlspecialchars($post['slug']); ?>" name="slug" hidden required>
                                </div>

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
    <?php include 'partials/script.php'; ?>
</body>

</html>