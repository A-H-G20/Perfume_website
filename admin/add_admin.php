<?php
// Start session and include the database configuration
session_start();
require_once '../connection.php'; // Ensure this file contains your DB connection setup

// Handle form submission to add a new admin
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $gender = $_POST['gender'];
    $password = $_POST['password']; // Make sure to hash the password

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Default role set to 'admin'
    $role = 'admin';

    // Insert the new admin into the database
    $stmt = $conn->prepare("INSERT INTO users (name, email, phone_number, gender, role, password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $email, $phone_number, $gender, $role, $hashedPassword);

    if ($stmt->execute()) {
        // Redirect to user management page after successful admin creation
        header("Location: admin_managment.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/add_admin.css">
    <title>Add Admin</title>
    
</head>
<body>
    <header>
    <ul>
    <li><a href="index.php">Dashboard</a></li>
    <li><a href="order.php">Orders</a></li>
    <li><a href="fetch_products.php">Products</a></li>
    <li><a href="admin_managment.php">Admin management</a></li>
    <li><a href="user_managment.php">User management</a></li>
    <li><a href="../logout.php">Logout</a></li>
</ul>

    </header>
    <div class="form-container">
        <h2>Create Admin</h2>
        <form action="add_admin.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" required><br>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <button type="submit">Create Admin</button>
        </form>
    </div>
</body>
</html>
