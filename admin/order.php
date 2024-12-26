<?php
// Start session and include the database configuration
session_start();
require_once '../connection.php'; // Ensure this file contains your DB connection setup

// Fetch orders from the orders table with the product details
$sql = "
    SELECT o.order_id, o.user_id, o.quantity, o.price, o.total_price, o.order_date, o.status, o.shipping_address, o.shipping_country, o.shipping_city, 
           p.image AS product_image, p.name AS product_name
    FROM orders o
    LEFT JOIN products p ON o.product_id = p.products_id
";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/order.css">
    <title>Order Management</title>
   
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
    <h1>Order Management</h1>

    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User ID</th>
                <th>Product Image</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total Price</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Shipping Address</th>
                <th>Shipping Country</th>
                <th>Shipping City</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['order_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['user_id']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($row['product_image']); ?>" alt="<?php echo htmlspecialchars($row['product_name']); ?>" width="100"></td>
                        <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                        <td>$<?php echo number_format($row['price'], 2); ?></td>
                        <td>$<?php echo number_format($row['total_price'], 2); ?></td>
                        <td><?php echo htmlspecialchars($row['order_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                        <td><?php echo htmlspecialchars($row['shipping_address']); ?></td>
                        <td><?php echo htmlspecialchars($row['shipping_country']); ?></td>
                        <td><?php echo htmlspecialchars($row['shipping_city']); ?></td>
                        <td class="action-buttons">
                            <a href="mark_completed.php?order_id=<?php echo $row['order_id']; ?>">Mark as Completed</a> <br><br>
                            <a href="mark_pending.php?order_id=<?php echo $row['order_id']; ?>">Mark as Pending</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="12">No orders found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
