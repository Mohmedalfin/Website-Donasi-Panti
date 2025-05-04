<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tentang</title>

    <!-- Boostrep -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Icon CSS -->
    <link rel="stylesheet" href="vendor/bootstrap-icons/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    <!-- Font question -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Markazi+Text:wght@400..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">

    <!-- Style CSS -->
    <link rel="stylesheet" href="css/style.css" />
    <style>
    /* -------- Galeri Section ------- */
    .gallery-section {
        max-width: 1000px;
        margin: auto;
        text-align: center;
        margin-bottom: 100px;
    }

    .gallery-section h2 {
        font-size: 30px;
        font-weight: 600;
        color: var(--color-font-primary1);
        margin-bottom: 10px;
    }

    .gallery-section p {
        font-size: 16px;
        color: var(--color-font-primary2);
    }

    .gallery-title {
        font-size: 2rem;
        margin: 0;
    }

    .gallery-desc {
        font-size: 1rem;
        color: #555;
        margin-bottom: 20px;
    }

    /* Filter Buttons */
    .filter-buttons {
        margin-bottom: 20px;
    }

    .filter-buttons button {
        background-color: var(--color-secondary);
        color: var(--color-font-primary2);
        border: none;
        padding: 5px 15px;
        margin: 5px;
        cursor: pointer;
        border-radius: 5px;
        transition: 0.3s;
        font-weight: 500;
    }

    .filter-buttons button:hover {
        background-color: var(--color-hvr-program);
        color: var(--background-color);
    }

    .filter-buttons button.active {
        background-color: var(--color-hvr-program);
        color: var(--background-color);
    }

    /* Gallery */
    .gambah {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
    }

    .gambah img {
        width: 250px;
        height: 180px;
        object-fit: cover;
        border-radius: 3px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
        cursor: pointer;
    }

    .gambah img:hover {
        transform: scale(1.05);
    }

    .hidden {
        display: none;
    }

    /* Lightbox */
    .lightbox {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .lightbox img {
        max-width: 80%;
        max-height: 80%;
        border-radius: 5px;
        box-shadow: 0 4px 10px rgba(255, 255, 255, 0.2);
    }

    .close-btn {
        position: absolute;
        top: 20px;
        right: 40px;
        font-size: 2rem;
        color: #fff;
        cursor: pointer;
    }

    @media (max-width: 600px) {
        .gallery-section {
            margin-bottom: 50px;
        }

        .gallery-section h2 {
            font-size: 20px;
            font-weight: 600;
            color: var(--color-font-primary1);
            margin-bottom: 20px;
        }

        .gambah {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            /* Menjadikan 2 kolom */
            gap: 10px;
            padding: 10px;
        }

        .gambah img {
            width: 100%;
            /* Agar gambar mengisi kolom */
            height: 100px;
            object-fit: cover;
        }
    }
    </style>
</head>

<body>
    <!-- Navbar -->
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo d-flex align-items-center">
                <h1 class="sitename">Mizan Amanah</h1>
                <span>.</span>
            </a>
            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="index.php">Beranda</a></li>
                    <li><a href="about.php" class="active">Tentang</a></li>
                    <li><a href="berita.php">Berita</a></li>
                    <li><a href="Kel-Tani.php">Donasi</a></li>
                    <li><a href="grografis.php">Geografis</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>
    </header>

    <!-- Sejarah Desa -->
    <section class="about">
        <div class="about-img mt-5">
            <img src="assets/Logo_Panti.png" alt="Kades" class="fade-in-image touch-animate-img" />
        </div>
        <div class="about-content mt-5">
            <h2 class="sitename"
                style="font-family: 'Dancing Script', cursive; font-size: 40px; font-weight: 700; letter-spacing: 1px; text-transform: capitalize;  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">
                Panti Mizan Amanah
            </h2>
            <p class="fw-semibold" id="dukuhText" style="font-weight: 500;">
                Panti Asuhan Mizan Amanah Yogyakarta merupakan lembaga sosial keagamaan yang bergerak di bidang
                pengasuhan, pendidikan, dan pemberdayaan anak-anak yatim, piatu, dan dhuafa. Berdiri dengan landasan
                nilai-nilai Islam, panti ini berkomitmen untuk menjadi tempat yang aman, nyaman, dan penuh kasih sayang
                bagi anak-anak yang membutuhkan perlindungan dan bimbingan.

                <span id="dots">...</span><span id="more" style="display: none;">
                    Dengan pendekatan holistik, Mizan Amanah tidak hanya menyediakan kebutuhan dasar seperti tempat
                    tinggal,
                    makan, dan pakaian, tetapi juga membekali anak-anak dengan pendidikan formal, pembinaan karakter,
                    serta
                    keterampilan hidup agar kelak menjadi pribadi yang mandiri dan bermanfaat bagi masyarakat.

                    Kami percaya bahwa setiap anak memiliki potensi luar biasa yang perlu diasah dengan kasih sayang,
                    perhatian, dan kesempatan. Oleh karena itu, melalui program-program pengembangan dan kerja sama
                    dengan
                    berbagai pihak, Panti Asuhan Mizan Amanah terus berupaya menghadirkan masa depan yang lebih cerah
                    bagi
                    para penerus bangsa.
                </span>
            </p>
            <button onclick="toggleText()" id="readMoreBtn"
                style="background: none; border: none; color: #333; font-size: 14px; cursor: pointer; padding: 0; margin-top: 10px; text-decoration: underline; text-underline-offset: 2px; transition: color 0.3s ease;">
                Baca Selengkapnya
            </button>
        </div>

    </section>

    <!-- Question Panti -->
    <section class="my-5 question">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="h-100 d-flex flex-column rounded">
                    <h2 class="display-6 ">Sekilas <span class="fw-bold">Panti Mizan Amanah</span></h2>
                    <p class="fw-semibold">Kenali lebih dekat Panti Asuhan Mizan Amanah Yogyakarta. </p>
                </div>
            </div>

            <div class="col-md-8">
                <div class="accordion-wrapper shadow rounded" id="accordionPanelsStayOpenExample">
                    <div class="accordion accordion-flush" id="accordionPanels">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <i class="fas fa-globe-asia" style="padding-right: 8px;"></i> Profil Panti
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
                                <div class="accordion-body" style="text-align: justify;">
                                    <strong> Panti Asuhan Mizan Amanah Yogyakarta.</strong>
                                    adalah lembaga sosial keagamaan yang berlokasi
                                    di Jl. Melati Wetan No. 8A, Kelurahan Baciro, Kecamatan Gondokusuman, Daerah
                                    Istimewa Yogyakarta 55225. Panti ini berkomitmen memberikan pengasuhan, pendidikan,
                                    dan pembinaan karakter bagi anak-anak yatim, piatu, dan dhuafa dalam lingkungan yang
                                    aman, nyaman, dan penuh kasih sayang. Berlandaskan nilai-nilai Islam, panti ini
                                    bertujuan mencetak generasi yang mandiri, berakhlak mulia, dan mampu berkontribusi
                                    positif bagi masyarakat.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <i class="fas fa-seedling" style="padding-right: 8px;"></i> Program Unggulan
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo">
                                <div class="accordion-body" style="text-align: justify;">
                                    <strong>Salah satu program unggulan.</strong>
                                    Panti Asuhan Mizan Amanah Yogyakarta adalah Pembinaan Karakter dan Kemandirian Anak
                                    Asuh melalui pendekatan pendidikan Islam, pelatihan keterampilan hidup, dan
                                    pengembangan potensi individu. Program ini mencakup kegiatan tahfidz Al-Qur’an,
                                    bimbingan belajar, pelatihan kewirausahaan, serta pembinaan mental dan spiritual
                                    yang terintegrasi. Dengan program ini, panti tidak hanya fokus pada pemenuhan
                                    kebutuhan dasar, tetapi juga membekali anak-anak dengan nilai, ilmu, dan kemampuan
                                    yang dapat mengantarkan mereka menjadi pribadi yang unggul dan mandiri di masa
                                    depan.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <i class="fas fa-people-group" style="padding-right: 8px;"></i>Kehidupan Sosial
                                    Masyarakat
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree">
                                <div class="accordion-body" style="text-align: justify;">
                                    <strong>Kehidupan sosial di Panti Asuhan
                                        Mizan Amanah Yogyakarta .</strong>Kterjalin dalam suasana kekeluargaan yang
                                    hangat dan saling
                                    mendukung. Anak-anak diasuh dalam lingkungan yang menanamkan nilai gotong royong,
                                    kebersamaan, dan kepedulian terhadap sesama. Kegiatan harian seperti belajar
                                    bersama, ibadah berjamaah, kerja bakti, dan acara kebersamaan seperti buka puasa
                                    bersama atau peringatan hari besar Islam menjadi momen penting dalam membangun
                                    hubungan sosial yang sehat.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <!-- Galleri Section -->
    <section class="gallery-section">
        <h2 class="gallery-title">GALERI DUKUH</h2>
        <p class="bottom-contact-title mb-2"></p>
        <p class="gallery-desc fw-semibold">
            Dokumentasi foto kegiatan-kegiatan yang berlangsung di Padukuhan Dukuh
        </p>

        <!-- Filter Buttons -->
        <div class="filter-buttons">
            <button class="filter-btn active" onclick="filterGallery('all', this)">All</button>
            <button class="filter-btn" onclick="filterGallery('sosial', this)">Sosial</button>
            <button class="filter-btn" onclick="filterGallery('pendidikan', this)">Pendidikan</button>
            <button class="filter-btn" onclick="filterGallery('kerohanian', this)">Keagamaan</button>
        </div>

        <!-- Gallery Images -->
        <div class="gambah">
            <img src="assets/Galeri/K1.webp" alt="all" data-kategori="all" onclick="openLightbox(this)">
            <img src="assets/Galeri/P1.webp" alt="pendidikan" data-kategori="pendidikan" onclick="openLightbox(this)">
            <img src="assets/Galeri/S1.webp" alt="sosial" data-kategori="sosial" onclick="openLightbox(this)">
            <img src="assets/Galeri/S2.webp" alt="all" data-kategori="all" onclick="openLightbox(this)">
            <img src="assets/Galeri/S3.webp" alt="sosial" data-kategori="sosial" onclick="openLightbox(this)">
            <img src="assets/Galeri/K4.webp" alt="sosial" data-kategori="sosial" onclick="openLightbox(this)">
            <img src="assets/Galeri/K1.webp" alt="kerohanian" data-kategori="kerohanian" onclick="openLightbox(this)">
            <img src="assets/Galeri/K2.webp" alt="kerohanian" data-kategori="kerohanian" onclick="openLightbox(this)">
        </div>
    </section>

    <!-- Lightbox Modal -->
    <div class="lightbox" id="lightbox">
        <span class="close-btn" onclick="closeLightbox()">&times;</span>
        <img id="lightbox-img" src="" alt="Preview">
    </div>

    <!-- Program Section -->
    <section id="features" class="features section">
        <h2 class="fw-semibold fs-3 pb-3 text-center" style="color: #f8a23;">PROGRAM PANTI ASUHAN</h2>
        <p class=" bottom-contact-title mb-5">
        </p>
        <div class="container">
            <ul class="nav nav-tabs row d-flex" data-aos="fade-up" data-aos-delay="100">
                <li class="nav-item col-3">
                    <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#features-tab-1">
                        <i class="bi bi-journal-bookmark"></i> <!-- Pendidikadi-->
                        <h4 class="d-none d-lg-block">Program Pendidikan</h4>
                    </a>
                </li>
                <li class="nav-item col-3">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-2">
                        <i class="bi bi-book"></i> <!-- Tahfidz -->
                        <h4 class="d-none d-lg-block">Program Tahfidz 30 Juz</h4>
                    </a>
                </li>
                <li class="nav-item col-3">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-3">
                        <i class="bi bi-heart-pulse"></i> <!-- Kesehatan -->
                        <h4 class="d-none d-lg-block">Program Kesehatan</h4>
                    </a>
                </li>
                <li class="nav-item col-3">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-4">
                        <i class="bi bi-people-fill"></i> <!-- Sosial -->
                        <h4 class="d-none d-lg-block">Program Sosial</h4>
                    </a>
                </li>
            </ul>

            <div class="tab-content" data-aos="fade-up" data-aos-delay="200">

                <div class="tab-pane fade active show" id="features-tab-1">
                    <div class="row">
                        <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 " style="text-align: justify;">
                            <h3 class="text-start">Program Pendidikan Gratis untuk Anak Asuh</h3>
                            <p class="fst-italic">
                                Panti Asuhan Mizan Amanah menyediakan fasilitas pendidikan gratis sebagai bentuk
                                komitmen dalam mencerdaskan anak-anak yatim, piatu, dan dhuafa.
                            </p>
                            <ul>
                                <li><i class="bi bi-check2-all"></i>
                                    <span>Biaya sekolah dan kebutuhan pendidikan ditanggung penuh oleh panti.</span>
                                </li>
                                <li><i class="bi bi-check2-all"></i>
                                    <span>Pembinaan belajar intensif, termasuk bimbingan mata pelajaran dan tahfidz
                                        Al-Qur’an.</span>
                                </li>
                                <li><i class="bi bi-check2-all"></i>
                                    <span>Fasilitas pendidikan non-formal seperti pelatihan komputer, kewirausahaan,
                                        dan
                                        keterampilan hidup.</span>
                                </li>
                            </ul>
                            <p>
                                Melalui program ini, Panti Asuhan Mizan Amanah berharap dapat mencetak generasi yang
                                tidak hanya cerdas secara akademik, tetapi juga kuat dalam karakter, spiritual, dan
                                siap
                                berkontribusi di tengah masyarakat.
                            </p>
                        </div>
                        <div class="col-lg-6 order-1 order-lg-2 text-center">
                            <img src="assets/program/Pendidikan.webp" alt="" class="img-fluid rounded-3">
                        </div>
                    </div>
                </div><!-- End Tab Content Item -->

                <div class="tab-pane fade" id="features-tab-2" style="text-align: justify;">
                    <div class="row">
                        <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                            <h3 class="text-start">Program Tahfidz 30 Juz</h3>
                            <p class="fst-italic">
                                Program Tahfidz Al-Qur'an menjadi salah satu kegiatan utama dalam membentuk karakter
                                religius dan spiritual anak-anak asuh.
                            </p>
                            <ul>
                                <li><i class="bi bi-check2-all"></i>
                                    <span>Pembelajaran rutin hafalan Al-Qur'an setiap hari dengan target hafalan
                                        sesuai
                                        kemampuan anak.</span>
                                </li>
                                <li><i class="bi bi-check2-all"></i>
                                    <span>Dibimbing oleh pengajar yang berkompeten di bidang tahfidz dan
                                        tajwid.</span>
                                </li>
                                <li><i class="bi bi-check2-all"></i>
                                    <span>Evaluasi hafalan secara berkala dan motivasi melalui kegiatan murojaah
                                        bersama
                                        dan wisuda tahfidz.</span>
                                </li>
                            </ul>
                            <p>
                                Dengan program ini, diharapkan anak-anak tidak hanya mampu menghafal Al-Qur’an,
                                tetapi
                                juga menjadikannya pedoman hidup yang tertanam dalam keseharian mereka.
                            </p>
                        </div>
                        <div class="col-lg-6 order-1 order-lg-2 text-center">
                            <img src="assets/program/Tahfiz.webp" alt="" class="img-fluid rounded-3">
                        </div>
                    </div>
                </div><!-- End Tab Content Item -->

                <div class="tab-pane fade" id="features-tab-3">
                    <div class="row">
                        <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0" style="text-align: justify;">
                            <h3 class="text-start">Program Kesehatan untuk Anak Panti</h3>
                            <p>
                                Panti Asuhan Mizan Amanah berkomitmen menjaga kesehatan fisik dan mental anak-anak
                                asuh
                                melalui berbagai kegiatan preventif dan pemeriksaan rutin agar tumbuh kembang mereka
                                tetap optimal.
                            </p>
                            <ul>
                                <li><i class="bi bi-check2-all"></i>
                                    <span>Pemeriksaan kesehatan berkala oleh tenaga medis dan fasilitas layanan
                                        kesehatan terdekat.</span>
                                </li>
                                <li><i class="bi bi-check2-all"></i>
                                    <span>Pembiasaan pola hidup sehat seperti kebersihan diri, olahraga, dan
                                        konsumsi
                                        makanan bergizi.</span>
                                </li>
                                <li><i class="bi bi-check2-all"></i>
                                    <span>Pendampingan psikologis untuk menjaga kesehatan mental dan emosi anak-anak
                                        asuh.</span>
                                </li>
                            </ul>
                            <p class="fst-italic">
                                Program ini bertujuan menciptakan lingkungan panti yang sehat, nyaman, dan mendukung
                                pertumbuhan anak secara menyeluruh.
                            </p>
                        </div>
                        <div class="col-lg-6 order-1 order-lg-2 text-center">
                            <img src="assets/program/Kesehatan.webp" alt="" class="img-fluid rounded-3">
                        </div>
                    </div>
                </div><!-- End Tab Content Item -->

                <div class="tab-pane fade" id="features-tab-4">
                    <div class="row">
                        <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0" style="text-align: justify;">
                            <h3 class="text-start">Program Sosial serta Kepedulian Masyarakat</h3>
                            <p>
                                Program sosial di Panti Asuhan Mizan Amanah bertujuan untuk menumbuhkan nilai
                                empati,
                                solidaritas, dan keterlibatan aktif anak-anak dalam kegiatan kemasyarakatan.
                            </p>
                            <p class="fst-italic">
                                Melalui kegiatan ini, anak-anak dilatih untuk tidak hanya menjadi penerima bantuan,
                                tetapi juga mampu berbagi dan berkontribusi untuk lingkungan sekitar.
                            </p>
                            <ul>
                                <li><i class="bi bi-check2-all"></i> <span>Kegiatan bakti sosial dan kunjungan ke
                                        masyarakat kurang mampu atau lansia.</span></li>
                                <li><i class="bi bi-check2-all"></i> <span>Partisipasi dalam acara keagamaan, gotong
                                        royong, dan peringatan hari besar nasional.</span></li>
                                <li><i class="bi bi-check2-all"></i> <span>Pembinaan karakter dan pendidikan moral
                                        melalui pengabdian sosial sederhana.</span></li>
                            </ul>
                        </div>
                        <div class="col-lg-6 order-1 order-lg-2 text-center">
                            <img src="assets/program/Sosial.webp" alt="" class="img-fluid rounded-3">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Footter -->
    <footer>
        <?php
        include 'footer.php';
        ?>
    </footer>

    <!--   *****   JQuery Link   *****   -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <!--   *****   Isotope Filter Link   *****  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"></script>

    <!--   *****   Bootstrap JS Link   *****   -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Js main -->
    <script src="js/navbar.js"></script>

    <script>
    function toggleText() {
        const dots = document.getElementById("dots");
        const moreText = document.getElementById("more");
        const btnText = document.getElementById("readMoreBtn");

        if (dots.style.display === "none") {
            dots.style.display = "inline";
            btnText.innerHTML = "Baca Selengkapnya";
            moreText.style.display = "none";
        } else {
            dots.style.display = "none";
            btnText.innerHTML = "Sembunyikan";
            moreText.style.display = "inline";
        }
    }

    // Filter fungsi
    function filterGallery(kategori, button) {
        const images = document.querySelectorAll(".gambah img");
        images.forEach((img) => {
            const imgKategori = img.getAttribute("data-kategori");
            if (kategori === "all" || imgKategori === kategori) {
                img.classList.remove("hidden");
            } else {
                img.classList.add("hidden");
            }
        });

        document
            .querySelectorAll(".filter-btn")
            .forEach((btn) => btn.classList.remove("active"));
        button.classList.add("active");
    }

    // Lightbox logic
    document.querySelectorAll(".gambah img").forEach((img) => {
        img.addEventListener("click", () => {
            document.getElementById("lightbox-img").src = img.src;
            document.getElementById("lightbox").style.display = "flex";
        });
    });

    function closeLightbox() {
        document.getElementById("lightbox").style.display = "none";
    }

    document.getElementById("lightbox").addEventListener("click", (e) => {
        if (e.target.id === "lightbox") {
            closeLightbox();
        }
    });
    </script>
</body>

</html>