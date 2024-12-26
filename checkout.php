<?php
session_start();

// Check if the user is logged in by verifying the session variables
if (!isset($_SESSION['id']) || !isset($_SESSION['role'])) {
    header("Location: login.php");
    exit(); // Make sure to stop the execution after redirecting
}

$user_id = $_SESSION['id']; 
include "connection.php";

// Initialize the total order price variable
$total_order_price = 0; // Initialize total order price to 0

// Fetch cart data for the user
$cart_query = "SELECT * FROM cart WHERE user_id = $user_id";
$cart_result = $conn->query($cart_query);
$cart_items = [];

if ($cart_result->num_rows > 0) {
    while ($row = $cart_result->fetch_assoc()) {
        $cart_items[] = $row;
    }
} else {
    echo "Your cart is empty.";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $country = $_POST['country'];
    $city = $_POST['city'];

    // Prepare the order query
    $order_query = "INSERT INTO orders (user_id, product_id, quantity, price, total_price, order_date, status, shipping_address, shipping_country, shipping_city) VALUES ";
    $values = [];

    // Calculate total price for each item in the cart
    foreach ($cart_items as $item) {
        $product_id = $item['product_id'];
        $quantity = $item['quantity'];

        // Fetch product price for the order
        $product_query = "SELECT price FROM products WHERE products_id = $product_id";
        $product_result = $conn->query($product_query);
        
        if ($product_result->num_rows > 0) {
            $product = $product_result->fetch_assoc();
            $price = $product['price'];
            $total_price = $price * $quantity; // Calculate total price for this item

            // Add the order data to the values array
            $values[] = "($user_id, $product_id, $quantity, $price, $total_price, NOW(), 'Pending', '$address', '$country', '$city')";
            
            // Accumulate the total order price
            $total_order_price += $total_price;
        } else {
            echo "Product with ID $product_id not found.";
        }
    }

    // If the values array is not empty, concatenate the values and execute the query
    if (!empty($values)) {
        $order_query .= implode(", ", $values);

        // Execute the query to insert the order data
        if ($conn->query($order_query) === TRUE) {
            // Clear the cart after order placement
            $delete_cart_query = "DELETE FROM cart WHERE user_id = $user_id";
            if ($conn->query($delete_cart_query) === TRUE) {
                // Optionally, you can store the total order price somewhere or display it
                echo "Total order price: $total_order_price"; // Display total price
                // Redirect to the cart page after clearing the cart
                header("Location: cart.php");
                exit(); // Stop further script execution
            } else {
                echo "Error clearing cart: " . $conn->error;
            }
        } else {
            echo "Error: " . $order_query . "<br>" . $conn->error;
        }
    } else {
        echo "No items in the cart.";
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/checkout.css">
    <link rel="stylesheet" href="css/all.css">
    <title>Order</title>
</head>
<body>
    <header class="header">
        <a href="#" class="logo"><i class="fas fa-shop-perfume"></i>Perfume Luxury</a>
        <nav class="navbar">
        <a href="index.php">home</a>
            <a href="new_arivale.php">newArrivals</a>
            <a href="collections.php">Collections</a>
            <a href="order.php">My order</a>
            <a href="aboutUs.php">About Us</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <br><br><br><br><br> <br><br><br>

    <div class="container">
        <div class="layout">
            <div class="returnCart">
                <h1>Products In The Cart</h1>
                <?php
                    foreach ($cart_items as $item) {
                        echo "<div>Product ID: " . $item['product_id'] . " - Quantity: " . $item['quantity'] . "</div>";
                    }
                ?>
            </div>
            <div class="right">
                <h1>CHECKOUT</h1>
                <form action="" method="POST" class="form">
                    <div class="group">
                        <label for="">Full Name</label>
                        <input type="text" name="full_name" required>
                    </div>
                    <div class="group">
                        <label for="">Phone Number</label>
                        <input type="text" name="phone_number" required>
                    </div>
                    <div class="group">
                        <label for="">Address</label>
                        <input type="text" name="address" required>
                    </div>
                    <div class="group">
                        <label for="">Country</label>
                        <select name="country" required>
                            <option value="">Choose...</option>
                            <option value="London">London</option>
                        </select>
                    </div>
                    <div class="group">
                        <label for="">City</label>
                        <select name="city" required>
                            <option value="">Choose...</option>
                            <option value="London">London</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="buttonCheckout">CHECKOUT</button>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <h1>"Fill the Senses with the Mysterious"</h1>
        <div class="icons">
            <a href="https://www.facebook.com"><i class="fa-brands fa-square-facebook"></i></a>
            <a href="https://www.instagram.com"><i class="fa-brands fa-square-instagram"></i></a>
            <a href="https://wa.me"><i class="fa-brands fa-square-whatsapp"></i></a>
            <p>Copyright &copy; 2024 PerfumeLuxury®. All rights reserved</p>
        </div>
    </footer>
</body>
</html>
