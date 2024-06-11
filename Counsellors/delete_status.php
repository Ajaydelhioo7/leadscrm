<?php
session_start();
include '../config/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete status
    $stmt = $conn->prepare("DELETE FROM statuses WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    echo "Status deleted successfully!";
    header("Location: manage_statuses.php");
    exit();
}

$conn->close();
?>
