<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Registration Form</h2>
        <form action="register.php" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select id="role" name="role" class="form-control" required>
                    <option value="receptionist">Receptionist</option>
                    <option value="counsellor">Counsellor</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Register</button>
        </form>
    </div>

    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../config/db.php';

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);

    if ($name && $username && $email && $password && ($role == 'receptionist' || $role == 'counsellor')) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $table = ($role == 'receptionist') ? 'receptionist' : 'counsellors';
        
        $stmt = $conn->prepare("INSERT INTO $table (name, username, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $username, $email, $hashed_password);
        
        if ($stmt->execute()) {
            echo "<div class='alert alert-success mt-3'>New record created successfully in $table table.</div>";
        } else {
            echo "<div class='alert alert-danger mt-3'>Error: " . $stmt->error . "</div>";
        }
        
        $stmt->close();
    } else {
        echo "<div class='alert alert-danger mt-3'>Invalid input.</div>";
    }

    $conn->close();
}
?>
