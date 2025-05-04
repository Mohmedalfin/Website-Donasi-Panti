<?php

include '../conn.php';

$current_time = date('Y-m-d H:i:s');

$sql = "SELECT id, title, scheduled_at FROM posts WHERE status = 'draft' AND scheduled_at <= '$current_time'";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $post_id = $row['id'];
        $update_sql = "UPDATE posts SET status = 'published', updated_at = '$current_time' WHERE id = $post_id";

        if ($conn->query($update_sql) === TRUE) {
            echo "Post ID $post_id has been published.\n";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
} else {
    echo "No scheduled posts found to publish.\n";
}

$conn->close();
?>
