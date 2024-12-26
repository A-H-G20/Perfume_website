<?php
// Include the database connection
include('../connection.php'); // Adjust the path to your configuration file

// Check if order_id is passed in the URL
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Update the order status to 'pending'
    $query = "UPDATE orders SET status = 'pending' WHERE order_id = ?";
    $stmt = $conn->prepare($query);

    // Bind the order_id parameter to the query
    $stmt->bind_param("i", $order_id);

    // Execute the query
    if ($stmt->execute()) {
        // Redirect to the orders list or a success page
        header("Location: order.php");
    } else {
        // Handle query execution failure
        echo "Error updating order status.";
    }
} else {
    // If no order_id is provided in the URL
    echo "Invalid order ID.";
}
?>
