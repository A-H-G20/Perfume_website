<?php
// Start session and include the database configuration
session_start();
require_once '../connection.php'; // Ensure this file contains your DB connection setup

// Fetch all users with the role 'admin' from the database
$sql = "SELECT user_id, name, email, phone_number, role, gender FROM users WHERE role = 'admin'";
$result = $conn->query($sql);

// Check if a user ID is passed in the URL for deletion
if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];

    // Prepare the delete query
    $deleteSql = "DELETE FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("i", $deleteId);

    // Execute the delete query
    if ($stmt->execute()) {
        // Redirect to the same page to show updated user list
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
    <link rel="stylesheet" href="css/admin_managment.css">
    <title>Admin Management</title>
    <style>
 

    </style>
</head>
<body>
    <!-- Navigation Bar -->
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

    <h1>Admin Management</h1>

    <!-- Button to add a new admin -->
    <a href="add_admin.php" class="add-button">Add Admin</a>

    <!-- Table for displaying users -->
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Gender</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
                        <td><?php echo htmlspecialchars($row['gender']); ?></td>
                        <td>
                            <a href="edit_admin.php?id=<?php echo $row['user_id']; ?>" class="action-button">Edit</a>
                            <a href="admin_managment.php?delete_id=<?php echo $row['user_id']; ?>" class="action-button" onclick="return confirm('Are you sure you want to delete this admin?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No admins found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
