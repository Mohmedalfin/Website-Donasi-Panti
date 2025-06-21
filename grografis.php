<?php
session_start();
include 'conn.php'; // koneksi database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        $stmt = $conn->prepare("INSERT INTO messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("ssss", $name, $email, $subject, $message);
            if ($stmt->execute()) {
                echo "success"; // << kirim 'success' string
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    } else {
        echo "empty";
    }
    exit(); // stop supaya tidak ngeprint HTML
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Geografis Dusun</title>

    <!-- Boostrep -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

    <!-- Icon CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    <!-- Style CSS -->
    <link rel="stylesheet" href="css/style.css" />

    <!-- Font style -->
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">


    <style>
    @media (max-width: 768px) {
        .contact-section h2 {
            font-size: 20px;
            font-weight: 600;
        }
    }
    </style>
</head>

<body>
    <!-- Navbar -->
    <?php include 'admin/assets/include/header.php'; ?>

    <!-- Page Header -->
    <section class="page-header text-center">
        <div class="container">
            <h1
                style="color: #f8a23d; font-family: 'Dancing Script', cursive; font-weight: 700; letter-spacing: 1px; text-transform: capitalize; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">
                Panti Asuhan Mizan Amanah</h1>
            <p>Mewujudkan masa depan cerah bagi anak-anak yatim dan dhuafa melalui kasih sayang, pendidikan, dan
                dukungan Anda</p>
        </div>
    </section>

    <!-- Maps Dusun -->
    <section class="maps-dusun">
        <div class="p-4 mt-5">
            <h2 class="display-6 text-center pt-5">LOKASI PANTI ASUHAN</h2>
            <p class="bottom-contact-title mb-2"></p>
            <p class="fw-semibold text-center">
                Informasi terkait lokasi Panti Asuhan Mizan Amanah
            </p>
            <div class="map-wrapper">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253018.20331957898!2d110.18845002997298!3d-7.746323417215077!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5907ea865f63%3A0xeedfecd402ec9c33!2sPanti%20Asuhan%20Yatim%20%26%20Dhuafa%20Mizan%20Amanah%20Yogyakarta!5e0!3m2!1sid!2sid!4v1746065530181!5m2!1sid!2sid"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </section>

    <!-- Faq Section -->
    <section>
        <div class="container contact-section mb-4">
            <div class="text-center mb-5 mt-5">
                <h2>HUBUNGI KAMI</h2>
                <p class="bottom-contact-title"></p>
                <p class="mt-3 fw-semibold m-3">Silakan gunakan formulir ini untuk menyampaikan pesan atau
                    pertanyaan Anda.
                </p>
            </div>

            <div class="row">
                <div class="col-md-4 contact-info-design">
                    <div class="info-box">
                        <i class="fas fa-phone-alt"></i>
                        <div>
                            <h5>Telephone</h5>
                            <p>08123456789</p>
                        </div>
                    </div>
                    <div class="info-box">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <h5>Email</h5>
                            <p>mizanamanah.panti@gmail.com</p>
                        </div>
                    </div>
                    <div class="info-box">
                        <i class="fab fa-instagram"></i>
                        <div>
                            <h5>Instagram</h5>
                            <p>pantimizanamanahyk_</p>
                        </div>
                    </div>
                    <div class="info-box">
                        <i class="fab fa-facebook"></i>
                        <div>
                            <h5>Facebook</h5>
                            <p>pantimizanamanah</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 form-input">
                    <form id="contactForm" method="post">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="subject" class="form-control" placeholder="Subject" required>
                        </div>
                        <div class="mb-3">
                            <textarea name="message" class="form-control" style="height: 180px;" placeholder="Message"
                                required></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="send" class="btn btn-send">Send Message</button>
                        </div>
                    </form>

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

    <!--   *****   JQuery Link   *****   -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <!--   *****   Isotope Filter Link   *****  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"></script>

    <!-- Bootstrep JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- Js main -->
    <script src="js/navbar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#contactForm').submit(function(e) {
            e.preventDefault(); // stop reload

            Swal.fire({
                title: 'Mengirim...',
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                type: 'POST',
                url: '', // submit ke halaman ini
                data: $(this).serialize(),
                success: function(response) {
                    if (response.trim() === 'success') {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Pesan Anda berhasil dikirim!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'grografis.php';
                            }
                        });
                    } else if (response.trim() === 'empty') {
                        Swal.fire({
                            title: 'Form Belum Lengkap!',
                            text: 'Mohon isi semua data.',
                            icon: 'warning'
                        });
                    } else {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan. Coba lagi.',
                            icon: 'error'
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Tidak bisa mengirim data. Periksa koneksi Anda.',
                        icon: 'error'
                    });
                }
            });
        });
    });
    </script>


</body>

</html>