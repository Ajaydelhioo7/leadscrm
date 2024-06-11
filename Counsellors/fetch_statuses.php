<?php
include '../config/db.php';

$result = $conn->query("SELECT * FROM status");
$statuses = [];

while ($row = $result->fetch_assoc()) {
    $statuses[] = $row;
}

echo json_encode($statuses);

$conn->close();
?>
