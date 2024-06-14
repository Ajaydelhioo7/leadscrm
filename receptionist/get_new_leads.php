<?php
session_start();
include '../config/db.php';

// Get the last checked time from session, default to 1 day ago if not set
$last_checked = isset($_SESSION['last_checked']) ? $_SESSION['last_checked'] : date("Y-m-d H:i:s", strtotime("-1 day"));

// Query to get new leads since the last checked time
$query = "SELECT student_name FROM enquiries WHERE date > '$last_checked'";
$result = $conn->query($query);

$leads = [];
while ($row = $result->fetch_assoc()) {
    $leads[] = $row;
}

// Output the leads as JSON
echo json_encode(['leads' => $leads]);

// Update the last checked time in session to the current time
$_SESSION['last_checked'] = date("Y-m-d H:i:s");

$conn->close();
?>
