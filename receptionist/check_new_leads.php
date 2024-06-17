<?php
session_start();
include '../config/db.php';

// Get the last checked time from session, default to 1 day ago if not set
$last_checked = isset($_SESSION['last_checked']) ? $_SESSION['last_checked'] : date("Y-m-d H:i:s", strtotime("-1 day"));

// Query to count new leads since the last checked time
$query = "SELECT COUNT(id) as new_leads FROM enquiries WHERE date > '$last_checked'";
$result = $conn->query($query);
$row = $result->fetch_assoc();

// Output the count of new leads as JSON
echo json_encode(['new_leads' => $row['new_leads']]);

$conn->close();
?>
