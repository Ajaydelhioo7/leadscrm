<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "enquiry";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO enquiries (student_name, mob_no, email, address, state, qualification, pursuing_specification, attempted_prelims, know_about_us, enquiring_for, test_series, target_year, medium, mode, enquiry_by, counsellor, date, center) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("ssssssssssssssssss", $student_name, $mob_no, $email, $address, $state, $qualification, $pursuing_specification, $attempted_prelims, $know_about_us, $enquiring_for, $test_series, $target_year, $medium, $mode, $enquiry_by, $counsellor, $date, $center);

// Set parameters and execute
$student_name = $_POST['student_name'];
$mob_no = $_POST['mob_no'];
$email = $_POST['email'];
$address = $_POST['address'];
$state = $_POST['state'];
$qualification = $_POST['qualification'];
$pursuing_specification = $_POST['pursuing_specification'];
$attempted_prelims = $_POST['attempted_prelims'];
$know_about_us = isset($_POST['know_about_us']) ? implode(", ", $_POST['know_about_us']) : "";
$enquiring_for = isset($_POST['enquiring_for']) ? implode(", ", $_POST['enquiring_for']) : "";
$test_series = isset($_POST['test_series']) ? implode(", ", $_POST['test_series']) : "";
$target_year = $_POST['target_year'];
$medium = $_POST['medium'];
$mode = $_POST['mode'];
$enquiry_by = $_POST['enquiry_by'];
$counsellor = $_POST['counsellor'];
$date = $_POST['date'];
$center = $_POST['center'];

if (isset($_POST['optional_specification']) && !empty($_POST['optional_specification'])) {
    $enquiring_for = $enquiring_for . " Optional: " . $_POST['optional_specification'];
}

if (isset($_POST['test_series_optional_specification']) && !empty($_POST['test_series_optional_specification'])) {
    $test_series = $test_series . " Optional: " . $_POST['test_series_optional_specification'];
}

if ($stmt->execute()) {
    echo "<script>
        alert('New record created successfully');
        window.location.href='index.php';
    </script>";
} else {
    echo "<script>
        alert('Error: " . $stmt->error . "');
        window.location.href='index.php';
    </script>";
}

$stmt->close();
$conn->close();
?>
