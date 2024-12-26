<?php
// Start session and include the database configuration
session_start();
require_once '../connection.php'; // Ensure this file contains your DB connection setup

// Fetch the admin details to be edited
if (isset($_GET['id'])) {
    $adminId = $_GET['id'];

    // Fetch the current admin details from the database
    $sql = "SELECT user_id, name, email, phone_number, gender FROM users WHERE user_id = ? AND role = 'admin'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $adminId);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if (!$admin) {
        echo "Admin not found.";
        exit;
    }
}

// Handle form submission to update the admin details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];  // Get the password from the form

    // If password is provided, hash it
    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $updateSql = "UPDATE users SET name = ?, email = ?, phone_number = ?, gender = ?, password = ? WHERE user_id = ? AND role = 'admin'";
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param("sssssi", $name, $email, $phone_number, $gender, $hashedPassword, $adminId);
    } else {
        // If no password is provided, do not update the password field
        $updateSql = "UPDATE users SET name = ?, email = ?, phone_number = ?, gender = ? WHERE user_id = ? AND role = 'admin'";
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param("ssssi", $name, $email, $phone_number, $gender, $adminId);
    }

    // Execute the update query
    if ($stmt->execute()) {
        // Redirect to user management page after successful update
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
    <link rel="stylesheet" href="css/edit_admin.css">
    <title>Edit Admin</title>
  
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
        <h2>Edit Admin</h2>
        <form action="edit_admin.php?id=<?php echo $admin['user_id']; ?>" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($admin['name']); ?>" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($admin['email']); ?>" required><br>

            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($admin['phone_number']); ?>" required><br>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="male" <?php if ($admin['gender'] == 'male') echo 'selected'; ?>>Male</option>
                <option value="female" <?php if ($admin['gender'] == 'female') echo 'selected'; ?>>Female</option>
            </select><br>

            <!-- Password field for password change -->
            <label for="password">New Password (leave blank if not changing):</label>
            <input type="password" id="password" name="password"><br>

            <button type="submit">Update Admin</button>
        </form>
    </div>
</body>
</html>
