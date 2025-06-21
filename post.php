<?php
include 'conn.php';
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
$q = "SELECT 
    categories.name AS category_name,
    COUNT(posts.id) AS total
FROM 
    categories
LEFT JOIN 
    posts ON posts.category_id = categories.id
GROUP BY 
    categories.id, categories.name
ORDER BY 
    total DESC;
";
$data = $conn->query($q);


$r = "SELECT posts.*,categories.name,categories.slug as category_slug FROM posts 
join categories on categories.id = posts.category_id 
where posts.status = 'published' AND  categories.name = 'Berita' ORDER BY created_at DESC LIMIT 5";
$data2 = $conn->query($r);

$slug = $_GET['slug'] ?? '';
$category = $_GET['category'] ?? '';

if (empty($slug) || empty($category)) {
    header("HTTP/1.0 404 Not Found");
    die("<h1>404 - Halaman tidak ditemukan</h1>");
}

// Sanitize input
$slug = $conn->real_escape_string($slug);
$category = $conn->real_escape_string($category);

// Query untuk ambil data post + kategori + image
$stmt = $conn->prepare("
    SELECT posts.*, categories.name AS category_name, categories.slug AS category_slug, 
           images.image_url
    FROM posts
    JOIN categories ON posts.category_id = categories.id
    LEFT JOIN images ON images.post_id = posts.id
    WHERE posts.slug = ? AND categories.slug = ?
    LIMIT 1
");

$stmt->bind_param("ss", $slug, $category);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

// Jika tidak ditemukan, tampilkan 404
if (!$post) {
    header("HTTP/1.0 404 Not Found");
    die("<h1>404 - Berita tidak ditemukan</h1>");
}


// Siapkan data untuk ditampilkan
$title = htmlspecialchars($post['title']);
$date = date('d F Y', strtotime($post['created_at']));
$content = $post['content'];
$views = number_format($post['views'] ?? 0);
$image_url = (!empty($post['image_url']) && file_exists('assets/uploads/' . $post['image_url']))
    ? '/assets/uploads/' . $post['image_url']
    : '/assets/berita/B_1.webp';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Berita - Mizan Amanah</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Style CSS -->
    <link rel="stylesheet" href="/Donasi-Website/css/style.css" />

    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #f8f9fa;
            --accent-color: #ffc107;
            --text-color: #212529;
            --text-muted: #6c757d;
            --border-color: #dee2e6;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-color);
            background-color: #f8f9fa;
        }

        .kontainer {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            box-sizing: border-box;
        }

        .navbar {
            position: fixed;
            /* atau sticky */
            top: 0;
            width: 100%;
            z-index: 999;
        }

        .news-title {
            font-weight: 600;
            font-size: 30px;
            line-height: 1.2;
            margin-bottom: 1rem;
        }

        .news-meta {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .news-meta i {
            color: var(--accent-color);
            margin-right: 0.25rem;
        }

        .news-meta span {
            margin-right: 1.5rem;
        }

        .news-content {
            line-height: 1.8;
            font-size: 1.05rem;
        }

        .news-content p {
            margin-bottom: 1.5rem;
        }

        .news-image {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .sidebar-title {
            font-weight: 600;
            font-size: 25px;
            padding-bottom: 0.75rem;
            margin-bottom: 1.25rem;
            border-bottom: 2px solid var(--accent-color);
            position: relative;
        }

        .latest-news-item {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .latest-news-item:hover {
            background-color: rgba(13, 110, 253, 0.05);
        }

        .latest-news-item:last-child {
            border-bottom: none;
        }

        .latest-news-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .latest-news-meta {
            color: var(--text-muted);
            font-size: 0.8rem;
        }

        .latest-news-meta i {
            color: var(--primary-color);
            margin-right: 0.25rem;
        }

        .latest-news-meta span {
            margin-right: 1rem;
        }

        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                margin-top: 2rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-ligh" style="background-color: #018577;">
        <div class="container ">
            <a class="navbar-brand d-flex" href="/berita.php">
                <img src="/assets/Logo_Panti.png" alt="" width="45" height="45">
            </a>
        </div>
    </nav>

    <div class="kontainer py-5 mt-4">
        <div class="row">
            <!-- Main Content Column -->
            <div class="col-lg-8">
                <div class="card p-4">
                    <!-- News Title -->
                    <h1 class="news-title"><?= htmlspecialchars($title) ?></h1>

                    <!-- News Meta Information -->
                    <div class="news-meta">
                        <span><i class="far fa-calendar-alt"></i> <?= $date ?></span>

                        <span><i class="far fa-user"></i> Administrator</span>
                        <span><i class="far fa-eye"></i> 850 kali dilihat</span>
                    </div>

                    <!-- News Image -->
                    <img src="<?= $image_url ?>" alt="<?= htmlspecialchars($title) ?>" class="news-image">

                    <!-- News Content -->
                    <div class="news-content">
                        <?= $content ?>
                    </div>

                    <!-- Social Share Buttons -->
                    <div class="mt-4 pt-3 border-top">
                        <h5 class="mb-3">Bagikan Berita:</h5>
                        <a href="#" class="btn btn-primary me-2"><i class="fab fa-facebook-f"></i> Facebook</a>
                        <a href="#" class="btn btn-info me-2"><i class="fab fa-twitter"></i> Twitter</a>
                        <a href="#" class="btn btn-success"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                    </div>
                </div>
            </div>

            <!-- Sidebar Column -->
            <div class="col-lg-4 sidebar">
                <div class="card p-4">
                    <h3 class="sidebar-title">Berita Terbaru</h3>

                    <!-- Latest News Item 1 -->
                    <div class="latest-news-item">
                        <?php
                        if ($data2->num_rows > 0) {
                            while ($row = $data2->fetch_assoc()) {
                                echo "<div class='latest-news-item'>
                <a href='/" . htmlspecialchars($row['category_slug']) . "/" . htmlspecialchars($row['slug']) . "/" . "' class='text-decoration-none text-dark'>
                  <h5 class='latest-news-title'>" . htmlspecialchars($row['title']) . "</h5>
                </a>
                <div class='latest-news-meta'>
                  <span><i class='far fa-calendar-alt'></i> " . date('d F Y', strtotime($row['created_at'])) . "</span>
                  <span><i class='far fa-eye'></i> " . number_format(rand(500, 1000)) . " kali</span>
                </div>
              </div>";
                            }
                        } else {
                            echo 'Belum ada berita terbaru.';
                        }
                        ?>

                    </div>


                </div>

                <!-- Categories Widget -->
                <div class="card p-4">
                    <h3 class="sidebar-title">Kategori</h3>
                    <ul class="list-group list-group-flush">
                        <?php
                        if ($data->num_rows > 0) {
                            while ($row = $data->fetch_assoc()) {
                                echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                <span>" . htmlspecialchars($row['category_name']) . "</span>
                <span class='badge bg-primary rounded-pill'>" . $row['total'] . "</span>";
                            }
                        } else {
                            echo 'Mohon maaf Belum ada berita saat ini.';
                        }


                        ?>
                        </li>
                    </ul>
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

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <!--   *****   Isotope Filter Link   *****  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"></script>

    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <!-- Bootstrep JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>


    <script src="/js/navbar.js"></script>

</body>

</html>