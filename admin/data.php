<?php
include '../conn.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

try {
    $stmt = $conn->prepare("SELECT posts.*, categories.name, images.image_url
    FROM posts
    JOIN categories ON posts.category_id = categories.id
    LEFT JOIN images ON images.post_id = posts.id");
    $stmt->execute();
    $resultSet = $stmt->get_result();
    $data = $resultSet->fetch_all(MYSQLI_ASSOC);

    foreach ($data as &$row) {
        $row['content'] = htmlspecialchars(strip_tags($row['content']), ENT_QUOTES, 'UTF-8');
    }

    $response = array(
        "data" => $data
    );

    echo json_encode($response);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
