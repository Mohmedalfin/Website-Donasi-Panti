<?php
include '../conn.php';

$query = "SELECT * FROM messages ORDER BY created_at DESC";
$result = $conn->query($query);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode(["data" => $data]);
?>
