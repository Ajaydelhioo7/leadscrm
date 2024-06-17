<?php
session_start();

// Update the last checked time in session to the current time
$_SESSION['last_checked_counsellor'] = date("Y-m-d H:i:s");

echo json_encode(['status' => 'success']);
?>
