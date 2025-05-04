<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kelompok Tani - Padukuhan Dukuh</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

    <!-- Icon CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="vendor/bootstrap-icons/bootstrap-icons.min.css" />

    <!-- Style CSS -->
    <link rel="stylesheet" href="./css/style.css" />

    <!-- Font style -->
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">

</head>

<body>
    <!-- Navbar -->
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo d-flex align-items-center">
                <h1 class="sitename">Padukuhan Dukuh</h1>
                <span>.</span>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">Tentang</a></li>
                    <li><a href="berita.php">Berita</a></li>
                    <li><a href="Kel-Tani.php" class="active">Donasi</a></li>
                    <li><a href="grografis.php">Geografis</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>
    </header>

    <!-- Page Header -->
    <section class="page-header text-center">
        <div class="container">
            <h1 style="color: #f8a23d; font-family: 'Dancing Script', cursive; font-weight: 700; letter-spacing: 1px; text-transform: capitalize; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);"">Panti Asuhan Mizan Amanah</h1>
            <p>Mewujudkan masa depan cerah bagi anak-anak yatim dan dhuafa melalui kasih sayang, pendidikan, dan
                dukungan Anda</p>
        </div>
    </section>


    <!-- Main Content -->
    <div class=" container">
                <!-- Introduction Section -->
                <section class="intro-section">
                    <div class="row align-items-center">
                        <div class="col-lg-4 text-center mb-4 mb-lg-0">
                            <div class="intro-icon mx-auto">
                                <i class="fas fa-hands-helping"></i>
                            </div>
                            <h2 class="h3 fw-bold" style="color: var(--color-primary);">Donasi untuk Panti Asuhan</h2>
                        </div>
                        <div class="col-lg-8">
                            <p class="lead mb-3">Panti Asuhan Mizan Amanah menyediakan tempat yang aman dan penuh kasih
                                bagi
                                anak-anak yatim dan dhuafa untuk tumbuh dan berkembang secara layak.</p>
                            <p>Melalui program donasi ini, Anda dapat berkontribusi langsung dalam mendukung kebutuhan
                                sehari-hari, pendidikan, dan masa depan mereka yang lebih cerah.</p>
                        </div>
                    </div>
                </section>

                <!-- Program Donasi -->
                <section class="section-spacing" id="program">
                    <h2 class="section-title">Program Donasi Panti Asuhan</h2>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="tani-card">
                                <div class="card-header d-flex align-items-center">
                                    <i class="fas fa-donate me-2"></i>
                                    <h5 class="mb-0">Program Donasi Rutin</h5>
                                </div>
                                <div class="card-body">
                                    <p>Kami membuka kesempatan bagi para dermawan untuk berdonasi secara rutin dalam
                                        rangka
                                        memenuhi kebutuhan harian dan pendidikan anak-anak asuh kami.</p>

                                    <h6 class="fw-bold mt-4 mb-3">Manfaat Donasi:</h6>
                                    <ul class="mb-4">
                                        <li>Membantu biaya pendidikan anak-anak</li>
                                        <li>Menyediakan makanan dan kebutuhan pokok</li>
                                        <li>Mendukung kesehatan dan pengobatan</li>
                                        <li>Membantu pembangunan fasilitas panti</li>
                                    </ul>

                                    <h6 class="fw-bold mt-4 mb-3">Cara Berdonasi:</h6>
                                    <ol class="mb-4">
                                        <li>Transfer ke Rekening BRI: 1234-5678-9012 a.n. Yayasan Harapan Bangsa</li>
                                        <li>Scan QRIS yang tersedia untuk donasi instan</li>
                                        <li>Donasi barang seperti sembako, perlengkapan sekolah, pakaian</li>
                                    </ol>

                                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                                        <i class="fas fa-info-circle me-2"></i>
                                        <div>Setiap donasi Anda sangat berarti. Donasi dapat dilakukan kapan saja sesuai
                                            kemampuan Anda.</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mt-4 mt-lg-0">
                            <div class="tani-card">
                                <div class="card-header d-flex align-items-center">
                                    <i class="fab fa-whatsapp me-2"></i>
                                    <h5 class="mb-0">Donasi Sekarang</h5>
                                </div>
                                <div class="card-body">
                                    <h4 class="mb-3" style="color: var(--color-primary);">Bantu Anak-anak Panti Asuhan
                                        Mizan
                                        Amanah</h4>
                                    <p class="mb-4">
                                        Setiap donasi Anda sangat berarti bagi masa depan anak-anak yatim dan dhuafa.
                                        Salurkan
                                        bantuan Anda sekarang juga melalui WhatsApp kami.
                                    </p>
                                    <div class="d-flex flex-wrap gap-3">
                                        <a href="Donasi.php" class="btn"
                                            style="background-color: var(--color-font-primary1); color: cornsilk;">
                                            </i> Donasi Sekarang
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
        </div>

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

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>

        <!-- Js main -->
        <script src="js/navbar.js"></script>
</body>

</html>