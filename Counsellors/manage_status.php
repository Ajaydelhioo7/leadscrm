<?php
session_start();
include '../config/db.php';

// Handle adding a new status
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_status'])) {
    $new_status = $_POST['new_status'];
    $stmt = $conn->prepare("INSERT INTO status (status_name) VALUES (?)");
    $stmt->bind_param("s", $new_status);
    $stmt->execute();
    $stmt->close();
    header("Location: manage_status.php");
    exit();
}

// Handle deleting a status
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_status'])) {
    $status_id = $_POST['status_id'];
    $stmt = $conn->prepare("DELETE FROM status WHERE id = ?");
    $stmt->bind_param("i", $status_id);
    $stmt->execute();
    $stmt->close();
    header("Location: manage_status.php");
    exit();
}

// Fetch all statuses
$result = $conn->query("SELECT * FROM status");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Manage Status</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include './includes/header.php'?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3 class="text-center">Manage Status</h3>
        </div>
        <div class="card-body">
            <h4>Existing Statuses</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Status Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['status_name']; ?></td>
                        <td>
                            <form method="POST" action="manage_status.php" style="display:inline;">
                                <input type="hidden" name="status_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="delete_status" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <h4>Add New Status</h4>
            <form method="POST" action="manage_status.php">
                <div class="form-group">
                    <label for="new_status">Status Name:</label>
                    <input type="text" class="form-control" id="new_status" name="new_status" required>
                </div>
                <button type="submit" name="add_status" class="btn btn-primary">Add Status</button>
            </form>
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
