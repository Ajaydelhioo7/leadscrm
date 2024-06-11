<?php
session_start();
if (!isset($_SESSION['receptionist_id'])) {
    header("Location: index.php");
    exit();
}
include '../config/db.php';

// Pagination variables
$limit = 10; // Number of entries to show in a page.
if (isset($_GET["page"])) {
    $page  = $_GET["page"];
} else {
    $page = 1;
};
$start_from = ($page - 1) * $limit;

// Search functionality
$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

// Date filter
$start_date = '';
$end_date = '';
if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];
}

// Order filter
$order_by = 'id';
$order_dir = 'ASC';
if (isset($_GET['order_by']) && isset($_GET['order_dir'])) {
    $order_by = $_GET['order_by'];
    $order_dir = $_GET['order_dir'];
}

// Fetch all enquiries with filters
$query = "SELECT * FROM enquiries WHERE (student_name LIKE '%$search%' OR email LIKE '%$search%' OR mob_no LIKE '%$search%')";
if ($start_date && $end_date) {
    $query .= " AND date BETWEEN '$start_date' AND '$end_date'";
}
$query .= " ORDER BY $order_by $order_dir LIMIT $start_from, $limit";
$result = $conn->query($query);

// Count total records for pagination
$count_query = "SELECT COUNT(id) FROM enquiries WHERE (student_name LIKE '%$search%' OR email LIKE '%$search%' OR mob_no LIKE '%$search%')";
if ($start_date && $end_date) {
    $count_query .= " AND date BETWEEN '$start_date' AND '$end_date'";
}
$count_result = $conn->query($count_query);
$row = $count_result->fetch_row();
$total_records = $row[0];
$total_pages = ceil($total_records / $limit);

// Fetch values for counsellor, enquiry by, and center
$counsellors = $conn->query("SELECT * FROM counsellors");
$enquiry_by_list = $conn->query("SELECT * FROM enquiry_by");
$centers = $conn->query("SELECT * FROM centers");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Receptionist Dashboard</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-responsive {
            max-height: 400px; /* Adjust this value as needed */
            overflow-y: auto;
        }
        .modal-lg {
            max-width: 90%;
        }
    </style>
</head>
<body>
<?php include './includes/header.php'?>

<div class="container ">
    <div class="card">
        <div class="card-header">
            <h3 class="text-center">Welcome, <?php echo $_SESSION['receptionist_name']; ?></h3>
        </div>
        <div class="card-body">
            <h4>Enquiries</h4>
            <div class="row mb-3">
                <div class="col-md-12">
                    <form method="GET" action="dashboard.php" class="form-inline">
                        <div class="form-group mb-2">
                            <label for="search" class="sr-only">Search</label>
                            <input type="text" class="form-control" name="search" placeholder="Search by name, email, or mobile" value="<?php echo $search; ?>">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="start_date" class="sr-only">Start Date</label>
                            <input type="date" class="form-control" name="start_date" value="<?php echo $start_date; ?>">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="end_date" class="sr-only">End Date</label>
                            <input type="date" class="form-control" name="end_date" value="<?php echo $end_date; ?>">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="order_by" class="sr-only">Order By</label>
                            <select class="form-control" name="order_by">
                                <option value="id" <?php if ($order_by == 'id') echo 'selected'; ?>>ID</option>
                                <option value="student_name" <?php if ($order_by == 'student_name') echo 'selected'; ?>>Student Name</option>
                                <option value="date" <?php if ($order_by == 'date') echo 'selected'; ?>>Date</option>
                            </select>
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="order_dir" class="sr-only">Order Direction</label>
                            <select class="form-control" name="order_dir">
                                <option value="ASC" <?php if ($order_dir == 'ASC') echo 'selected'; ?>>Ascending</option>
                                <option value="DESC" <?php if ($order_dir == 'DESC') echo 'selected'; ?>>Descending</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Filter</button>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Student Name</th>
                            <th>Mobile No.</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>State</th>
                            <th>Qualification</th>
                            <th>Attempted Prelims</th>
                            <th>How Did You Know About Us</th>
                            <th>Enquiring For</th>
                            <th>Test Series</th>
                            <th>Target Year</th>
                            <th>Medium</th>
                            <th>Mode</th>
                            <th>Enquiry By</th>
                            <th>Counsellor</th>
                            <th>Date</th>
                            <th>Center</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['student_name']; ?></td>
                            <td><?php echo $row['mob_no']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['state']; ?></td>
                            <td><?php echo $row['qualification']; ?></td>
                            <td><?php echo $row['attempted_prelims']; ?></td>
                            <td><?php echo $row['know_about_us']; ?></td>
                            <td><?php echo $row['enquiring_for']; ?></td>
                            <td><?php echo $row['test_series']; ?></td>
                            <td><?php echo $row['target_year']; ?></td>
                            <td><?php echo $row['medium']; ?></td>
                            <td><?php echo $row['mode']; ?></td>
                            <td><?php echo $row['enquiry_by']; ?></td>
                            <td><?php echo $row['counsellor']; ?></td>
                            <td><?php echo $row['date']; ?></td>
                            <td><?php echo $row['center']; ?></td>
                            <td>
                                <button class="btn btn-primary btn-sm edit-btn" data-id="<?php echo $row['id']; ?>" data-toggle="modal" data-target="#editModal">Edit</button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <?php for ($i=1; $i<=$total_pages; $i++): ?>
                        <li class="page-item <?php if($i == $page) echo 'active'; ?>">
                            <a class="page-link" href="dashboard.php?page=<?php echo $i; ?>&search=<?php echo $search; ?>&start_date=<?php echo $start_date; ?>&end_date=<?php echo $end_date; ?>&order_by=<?php echo $order_by; ?>&order_dir=<?php echo $order_dir; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>
        <!-- <div class="card-footer text-center">
            <a href="manage_counsellors.php" class="btn btn-primary">Manage Counsellors</a>
            <a href="manage_enquiry_by.php" class="btn btn-primary">Manage Enquiry By</a>
            <a href="manage_centers.php" class="btn btn-primary">Manage Centers</a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div> -->
    </div>
