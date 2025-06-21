<?php
include 'partials/head.php';
?>

<body id="page-top">
    <div id="wrapper">
        <?php include 'partials/sidebar.php'; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'partials/navbar.php'; ?>

                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Pesan Masuk</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead class="thead-light">
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th>Nama Lengap</th>
                                            <th>Email</th>
                                            <th>Nominal Donasi</th>
                                            <th>No. Handphone</th>
                                            <th>Tanggal</th>
                                            <th>Catatan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <?php include 'partials/footer.php'; ?>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>
    <?php include 'partials/modal.php'; ?>
    <?php include 'partials/script.php'; ?>

    <!-- Modal Detail Pesan -->
    <div class="modal fade" id="messageDetailModal" tabindex="-1" role="dialog"
        aria-labelledby="messageDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Data Donasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body-message">
                    <!-- Diisi via Ajax -->
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        var table = $('#dataTable').DataTable({
            "ajax": "dataDonasi.php", // File PHP yang ambil data messages
            "columns": [{
                    "data": null,
                    "render": function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    "data": "nama_lengkap"
                },
                {
                    "data": "email"
                },
                {
                    "data": "nominal"
                },
                {
                    "data": "no_handphone"
                },
                {
                    "data": "tgl_donasi",
                    "render": function(data) {
                        const date = new Date(data);
                        return date.toLocaleDateString('id-ID');
                    }
                },
                {
                    "data": "catatan",
                    "render": function(data, type, row) {
                        return data.length > 50 ? data.substr(0, 50) + '...' : data;
                    }
                },

                {
                    "data": null,
                    "class": "text-center",
                    "render": function(data, type, row) {
                        return `
                            <button class="btn btn-sm btn-info" onclick="showMessageDetail(${row.id})">
                                <i class="fas fa-eye"></i> Lihat
                            </button>
                            `;
                    }
                }
            ],
            "order": [
                [5, 'desc']
            ]
        });
    });

    function showMessageDetail(id) {
        $.ajax({
            url: 'getDataDonasi.php',
            method: 'GET',
            data: {
                id: id
            },
            success: function(response) {
                $('#modal-body-message').html(response);
                $('#messageDetailModal').modal('show');
            },
            error: function() {
                alert('Gagal mengambil detail pesan.');
            }
        });
    }
    </script>

</body>

</html>