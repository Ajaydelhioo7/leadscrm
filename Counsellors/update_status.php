<?php
session_start();
if (!isset($_SESSION['counsellor_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enquiry_id = intval($_POST['enquiry_id']);
    $status_id = intval($_POST['status_id']);
    
    if ($enquiry_id && $status_id) {
        $stmt = $conn->prepare("UPDATE enquiries SET status_id = ? WHERE id = ?");
        $stmt->bind_param("ii", $status_id, $enquiry_id);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Status updated successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update status']);
        }
        
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid input']);
    }
}

$conn->close();
?>
