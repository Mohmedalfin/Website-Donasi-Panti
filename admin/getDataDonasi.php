<?php
include '../conn.php';

$id = $_GET['id'] ?? 0;
$stmt = $conn->prepare("SELECT * FROM datadonasi WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$datadonasi = $result->fetch_assoc();

if ($datadonasi):
    ?>

<div class="container">
    <div class="row mb-3">
        <div class="col-md-6">
            <h5 class="text-primary">👤 Pengirim</h5>
            <p class="mb-1"><strong>Nama :</strong> <?= htmlspecialchars($datadonasi['nama_lengkap']) ?></p>
            <p class="mb-1"><strong>Email :</strong> <?= htmlspecialchars($datadonasi['email']) ?></p>
            <p class="mb-1"><strong>No. Handphone :</strong> <?= htmlspecialchars($datadonasi['no_handphone']) ?></p>
        </div>
        <div class="col-md-6">
            <h5 class="text-primary">📅 Informasi</h5>
            <p class="mb-1"><strong>Tanggal Kirim :</strong>
                <?= date('d M Y H:i', strtotime($datadonasi['tgl_donasi'])) ?>
            <p class="mb-1"><strong>Nominal :</strong> <?= htmlspecialchars($datadonasi['nominal']) ?></p>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h5 class="text-primary">✉️ Isi Catatan</h5>
            <div class="p-3 border rounded" style="background-color: #f8f9fa;">
                <?= nl2br(htmlspecialchars($datadonasi['catatan'])) ?>
            </div>
        </div>
    </div>
</div>

<?php else: ?>
<p class="text-center">Pesan tidak ditemukan.</p>
<?php endif; ?>