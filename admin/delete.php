<?php
include '../conn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $stmt = $conn->prepare("update posts set status='archived' WHERE id = ?");
        if ($stmt === false) {
            die("Prepare failed: " . htmlspecialchars($conn->error));
        }

        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . htmlspecialchars($stmt->error);
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: index.php");
    exit();
}
