<?php
session_start();
if (!isset($_SESSION['admin_id'])) { // Assuming only admin can add statuses
    header("Location: index.php");
    exit();
}
include '../config/db.php';

// Check if status_name is provided
if (isset($_POST['status_name']) && !empty($_POST['status_name'])) {
    $status_name = trim($_POST['status_name']);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO status (status_name) VALUES (?)");
    if ($stmt) {
        $stmt->bind_param("s", $status_name);

        // Execute the query
        if ($stmt->execute()) {
            echo "Status added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    echo "Status name is required!";
}

$conn->close();
?>
