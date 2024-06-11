<?php
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $student_name = $_POST['student_name'];
    $mob_no = $_POST['mob_no'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $state = $_POST['state'];
    $qualification = $_POST['qualification'];
    $pursuing_specification = $_POST['pursuing_specification'];
    $attempted_prelims = $_POST['attempted_prelims'];
    $know_about_us = $_POST['know_about_us'];
    $enquiring_for = $_POST['enquiring_for'];
    $test_series = $_POST['test_series'];
    $target_year = $_POST['target_year'];
    $medium = $_POST['medium'];
    $mode = $_POST['mode'];
    $enquiry_by = $_POST['enquiry_by'];
    $counsellor = $_POST['counsellor'];
    $date = $_POST['date'];
    $center = $_POST['center'];

    $stmt = $conn->prepare("UPDATE enquiries SET student_name = ?, mob_no = ?, email = ?, address = ?, state = ?, qualification = ?, pursuing_specification = ?, attempted_prelims = ?, know_about_us = ?, enquiring_for = ?, test_series = ?, target_year = ?, medium = ?, mode = ?, enquiry_by = ?, counsellor = ?, date = ?, center = ? WHERE id = ?");
    $stmt->bind_param("ssssssssssssssssssi", $student_name, $mob_no, $email, $address, $state, $qualification, $pursuing_specification, $attempted_prelims, $know_about_us, $enquiring_for, $test_series, $target_year, $medium, $mode, $enquiry_by, $counsellor, $date, $center, $id);

    if ($stmt->execute()) {
        echo "Enquiry updated successfully!";
    } else {
        echo "Error updating enquiry: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
