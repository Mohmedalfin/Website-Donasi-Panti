<?php
include '../conn.php';

$query = "SELECT * FROM datadonasi ORDER BY tgl_donasi DESC";
$result = $conn->query($query);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode(["data" => $data]);
?>