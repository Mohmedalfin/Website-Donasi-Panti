<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Donasi - Mizan Amanah</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />

    <!-- Link Style -->
    <link rel="stylesheet" href="./css/style.css" />

    <!-- Midtrans Pop UP -->
    <style>
        :root {
            --primary: #018577;
            --bg: #eaf8ef;
            --card-bg: #ffffff;
            --text: #333;
            --radius: 12px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-ligh" style="background-color: #018577;">
        <div class="container ">
            <a class="navbar-brand d-flex" href="/donete.php">
                <img src="/assets/Logo_Panti.png" alt="" width="45" height="45">
            </a>
        </div>
    </nav>

    <section class="page-header text-center" style="background-color: #eaf8ef; padding: 60px 20px;">
        <div class="container-intro">
            <h2 style="color: #018577; font-size: 30px; font-weight: bold; margin-bottom: 20px; text-align: center;">
                “Sedekah tidak akan mengurangi harta...”
            </h2>
            <p style="font-size: 18px; color: #444; max-width: 800px; margin: 0 auto; text-align: center;">
                Rasulullah ﷺ bersabda:
                <br>
                <em>
                    “Sedekah tidaklah mengurangi harta. Tidaklah seseorang memaafkan, melainkan Allah akan menambah
                    kemuliaan baginya. Dan tidaklah seseorang merendahkan diri karena Allah, melainkan Allah akan
                    mengangkat derajatnya.”
                </em><br>
                <strong>(HR. Muslim)</strong>
            </p>
        </div>
    </section>


    <div class="container-from">
        <div class="header-donasi">
            <h2>Isi Data Diri untuk Berdonasi</h2>
            <p>Jazākumullāhu Khayran</p>
        </div>
        <form class="form" id="donationForm" action="midtrans/placeOrder.php" method="post">
            <label for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" required />

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required />

            <label for="telepon">Nomor HP</label>
            <input type="text" id="telepon" name="telepon" required placeholder="Contoh: 081234567890" />

            <label>Nominal Donasi</label>
            <div class="amount-options">
                <div class="amount-button" data-value="50000">Rp 50.000</div>
                <div class="amount-button" data-value="100000">Rp 100.000</div>
                <div class="amount-button" data-value="500000">Rp 500.000</div>
                <div class="amount-button" data-value="1000000">Rp 1.000.000</div>
            </div>

            <label for="custom_nominal">Atau Masukkan Nominal Lain</label>
            <input type="number" id="custom_nominal" name="custom_nominal" placeholder="Contoh: 75000" />

            <label for="catatan">Catatan (Opsional)</label>
            <textarea id="catatan" name="catatan" rows="3"
                placeholder="Contoh: Untuk biaya pendidikan anak."></textarea>

            <input type="hidden" id="total" name="total" />

            <button class="button-donasi" id="pay-button" type="submit">Lanjut ke Pembayaran</button>
        </form>
    </div>
    <script src="js/midtrans.js"></script>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-1YnDJM-l_QGhYrBt"></script>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const amountButtons = document.querySelectorAll(".amount-button");
            const customInput = document.getElementById("custom_nominal");
            const totalInput = document.getElementById("total");

            amountButtons.forEach((button) => {
                button.addEventListener("click", () => {
                    // Hapus semua yang aktif
                    amountButtons.forEach((btn) => btn.classList.remove("selected"));
                    // Aktifkan tombol yang diklik
                    button.classList.add("selected");

                    const value = button.getAttribute("data-value");
                    customInput.value = value;
                    totalInput.value = value;
                });
            });

            // Jika mengetik di input custom
            customInput.addEventListener("input", () => {
                // Hapus semua tombol aktif
                amountButtons.forEach((btn) => btn.classList.remove("selected"));
                totalInput.value = customInput.value;
            });
        });
    </script>
</body>

</html>