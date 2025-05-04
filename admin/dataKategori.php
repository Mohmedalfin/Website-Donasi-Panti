<?php
include '../conn.php';  
try {
    $query = "SELECT * FROM categories";  
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        $data = $result->fetch_all(MYSQLI_ASSOC);  
        $response = array(
            "data" => $data  
        );
        // var_dump($response);
        echo json_encode($response);  
    } else {
        echo json_encode(array("message" => "No categories found"));  
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

$conn->close();
?>
