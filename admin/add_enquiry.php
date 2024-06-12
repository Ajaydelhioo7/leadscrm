<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_name = trim($_POST['student_name']);
    $mob_no = trim($_POST['mob_no']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);
    $state = trim($_POST['state']);
    $qualification = trim($_POST['qualification']);
    $pursuing_specification = trim($_POST['pursuing_specification']);
    $attempted_prelims = trim($_POST['attempted_prelims']);
    $know_about_us = trim($_POST['know_about_us']);
    $enquiring_for = trim($_POST['enquiring_for']);
    $test_series = trim($_POST['test_series']);
    $target_year = trim($_POST['target_year']);
    $medium = trim($_POST['medium']);
    $mode = trim($_POST['mode']);
    $enquiry_by = trim($_POST['enquiry_by']);
    $counsellor = trim($_POST['counsellor']);
    $date = trim($_POST['date']);
    $center = trim($_POST['center']);
    $status_id = trim($_POST['status_id']);

    $stmt = $conn->prepare("INSERT INTO enquiries (student_name, mob_no, email, address, state, qualification, pursuing_specification, attempted_prelims, know_about_us, enquiring_for, test_series, target_year, medium, mode, enquiry_by, counsellor, date, center, status_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssssssssssi", $student_name, $mob_no, $email, $address, $state, $qualification, $pursuing_specification, $attempted_prelims, $know_about_us, $enquiring_for, $test_series, $target_year, $medium, $mode, $enquiry_by, $counsellor, $date, $center, $status_id);
    if ($stmt->execute()) {
        header("Location: manage_enquiries.php");
        exit();
    } else {
        $error = "Error: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Enquiry</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include './includes/header.php' ?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3 class="text-center">Add Enquiry</h3>
        </div>
        <div class="card-body">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="POST" action="add_enquiry.php">
                <div class="form-group">
                    <label for="student_name">Student Name</label>
                    <input type="text" class="form-control" id="student_name" name="student_name" required>
                </div>
                <div class="form-group">
                    <label for="mob_no">Mobile No.</label>
                    <input type="text" class="form-control" id="mob_no" name="mob_no" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
                <div class="form-group">
                    <label for="state">State</label>
                    <input type="text" class="form-control" id="state" name="state" required>
                </div>
                <div class="form-group">
                    <label for="qualification">Qualification</label>
                    <input type="text" class="form-control" id="qualification" name="qualification" required>
                </div>
                <div class="form-group">
                    <label for="pursuing_specification">Pursuing Specification</label>
                    <input type="text" class="form-control" id="pursuing_specification" name="pursuing_specification">
                </div>
                <div class="form-group">
                    <label for="attempted_prelims">Attempted Prelims</label>
                    <input type="text" class="form-control" id="attempted_prelims" name="attempted_prelims" required>
                </div>
                <div class="form-group">
                    <label for="know_about_us">How Did You Know About Us</label>
                    <input type="text" class="form-control" id="know_about_us" name="know_about_us" required>
                </div>
                <div class="form-group">
                    <label for="enquiring_for">Enquiring For</label>
                    <input type="text" class="form-control" id="enquiring_for" name="enquiring_for" required>
                </div>
                <div class="form-group">
                    <label for="test_series">Test Series</label>
                    <input type="text" class="form-control" id="test_series" name="test_series" required>
                </div>
                <div class="form-group">
                    <label for="target_year">Target Year</label>
                    <input type="text" class="form-control" id="target_year" name="target_year" required>
                </div>
                <div class="form-group">
                    <label for="medium">Medium</label>
                    <input type="text" class="form-control" id="medium" name="medium" required>
                </div>
                <div class="form-group">
                    <label for="mode">Mode</label>
                    <input type="text" class="form-control" id="mode" name="mode" required>
                </div>
                <div class="form-group">
                    <label for="enquiry_by">Enquiry By</label>
                    <input type="text" class="form-control" id="enquiry_by" name="enquiry_by" required>
                </div>
                <div class="form-group">
                    <label for="counsellor">Counsellor</label>
                    <input type="text" class="form-control" id="counsellor" name="counsellor" required>
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>
                <div class="form-group">
                    <label for="center">Center</label>
                    <input type="text" class="form-control" id="center" name="center" required>
                </div>
                <div class="form-group">
                    <label for="status_id">Status ID</label>
                    <input type="text" class="form-control" id="status_id" name="status_id" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Enquiry</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