</div>

<!-- Edit Enquiry Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Enquiry</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <input type="hidden" id="edit-id" name="id">
                    <div class="form-group">
                        <label for="edit-student_name">Student’s Name:</label>
                        <input type="text" class="form-control" id="edit-student_name" name="student_name">
                    </div>
                    <div class="form-group">
                        <label for="edit-mob_no">Mob. No.:</label>
                        <input type="text" class="form-control" id="edit-mob_no" name="mob_no">
                    </div>
                    <div class="form-group">
                        <label for="edit-email">Email:</label>
                        <input type="email" class="form-control" id="edit-email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="edit-address">Address:</label>
                        <input type="text" class="form-control" id="edit-address" name="address">
                    </div>
                    <div class="form-group">
                        <label for="edit-state">State:</label>
                        <input type="text" class="form-control" id="edit-state" name="state">
                    </div>
                    <div class="form-group">
                        <label for="edit-qualification">Qualification:</label>
                        <select class="form-control" id="edit-qualification" name="qualification">
                            <option value="10th">10th</option>
                            <option value="12th">12th</option>
                            <option value="Graduate">Graduate</option>
                            <option value="Masters">Masters</option>
                            <option value="Pursuing">Pursuing</option>
                        </select>
                        <input type="text" class="form-control mt-2" id="edit-pursuing_specification" name="pursuing_specification" placeholder="Please specify if pursuing">
                    </div>
                    <div class="form-group">
                        <label for="edit-attempted_prelims">Have you ever attempted Prelims before?</label><br>
                        <select class="form-control" id="edit-attempted_prelims" name="attempted_prelims">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit-know_about_us">How did you get to know about us?</label>
                        <input type="text" class="form-control" id="edit-know_about_us" name="know_about_us">
                    </div>
                    <div class="form-group">
                        <label for="edit-enquiring_for">You are enquiring for?</label>
                        <input type="text" class="form-control" id="edit-enquiring_for" name="enquiring_for">
                    </div>
                    <div class="form-group">
                        <label for="edit-test_series">Test Series</label>
                        <input type="text" class="form-control" id="edit-test_series" name="test_series">
                    </div>
                    <div class="form-group">
                        <label for="edit-target_year">Target Year:</label>
                        <input type="text" class="form-control" id="edit-target_year" name="target_year">
                    </div>
                    <div class="form-group">
                        <label for="edit-medium">Medium:</label><br>
                        <select class="form-control" id="edit-medium" name="medium">
                            <option value="English">English</option>
                            <option value="Hindi">Hindi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit-mode">Mode:</label><br>
                        <select class="form-control" id="edit-mode" name="mode">
                            <option value="Offline">Offline</option>
                            <option value="Online">Online</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit-enquiry_by">Enquiry By:</label>
                        <select class="form-control" id="edit-enquiry_by" name="enquiry_by">
                            <?php while ($row = $enquiry_by_list->fetch_assoc()): ?>
                                <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit-counsellor">Counsellor:</label>
                        <select class="form-control" id="edit-counsellor" name="counsellor">
                            <?php while ($row = $counsellors->fetch_assoc()): ?>
                                <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit-date">Date:</label>
                        <input type="date" class="form-control" id="edit-date" name="date">
                    </div>
                    <div class="form-group">
                        <label for="edit-center">Center:</label>
                        <select class="form-control" id="edit-center" name="center">
                            <?php while ($row = $centers->fetch_assoc()): ?>
                                <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save-changes">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    $('.edit-btn').on('click', function() {
        var id = $(this).data('id');
        $.ajax({
            url: 'get_enquiry.php',
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function(data) {
                $('#edit-id').val(data.id);
                $('#edit-student_name').val(data.student_name);
                $('#edit-mob_no').val(data.mob_no);
                $('#edit-email').val(data.email);
                $('#edit-address').val(data.address);
                $('#edit-state').val(data.state);
                $('#edit-qualification').val(data.qualification);
                $('#edit-pursuing_specification').val(data.pursuing_specification);
                $('#edit-attempted_prelims').val(data.attempted_prelims);
                $('#edit-know_about_us').val(data.know_about_us);
                $('#edit-enquiring_for').val(data.enquiring_for);
                $('#edit-test_series').val(data.test_series);
                $('#edit-target_year').val(data.target_year);
                $('#edit-medium').val(data.medium);
                $('#edit-mode').val(data.mode);
                $('#edit-enquiry_by').val(data.enquiry_by);
                $('#edit-counsellor').val(data.counsellor);
                $('#edit-date').val(data.date);
                $('#edit-center').val(data.center);
            }
        });
    });

    $('#save-changes').on('click', function() {
        $.ajax({
            url: 'update_enquiry.php',
            type: 'POST',
            data: $('#editForm').serialize(),
            success: function(response) {
                alert(response);
                location.reload();
            }
        });
    });
});
</script>
</body>
</html>
