<?php
session_start();
include("connection.php");

if (isset($_POST['product_id'], $_POST['user_id'])) {
    $product_id = $_POST['product_id'];
    $user_id = $_POST['user_id'];

    // Check if the product is already in the cart
    $check_query = "SELECT * FROM cart WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update quantity if product already exists in cart
        $update_query = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = ? AND product_id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("ii", $user_id, $product_id);
        $stmt->execute();
    } else {
        // Insert new product into the cart
        $insert_query = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, 1)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("ii", $user_id, $product_id);
        $stmt->execute();
    }

    echo "Item added to cart successfully.";
} else {
    echo "Error: Missing data.";
}
?>
