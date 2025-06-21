<?php
include 'partials/head.php';
?>

<body id="page-top">
    <div id="wrapper">
        <?php include 'partials/sidebar.php'; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php include 'partials/navbar.php'; ?>

                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Artikel</h6>
                            <a href="tambah.php" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah</a>
                        </div>

                        <div class="card-body">
                            <!-- Filter Section - Improved Layout -->
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="statusFilter">Status</label>
                                        <select id="statusFilter" class="form-control form-control-sm">
                                            <option value="">Semua Status</option>
                                            <option value="published">Published</option>
                                            <option value="draft">Draft</option>
                                            <option value="archived">Archived</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="categoryFilter">Kategori</label>
                                        <select id="categoryFilter" class="form-control form-control-sm">
                                            <option value="">Semua Kategori</option>
                                            <!-- Kategori akan dimuat via AJAX -->
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead class="thead-light">
                                        <tr class="text-center">
                                            <th width="5%">#</th>
                                            <th width="20%">Judul</th>
                                            <th width="15%">Kategori</th>
                                            <th width="25%">Konten</th>
                                            <th width="10%">Status</th>
                                            <th width="15%">Jadwal</th>
                                            <th width="10%">Aksi</th>
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
    <script>
    $(document).ready(function() {
        $(document).ready(function() {
            $.ajax({
                url: 'dataKategori.php',
                method: 'GET',
                dataType: 'json', // <-- PASTIKAN INI ADA
                success: function(response) {
                    console.log("Response Data (Parsed):", response);

                    // Pastikan response adalah objek dan memiliki properti 'data'
                    if (response && response.data && Array.isArray(response.data)) {
                        var categoryFilter = $('#categoryFilter');
                        categoryFilter.empty();
                        categoryFilter.append('<option value="">All</option>');

                        // Loop melalui kategori
                        response.data.forEach(function(category) {
                            categoryFilter.append('<option value="' + category
                                .name + '">' + category.name + '</option>');
                        });
                    } else {
                        console.error('Format data tidak valid:', response);
                        $('#categoryFilter').append(
                            '<option value="">Error: Invalid data format</option>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                    $('#categoryFilter').append(
                        '<option value="">Error: Failed to load</option>');
                }
            });
        });



        var table = $('#dataTable').DataTable({
            "ajax": "data.php",
            "columns": [{
                    "data": null,
                    "render": function(data, type, row, meta) {
                        return meta.row + 1 + table.page.info().start;
                    }
                },
                {
                    "data": "title"
                },
                {
                    "data": "name",

                },
                {
                    "data": "content",
                    "render": function(data, type, row) {
                        var words = data.split(' ');
                        var truncatedContent = words.slice(0, 20).join(' ') + (words.length >
                            5 ? '...' : '');
                        return truncatedContent;
                    }
                },

                {
                    "data": "status",
                    "class": "text-center",
                    "render": function(data, type, row) {
                        if (data == "published") {
                            return '<span class="badge badge-success">' + "Published" +
                                '</span>';
                        } else if (data == "archived") {
                            return '<span class="badge badge-danger">' + "Archived" + '</span>';
                        } else if (data == "draft") {
                            return '<span class="badge badge-warning">' + "Draft" + '</span>';
                        }
                    }
                },
                {
                    "data": "scheduled_at",
                    "class": "text-center",
                    "render": function(data, type, row) {
                        if (row.status == "published" || row.status == "archived") {
                            return '-';
                        } else {
                            const date = new Date(data);
                            const options = {
                                weekday: 'long',
                                day: 'numeric',
                                month: 'long',
                                year: 'numeric'
                            };
                            return new Intl.DateTimeFormat('id-ID', options).format(date);
                        }
                    }
                },
                {
                    "data": null,
                    "class": "text-center",
                    "render": function(data, type, row) {
                        return `
                        <div class="dropdown">
                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bars"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="edit.php?id=${row.id}">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a class="dropdown-item" href="delete.php?id=${row.id}" onclick="return confirm('Apakah anda yakin untuk mengarsipkan artikel?');">
                                    <i class="fas fa-archive"></i> Archive
                                </a>
                            </div>
                        </div>
                    `;
                    }
                },
                {
                    "data": "created_at",
                    "visible": false
                }
            ],
            "order": [
                [6, 'desc']
            ]
        });

        $('#statusFilter').on('change', function() {
            var statusFilter = $(this).val();
            if (statusFilter) {
                table.column(4).search(statusFilter).draw();
            } else {
                table.column(4).search('').draw();
            }
        });
        $('#categoryFilter').on('change', function() {
            var categoryFilter = $(this).val();
            if (categoryFilter) {
                table.column(2).search(categoryFilter).draw();
            } else {
                table.column(2).search('').draw();
            }
        });
    });
    </script>

</body>

</html>