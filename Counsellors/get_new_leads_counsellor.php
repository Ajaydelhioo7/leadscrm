<?php
session_start();
include '../config/db.php';

$counsellor_name = $_SESSION['counsellor_name'];

// Get the last checked time from session, default to 1 day ago if not set
$last_checked = isset($_SESSION['last_checked_counsellor']) ? $_SESSION['last_checked_counsellor'] : date("Y-m-d H:i:s", strtotime("-1 day"));

// Query to get new leads since the last checked time
$query = "SELECT student_name FROM enquiries WHERE counsellor = ? AND date > ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('ss', $counsellor_name, $last_checked);
$stmt->execute();
$result = $stmt->get_result();

$leads = [];
while ($row = $result->fetch_assoc()) {
    $leads[] = $row;
}

// Output the leads as JSON
echo json_encode(['leads' => $leads]);

$conn->close();
?>
