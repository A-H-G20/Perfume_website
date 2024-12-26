
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/collection.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">
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

        <div class="icons">
        <div class="fas fa-shopping-cart" id="cart-btn" onclick="window.location.href='cart.php';"></div>

        </div>

        <form action="" class="search-form">
            <input type="search" name="" id="search-box" placeholder="search here...">
            <label for="search-box" class="fas fa"></label>
        </form>

       
              
           

       

    </header><br><br><br><br><br><br><br><br><br><br><br><br>
    <?php
// Include the database connection file
include('connection.php');

// Check if user is logged in (session check)
session_start();

// Check if the user is logged in by verifying the session variables
if (!isset($_SESSION['id']) || !isset($_SESSION['role'])) {
    // If session variables are not set, redirect to the login page
    header("Location: login.php");
    exit(); // Make sure to stop the execution after redirecting
}

// Get the user_id from the session
$user_id = $_SESSION['id']; // Get the logged-in user ID from session

// SQL query to fetch orders related to the user
$query = "SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id); // Bind the user ID to the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Check if the user has any orders
if ($result->num_rows > 0) {
    // Display orders in a table
    echo '<h1>Your Orders</h1>';
    echo '<table border="1">';
    echo '<tr><th>Order ID</th><th>Product ID</th><th>Quantity</th><th>Price</th><th>Total Price</th><th>Order Date</th><th>Status</th><th>Shipping Address</th></tr>';

    // Loop through the orders and display them
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['order_id']) . '</td>';
        echo '<td>' . htmlspecialchars($row['product_id']) . '</td>';
        echo '<td>' . htmlspecialchars($row['quantity']) . '</td>';
        echo '<td>' . htmlspecialchars($row['price']) . '</td>';
        echo '<td>' . htmlspecialchars($row['total_price']) . '</td>';
        echo '<td>' . htmlspecialchars($row['order_date']) . '</td>';
        echo '<td>' . htmlspecialchars($row['status']) . '</td>';
        echo '<td>' . htmlspecialchars($row['shipping_address']) . '</td>';
        echo '</tr>';
    }

    echo '</table>';
} else {
    // No orders found
    echo '<p>You have no orders yet.</p>';
}

// Close the statement
$stmt->close();

// Close the database connection
$conn->close();
?>
</body>
</html>
<style>
    /* General Page Styles */
body {
    font-family: Arial, sans-serif;
  
    margin: 0;
    padding: 0;
}

.container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
}

/* Header Styles */
h1 {
    text-align: center;
    color: white;
    margin-bottom: 20px;
}

/* Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    
}

th, td {
    padding: 12px;
    text-align: left;
    border: 1px solid #ddd;
}

th {
    background-color: #333;
    color: white;
}





/* No Orders Message Styles */
.no-orders {
    text-align: center;
    font-size: 18px;
    color: #888;
    margin-top: 20px;
}

/* Styling for the Table Headers and Cells */
th, td {
    padding: 15px;
    text-align: left;
    border: 1px solid #ddd;
}

th {
   
    color: white;
}

td {
   color: white;
}

/* Button Styling */
.button {
    background-color: #4CAF50; /* Green background */
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    margin-top: 20px;
}

.button:hover {
    background-color: #45a049;
}

</style>