<?php
session_start();
include '../config/db.php';

header('Content-Type: text/plain');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['enquiry_id'], $_POST['followup_date'], $_POST['remarks'], $_POST['status'])) {
    $enquiry_id = $_POST['enquiry_id'];
    $counsellor_id = $_SESSION['counsellor_id'];
    $followup_date = $_POST['followup_date'];
    $remarks = $_POST['remarks'];
    $status_id = $_POST['status'];

    // Debugging lines
    error_log("enquiry_id: $enquiry_id");
    error_log("counsellor_id: $counsellor_id");
    error_log("followup_date: $followup_date");
    error_log("remarks: $remarks");
    error_log("status_id: $status_id");

    // Check if the status_id exists in the status table
    $status_check_stmt = $conn->prepare("SELECT id FROM status WHERE id = ?");
    if (!$status_check_stmt) {
        error_log("Status check prepare failed: " . $conn->error);
        echo "Error preparing statement for status check.";
        exit();
    }
    $status_check_stmt->bind_param("i", $status_id);
    $status_check_stmt->execute();
    $status_check_result = $status_check_stmt->get_result();

    if ($status_check_result->num_rows == 0) {
        echo "Invalid status ID.";
        exit();
    }
    $status_check_stmt->close();

    // Insert follow-up record
    $stmt = $conn->prepare("INSERT INTO followups (enquiry_id, counsellor_id, followup_date, remarks) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        error_log("Insert follow-up prepare failed: " . $conn->error);
        echo "Error preparing statement for follow-up insertion.";
        exit();
    }
    $stmt->bind_param("iiss", $enquiry_id, $counsellor_id, $followup_date, $remarks);
    if (!$stmt->execute()) {
        error_log("Insert follow-up execute failed: " . $stmt->error);
        echo "Error executing statement for follow-up insertion.";
        exit();
    }
    $stmt->close();

    // Update enquiry status
    $stmt = $conn->prepare("UPDATE enquiries SET status_id = ? WHERE id = ?");
    if (!$stmt) {
        error_log("Update status prepare failed: " . $conn->error);
        echo "Error preparing statement for status update.";
        exit();
    }
    $stmt->bind_param("ii", $status_id, $enquiry_id);
    if (!$stmt->execute()) {
        error_log("Update status execute failed: " . $stmt->error);
        echo "Error executing statement for status update. Error: " . $stmt->error;
        exit();
    }
    $stmt->close();

    echo "Follow-up added and enquiry status updated successfully!";
    exit();
} else {
    echo "Invalid request!";
    exit();
}

$conn->close();
?>
