<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (!isset($_SESSION['counsellor_id'])) {
    header("Location: index.php");
    exit();
}
include '../config/db.php';

// Counsellor's name from session
$counsellor_name = $_SESSION['counsellor_name'];

// Pagination variables
$limit = 10; // Number of entries to show in a page.
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start_from = ($page - 1) * $limit;

// Search functionality
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Date filter
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

// Base query
$query = "SELECT enquiries.*, status.status_name FROM enquiries 
          LEFT JOIN status ON enquiries.status_id = status.id 
          WHERE counsellor = ? AND (student_name LIKE ? OR email LIKE ? OR mob_no LIKE ?)";
$filter_params = [$counsellor_name, "%$search%", "%$search%", "%$search%"];

// Apply date filter if both dates are provided
if ($start_date && $end_date) {
    $query .= " AND date BETWEEN ? AND ?";
    $filter_params[] = $start_date;
    $filter_params[] = $end_date;
}

// Append ordering and pagination
$query .= " ORDER BY date DESC LIMIT ?, ?";
$filter_params[] = $start_from;
$filter_params[] = $limit;

// Prepare and execute query
$stmt = $conn->prepare($query);
$types = str_repeat('s', count($filter_params) - 2) . 'ii';
$stmt->bind_param($types, ...$filter_params);
$stmt->execute();
$result = $stmt->get_result();

// Count total records for pagination
$count_query = "SELECT COUNT(id) FROM enquiries WHERE counsellor = ? AND (student_name LIKE ? OR email LIKE ? OR mob_no LIKE ?)";
$count_params = [$counsellor_name, "%$search%", "%$search%", "%$search%"];

if ($start_date && $end_date) {
    $count_query .= " AND date BETWEEN ? AND ?";
    $count_params[] = $start_date;
    $count_params[] = $end_date;
}

$count_stmt = $conn->prepare($count_query);
$count_types = str_repeat('s', count($count_params));
$count_stmt->bind_param($count_types, ...$count_params);
$count_stmt->execute();
$count_result = $count_stmt->get_result();
$row = $count_result->fetch_row();
$total_records = $row[0];
$total_pages = ceil($total_records / $limit);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Counsellor Dashboard</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-columns {
            column-count: 1; /* Adjust this value for more columns */
        }
        @media (min-width: 576px) {
            .card-columns {
                column-count: 2;
            }
        }
        @media (min-width: 768px) {
            .card-columns {
                column-count: 3;
            }
        }
        @media (min-width: 992px) {
            .card-columns {
                column-count: 4;
            }
        }
    </style>
</head>
<body>
<?php include './includes/header.php'?>

<div class="container ">
    <div class="card">
        <div class="card-header">
            <h3 class="text-center">Welcome, <?php echo $_SESSION['counsellor_name']; ?></h3>
        </div>
        <div class="card-body">
            <h4>Your Leads</h4>
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
                        <button type="submit" class="btn btn-primary mb-2">Filter</button>
                    </form>
                </div>
            </div>
            <div class="card-columns">
                <?php while ($row = $result->fetch_assoc()): ?>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['student_name']; ?></h5>
                        <p class="card-text"><strong>Email:</strong> <?php echo $row['email']; ?></p>
                        <p class="card-text"><strong>Mobile:</strong> <?php echo $row['mob_no']; ?></p>
                        <p class="card-text"><strong>Date:</strong> <?php echo $row['date']; ?></p>
                        <p class="card-text"><strong>Status:</strong> <?php echo $row['status_name']; ?></p>
                        <button class="btn btn-primary btn-sm followup-btn" data-id="<?php echo $row['id']; ?>" data-toggle="modal" data-target="#followupModal">Follow-Up</button>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <?php for ($i=1; $i<=$total_pages; $i++): ?>
                        <li class="page-item <?php if($i == $page) echo 'active'; ?>">
                            <a class="page-link" href="dashboard.php?page=<?php echo $i; ?>&search=<?php echo $search; ?>&start_date=<?php echo $start_date; ?>&end_date=<?php echo $end_date; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Follow-Up Modal -->
<div class="modal fade" id="followupModal" tabindex="-1" role="dialog" aria-labelledby="followupModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="followupModalLabel">Add Follow-Up</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="followupForm" action="add_followup.php" method="POST">
                    <input type="hidden" id="followup-enquiry-id" name="enquiry_id">
                    <div class="form-group">
                        <label for="followup_date">Follow-Up Date:</label>
                        <input type="date" class="form-control" id="followup_date" name="followup_date" required>
                    </div>
                    <div class="form-group">
                        <label for="remarks">Remarks:</label>
                        <textarea class="form-control" id="remarks" name="remarks" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control" id="status" name="status" required>
                            <!-- Status options will be populated by JavaScript -->
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Follow-Up</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    $('.followup-btn').on('click', function() {
        var id = $(this).data('id');
        $('#followup-enquiry-id').val(id);

        // Fetch the statuses again to ensure the latest statuses are available in the modal
        $.ajax({
            url: 'fetch_statuses.php',
            method: 'GET',
            success: function(data) {
                $('#status').empty();
                var statuses = JSON.parse(data);
                $.each(statuses, function(index, status) {
                    $('#status').append('<option value="' + status.id + '">' + status.status_name + '</option>');
                });
            }
        });
    });

    $('#followupForm').on('submit', function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        console.log("Form data: ", formData); // Debugging line

        $.ajax({
            url: 'add_followup.php',
            method: 'POST',
            data: formData,
            success: function(response) {
                if(response.trim() === "Follow-up added and enquiry status updated successfully!") {
                    alert(response);
                    location.reload();
                } else {
                    console.error("Unexpected response: ", response);
                    alert("An unexpected error occurred. Please try again.");
                }
            },
            error: function(xhr, status, error) {
                console.error("Error: ", error);
                alert("An error occurred. Please try again.");
            }
        });
    });
});
</script>
</body>
</html>
<?php
$stmt->close();
$conn->close();
?>
