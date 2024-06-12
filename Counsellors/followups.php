<?php
session_start();
if (!isset($_SESSION['counsellor_id'])) {
    header("Location: index.php");
    exit();
}
include '../config/db.php';

// Pagination variables
$limit = 10; // Number of entries to show in a page.
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$start_from = ($page - 1) * $limit;

// Search functionality
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Date filter
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

// Status filter
$status_id = isset($_GET['status_id']) ? intval($_GET['status_id']) : '';

// Fetch statuses for dropdown
$status_query = "SELECT id, status_name FROM status";
$status_result = $conn->query($status_query);
$statuses = [];
while ($status_row = $status_result->fetch_assoc()) {
    $statuses[] = $status_row;
}

// Fetch follow-ups with filters
$query = "SELECT followups.*, enquiries.student_name, enquiries.email, enquiries.mob_no, enquiries.id AS enquiry_id 
          FROM followups 
          JOIN enquiries ON followups.enquiry_id = enquiries.id
          WHERE (enquiries.student_name LIKE '%$search%' OR enquiries.email LIKE '%$search%' OR enquiries.mob_no LIKE '%$search%')";
if ($start_date && $end_date) {
    $query .= " AND followup_date BETWEEN '$start_date' AND '$end_date'";
}
if ($status_id) {
    $query .= " AND enquiries.status_id = $status_id";
}
$query .= " ORDER BY followup_date DESC LIMIT $start_from, $limit";
$result = $conn->query($query);

// Count total records for pagination
$count_query = "SELECT COUNT(followups.id) 
                FROM followups 
                JOIN enquiries ON followups.enquiry_id = enquiries.id
                WHERE (enquiries.student_name LIKE '%$search%' OR enquiries.email LIKE '%$search%' OR enquiries.mob_no LIKE '%$search%')";
if ($start_date && $end_date) {
    $count_query .= " AND followup_date BETWEEN '$start_date' AND '$end_date'";
}
if ($status_id) {
    $count_query .= " AND enquiries.status_id = $status_id";
}
$count_result = $conn->query($count_query);
$row = $count_result->fetch_row();
$total_records = $row[0];
$total_pages = ceil($total_records / $limit);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Follow-Ups Dashboard</title>
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
<?php include './includes/header.php' ?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3 class="text-center">Welcome, <?php echo htmlspecialchars($_SESSION['counsellor_name']); ?></h3>
        </div>
        <div class="card-body">
            <h4>Your Follow-Ups</h4>
            <div class="row mb-3">
                <div class="col-md-12">
                    <form method="GET" action="followups.php" class="form-inline">
                        <div class="form-group mb-2">
                            <label for="search" class="sr-only">Search</label>
                            <input type="text" class="form-control" name="search" placeholder="Search by name, email, or mobile" value="<?php echo htmlspecialchars($search); ?>">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="start_date" class="sr-only">Start Date</label>
                            <input type="date" class="form-control" name="start_date" value="<?php echo htmlspecialchars($start_date); ?>">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="end_date" class="sr-only">End Date</label>
                            <input type="date" class="form-control" name="end_date" value="<?php echo htmlspecialchars($end_date); ?>">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="status_id" class="sr-only">Status</label>
                            <select class="form-control" name="status_id">
                                <option value="">Select Status</option>
                                <?php foreach ($statuses as $status): ?>
                                    <option value="<?php echo $status['id']; ?>" <?php if ($status['id'] == $status_id) echo 'selected'; ?>>
                                        <?php echo htmlspecialchars($status['status_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Filter</button>
                    </form>
                </div>
            </div>
            <div class="card-columns">
                <?php while ($row = $result->fetch_assoc()): ?>
                <div class="card enquiry-card" data-id="<?php echo $row['enquiry_id']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($row['student_name']); ?></h5>
                        <p class="card-text"><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
                        <p class="card-text"><strong>Mobile:</strong> <?php echo htmlspecialchars($row['mob_no']); ?></p>
                        <p class="card-text"><strong>Follow-Up Date:</strong> <?php echo htmlspecialchars($row['followup_date']); ?></p>
                        <p class="card-text"><strong>Remarks:</strong> <?php echo nl2br(htmlspecialchars($row['remarks'])); ?></p>
                        <p class="card-text"><small class="text-muted">Created at <?php echo htmlspecialchars($row['created_at']); ?></small></p>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                            <a class="page-link" href="followups.php?page=<?php echo $i; ?>&search=<?php echo htmlspecialchars($search); ?>&start_date=<?php echo htmlspecialchars($start_date); ?>&end_date=<?php echo htmlspecialchars($end_date); ?>&status_id=<?php echo htmlspecialchars($status_id); ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Modal for displaying enquiry details -->
<div class="modal fade" id="enquiryModal" tabindex="-1" role="dialog" aria-labelledby="enquiryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="enquiryModalLabel">Enquiry Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Enquiry details will be populated here -->
                <div id="enquiryDetails"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    $('.enquiry-card').on('click', function() {
        var enquiryId = $(this).data('id');
        
        $.ajax({
            url: 'get_enquiry_details.php',
            type: 'POST',
            data: { id: enquiryId },
            success: function(response) {
                $('#enquiryDetails').html(response);
                $('#enquiryModal').modal('show');
            }
        });
    });
});
</script>
</body>
</html>
<?php
$conn->close();
?>
