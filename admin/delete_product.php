<?php
// Start session and include the database configuration
session_start();
require_once '../connection.php'; // Ensure this file contains your DB connection setup

// Check if the product ID is provided in the query string
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Prepare the delete query
    $deleteSql = "DELETE FROM products WHERE products_id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("i", $productId);

    // Execute the delete query
    if ($stmt->execute()) {
        echo "Product deleted successfully!";
        header("Location: fetch_products.php"); // Redirect back to the product list
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Product ID not provided.";
    exit();
}
?>
