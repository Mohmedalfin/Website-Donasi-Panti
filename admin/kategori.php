<?php
include 'partials/head.php';
?>
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
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Kategori</h6>
                            <a href="tambahKategori.php" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="thead-light">
                                        <tr class="text-center">
                                            <th width="5%">#</th>
                                            <th width="30%">Nama Kategori</th>
                                            <th width="30%">Slug</th>
                                            <th width="15%">Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include 'partials/footer.php'; ?>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    
    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

    <!-- Logout Modal-->
    <?php include 'partials/modal.php'; ?>

    <?php include 'partials/script.php'; ?>
    <script>
        $(document).ready(function() {
            var table = $('#dataTable').DataTable({
                "ajax": "dataKategori.php",
                "columns": [{
                        "data": null,
                        "render": function(data, type, row, meta) {
                            return meta.row + 1 + table.page.info().start;
                        }
                    },
                    {
                        "data": "name"
                    },
                    {
                        "data": "slug",
                    }, {
                        "data": null,
                        "class": "text-center",
                        "render": function(data, type, row) {
                            return `
                        <div class="dropdown">
                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bars"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="editKategori.php?id=${row.id}">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a class="dropdown-item" href="deleteKategori.php?id=${row.id}" onclick="return confirm('Apakah anda yakin untuk menghapus Kategori Maka semua postingan akan terhapus?');">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </div>
                        </div>
                    `;
                        }
                    },

                ],
                "order": [
                    [1, 'desc']
                ]
            });

            // $('#statusFilter').on('change', function() {
            //     var statusFilter = $(this).val();
            //     if (statusFilter) {
            //         table.column(3).search(statusFilter).draw(); 
            //     } else {
            //         table.column(3).search('').draw();
            //     }
            // });
        });
    </script>

</body>

</html>