<?php
include '../config/db.php';

if (isset($_POST['id'])) {
    $enquiry_id = intval($_POST['id']);
    $stmt = $conn->prepare(
        "SELECT enquiries.*, status.status_name 
         FROM enquiries 
         LEFT JOIN status ON enquiries.status_id = status.id 
         WHERE enquiries.id = ?"
    );
    $stmt->bind_param("i", $enquiry_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <table class="table table-bordered">
            <tr><th>ID</th><td><?php echo htmlspecialchars($row['id']); ?></td></tr>
            <tr><th>Student Name</th><td><?php echo htmlspecialchars($row['student_name']); ?></td></tr>
            <tr><th>Mobile No.</th><td><?php echo htmlspecialchars($row['mob_no']); ?></td></tr>
            <tr><th>Email</th><td><?php echo htmlspecialchars($row['email']); ?></td></tr>
            <tr><th>Address</th><td><?php echo htmlspecialchars($row['address']); ?></td></tr>
            <tr><th>State</th><td><?php echo htmlspecialchars($row['state']); ?></td></tr>
            <tr><th>Qualification</th><td><?php echo htmlspecialchars($row['qualification']); ?></td></tr>
            <tr><th>Pursuing Specification</th><td><?php echo htmlspecialchars($row['pursuing_specification']); ?></td></tr>
            <tr><th>Attempted Prelims</th><td><?php echo htmlspecialchars($row['attempted_prelims']); ?></td></tr>
            <tr><th>How Did You Know About Us</th><td><?php echo htmlspecialchars($row['know_about_us']); ?></td></tr>
            <tr><th>Enquiring For</th><td><?php echo htmlspecialchars($row['enquiring_for']); ?></td></tr>
            <tr><th>Test Series</th><td><?php echo htmlspecialchars($row['test_series']); ?></td></tr>
            <tr><th>Target Year</th><td><?php echo htmlspecialchars($row['target_year']); ?></td></tr>
            <tr><th>Medium</th><td><?php echo htmlspecialchars($row['medium']); ?></td></tr>
            <tr><th>Mode</th><td><?php echo htmlspecialchars($row['mode']); ?></td></tr>
            <tr><th>Enquiry By</th><td><?php echo htmlspecialchars($row['enquiry_by']); ?></td></tr>
            <tr><th>Counsellor</th><td><?php echo htmlspecialchars($row['counsellor']); ?></td></tr>
            <tr><th>Date</th><td><?php echo htmlspecialchars($row['date']); ?></td></tr>
            <tr><th>Center</th><td><?php echo htmlspecialchars($row['center']); ?></td></tr>
            <tr><th>Status</th><td><?php echo htmlspecialchars($row['status_name']); ?></td></tr>
        </table>
        <?php
    } else {
        echo "No details found.";
    }
    $stmt->close();
}
$conn->close();
?>
