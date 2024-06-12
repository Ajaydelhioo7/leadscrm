<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
include '../config/db.php';

// Fetch some data for dashboard overview (this is just an example)
$enquiries_count = $conn->query("SELECT COUNT(*) FROM enquiries")->fetch_row()[0];
$counsellors_count = $conn->query("SELECT COUNT(*) FROM counsellors")->fetch_row()[0];
$statuses_count = $conn->query("SELECT COUNT(*) FROM status")->fetch_row()[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include './includes/header.php' ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Enquiries</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $enquiries_count; ?></h5>
                    <p class="card-text">Manage all enquiries.</p>
                    <a href="manage_enquiries.php" class="btn btn-light">View Details</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total Counsellors</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $counsellors_count; ?></h5>
                    <p class="card-text">Manage counsellors.</p>
                    <a href="manage_counsellors.php" class="btn btn-light">View Details</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Total Statuses</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $statuses_count; ?></h5>
                    <p class="card-text">Manage statuses.</p>
                    <a href="manage_statuses.php" class="btn btn-light">View Details</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Admin Options</div>
                <div class="card-body">
                    <h5 class="card-title">Manage Admins</h5>
                    <p class="card-text">Add, edit, and remove admins.</p>
                    <a href="manage_admins.php" class="btn btn-light">View Details</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-12 text-center">
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
<?php
$conn->close();
?>
