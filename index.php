<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
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

</head>

<body>
    <!-- Navbar -->
    <?php include 'admin/assets/include/header.php'; ?>

    <!-- Conten Home -->
    <section class="home">
        <video class="video-slide active" src="assets/vidio/AnakPanti.mp4" autoplay muted loop></video>
        <div class="content active">
            <h1>Selamat Datang<br /> di Website<span
                    style="color: #f8a23d; font-family: 'Dancing Script', cursive; font-size: 40px; font-weight: 700; letter-spacing: 1px; text-transform: capitalize;  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">
                    Panti Asuhan Mizan Amanah</span> Yogyakarta</h1>
            <p>
                Di sini, setiap kebaikan yang Anda berikan adalah harapan bagi mereka
                yang kehilangan kasih sayang orang tua. Mari bersama-sama membangun
                masa depan yang lebih cerah bagi anak-anak yatim dengan berbagi
                rezeki, kasih sayang, dan kepedulian. </p>
        </div>
    </section>

    <!-- Intro Kades -->
    <section class="about">
        <div class="about-img">
            <img src="assets/Logo_Panti.png" alt="" class="fade-in-image" class="touch-animate-img" />
        </div>
        <div class="about-content">
            <h2 class="heading">SAMBUTAN KETUA YAYASAN</h2>
            <h3>Assalamualaikum Warohmatullah Wabarokatuh,</h3>
            <p class="fw-medium">
                Website ini kami hadirkan sebagai bentuk adaptasi Yayasan Panti Asuhan terhadap perkembangan teknologi,
                sekaligus sebagai sarana informasi dan dokumentasi kegiatan kami. Semoga website ini dapat mempererat
                hubungan kami dengan masyarakat dan menjadi media transparansi serta inspirasi bersama.
            </p>
            <h3 class="pt-3" style="font-family: 'Dancing Script', cursive;">Ketua Yayasan Panti Asuhan</h3>
        </div>
    </section>

    <!-- Visi dan Misi -->
    <section id=" beranda" class="beranda">
        <div class="container position-relative">
            <!-- VISI -->
            <div class="row justify-content-center" data-aos="fade-up">
                <h2 class="text-center mt-5 mb-2 visi-misi">VISI & MISI</h2>
                <h2 class="text-center mt-0 mb-4 visi">VISI</h2>
                <div class="col-lg-10 col-md-11">
                    <div class="card shadow-sm mx-2">
                        <div class="card-body">
                            <p class="card-text fw-medium">
                                Menjadi lembaga pengasuhan yang amanah, profesional, dan berdaya dalam membentuk
                                generasi mandiri, berakhlak mulia, dan berkontribusi positif bagi masyarakat.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MISI -->
            <div class="row justify-content-center" data-aos="fade-up">
                <h2 class="text-center my-4 misi">MISI</h2>
                <!-- Repeated Cards -->
                <div class="col-lg-5 col-md-11 d-flex align-items-stretch mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <p class="card-text fw-medium">
                                Menyelenggarakan pengasuhan anak yatim dan dhuafa secara holistik berbasis nilai-nilai
                                Islam.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-md-11 d-flex align-items-stretch mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <p class="card-text fw-medium">
                                Memberikan pendidikan dan pembinaan karakter untuk membentuk pribadi yang tangguh dan
                                bertanggung jawab.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-md-11 d-flex align-items-stretch mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <p class="card-text fw-medium">
                                Meningkatkan kualitas hidup anak asuh melalui pembekalan keterampilan, pendidikan formal
                                dan non-formal.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-md-11 d-flex align-items-stretch mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <p class="card-text fw-medium">
                                Membangun sinergi dengan masyarakat, donatur, dan lembaga mitra untuk mendukung
                                keberlangsungan program.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-md-11 d-flex align-items-stretch mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <p class="card-text fw-medium">
                                Mengelola yayasan secara transparan, profesional, dan akuntabel sesuai prinsip amanah
                                dan syariah.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Admistrasi -->
    <section id="stats" class="stats section dark-background mb-3">
        <img src="" alt="" data-aos="fade-in" />
        <div class="container-fluid position-relative" data-aos="fade-up" data-aos-delay="100">
            <!-- Subheading Section -->
            <div class="subheading">
                <h2>INFORMASI JUMLAH ANAK ASUHAN</h2>
                <p class="bottom-contact-title mb-2"></p>
                <p>Informasi jumlah anak asuhan di Panti Mizan Amanah</p>
            </div>

            <!-- Stats Items -->
            <div class="row gy-4 justify-content-center">
                <!-- Penduduk -->
                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="356" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>Jumlah</p>
                    </div>
                </div>

                <!-- Perempuan -->
                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="150" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>Laki-laki</p>
                    </div>
                </div>

                <!-- Laki-laki -->
                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="206" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>Perempuan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footter -->
    <footer>
        <?php
        include 'admin/assets/include/footer.php';
        ?>
    </footer>
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
    $('.btn-logout').on('click', function() {
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