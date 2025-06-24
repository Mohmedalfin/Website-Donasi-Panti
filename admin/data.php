<?php
header('Content-Type: application/json');
include '../conn.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Aktifkan error MySQLi sebagai exception
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $stmt = $conn->prepare("
        SELECT posts.*, categories.name as name, images.image_url as image
        FROM posts
        JOIN categories ON posts.category_id = categories.id
        LEFT JOIN images ON images.post_id = posts.id
    ");
    $stmt->execute();
    $resultSet = $stmt->get_result();
    $data = $resultSet->fetch_all(MYSQLI_ASSOC);

    if (empty($data)) {
        // Jika tidak ada data, kirim error JSON
        echo json_encode(["error" => "Data tidak ditemukan."]);
        exit;
    }

    // Bersihkan konten
    foreach ($data as &$row) {
        $row['content'] = htmlspecialchars(strip_tags($row['content']), ENT_QUOTES, 'UTF-8');
    }

    echo json_encode(["data" => $data]);

} catch (mysqli_sql_exception $e) {
    // Tangkap error dan kirim sebagai JSON
    echo json_encode(["error" => $e->getMessage()]);
}

$conn = null;