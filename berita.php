<?php
session_start();
include 'conn.php';

$query = "SELECT posts.*,categories.name,categories.slug as category_slug,images.image_url FROM posts
join categories on categories.id = posts.category_id
left join images on images.post_id = posts.id
where posts.status = 'published' AND categories.name = 'Berita' ORDER BY created_at DESC";
$result = $conn->query($query);
// var_dump($result->fetch_assoc() );

$query_2 = "SELECT * FROM posts join categories on categories.id = posts.category_id where posts.status = 'published'
AND categories.name = 'Event' ORDER BY created_at DESC";
$event = $conn->query($query_2);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Berita</title>

    <!-- Boostrep -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

    <!-- Icon CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Font style -->
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">

    <!-- Style CSS -->
    <link rel="stylesheet" href="css/style.css" />

    <style>
    .news-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .news-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .card-img-top {
        height: 200px;
        object-fit: cover;
    }

    .date-badge {
        position: absolute;
        bottom: 10px;
        right: 10px;
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 0.8rem;
    }

    .admin-info {
        font-size: 0.8rem;
        color: #6c757d;
    }

    .event-wrapper::-webkit-scrollbar {
        height: 8px;
    }

    .event-wrapper::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }

    .event-wrapper::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    .btn-berita {
        background: none;
        border: none;
        color: #333333;
        font-size: 14px;
        font-weight: 400;
        text-decoration: underline;
        cursor: pointer;
        padding: 0;
        font-family: 'Poppins', sans-serif;
        display: block;
        text-align: right;
    }

    .btn-berita:hover {
        color: #f8a23d;
    }

    @media (max-width: 760px) {
        .event-item {
            font-size: 12px;
            width: 170px !important;
            height: 250px !important;
        }

        .text-berita {
            font-size: 20px;
        }
    }
    </style>
</head>

<body>

    <!-- Navbar -->
    <?php include 'admin/assets/include/header.php'; ?>

    <!-- Slider Berita -->
    <section class="berita-slider">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/program/Pendidikan.webp" class="d-block w-100" alt="Panti Asuhan Mizan Amanah 1">
                    <div class="carousel-caption">
                        <h2
                            style="color: #f8a23d; font-family: 'Dancing Script', cursive; font-size: 40px; font-weight: 700; letter-spacing: 1px; text-transform: capitalize; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">
                            Rumah Kebaikan untuk Anak Yatim dan Dhuafa
                        </h2>
                        <p>Temukan kabar terkini mengenai kegiatan Panti Asuhan Mizan Amanah. Kami menyediakan informasi
                            seputar
                            program pemberdayaan anak-anak yatim dan dhuafa serta berbagai inisiatif sosial yang kami
                            jalankan.</p>
                        <!-- <button type="button" class="btn btn-brt">Selengkapnya</button> -->
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/program/Kesehatan.webp" class="d-block w-100" alt="Panti Asuhan Mizan Amanah 2">
                    <div class="carousel-caption">
                        <h2
                            style="color: #f8a23d; font-family: 'Dancing Script', cursive; font-size: 40px; font-weight: 700; letter-spacing: 1px; text-transform: capitalize; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">
                            Peduli dan Berbagi untuk Masa Depan Anak-anak
                        </h2>
                        <p>Berbagai kegiatan sosial dan edukasi kami hadirkan untuk mendukung masa depan anak-anak yatim
                            dan dhuafa.
                            Dukung program kami untuk bersama-sama menciptakan perubahan yang positif.</p>
                        <!-- <button type="button" class="btn btn-brt">Selengkapnya</button> -->
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/program/Tahfiz.webp" class="d-block w-100" alt="Panti Asuhan Mizan Amanah 3">
                    <div class="carousel-caption">
                        <h2
                            style="color: #f8a23d; font-family: 'Dancing Script', cursive; font-size: 40px; font-weight: 700; letter-spacing: 1px; text-transform: capitalize; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">
                            Mizan Amanah: Menjadi Terang di Setiap Langkah
                        </h2>
                        <p>Di Panti Asuhan Mizan Amanah, kami berkomitmen untuk memberikan tempat yang aman, penuh kasih
                            sayang, dan
                            pendidikan untuk anak-anak yang membutuhkan. Mari bergabung dalam misi kami untuk memberi
                            kehidupan yang lebih
                            baik bagi mereka.</p>
                        <!-- <button type="button" class="btn btn-brt">Selengkapnya</button> -->
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <!-- Blog Berita -->
    <section class="card-berita">
        <div class="d-flex flex-column align-items-center text-center text-berita">
            <h2 class="display-6">BERITA PANTI</h2>
            <ah class="fw-semibold">Menyajikan informasi berita Panti Asuhan Mizan Amanah</ah>
        </div>
        <div class="container p-5 pt-4 pb-5">
            <div class="row g-4">

                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $slug = $row['slug'];
                        $category_slug = $row['category_slug'];
                        $content = $row['content'];
                        $image = $row['image_url'];
                        $date = date('d M Y', strtotime($row['created_at']));
                        ?>
                <div class="col-lg-4 col-md-6">
                    <div class="card news-card h-100">
                        <!-- Tambahkan h-100 untuk tinggi seragam -->
                        <div class="position-relative">
                            <!-- Gunakan gambar dari database jika ada -->
                            <?php

                                    if ($image) {
                                        echo "<img src='assets/uploads/$image' class='card-img-top' alt='$title'>";
                                    } else {

                                        echo "   <img src='assets/berita/B_1.webp' class='card-img-top' alt= $title >";
                                    }

                                    ?>
                            <div class=" date-badge">
                                <?= $date ?>
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="fw-semibold card-title"><?= htmlspecialchars(substr($title, 0, 50)) ?></h5>
                            <p class="card-text flex-grow-1">
                                <?= htmlspecialchars(substr(strip_tags($content), 0, 100)) ?>...
                            </p>
                            <div class="admin-info mt-auto">
                                <span>👤 Administrator</span> |
                                <span>Dilihat <?= $row['views'] ?? rand(500, 1000) ?> kali</span>
                            </div>
                            <a href="<?= strtolower($row['category_slug']) ?>/<?= $row['slug'] ?>"
                                class="btn btn-berita mt-2">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <?php
                    }
                } else {
                    echo 'Mohon maaf Belum ada berita saat ini.';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Footter -->
    <footer>
        <?php
        include 'admin/assets/include/footer.php';
        ?>
    </footer>

    <!--   *****   JQuery Link   *****   -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <!--   *****   Isotope Filter Link   *****  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"></script>

    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <!-- Bootstrep JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- Js main -->
    <script src="js/navbar.js"></script>
</body>

</html>