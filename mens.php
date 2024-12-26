<?php
session_start();

// Check if the user is logged in by verifying the session variables
if (!isset($_SESSION['id']) || !isset($_SESSION['role'])) {
    // If session variables are not set, redirect to the login page
    header("Location: login.php");
    exit(); // Make sure to stop the execution after redirecting
}

// Get the user_id from the session
$user_id = $_SESSION['id']; // Ensure you are getting the user_id from the session

// Include database connection
include 'connection.php';

// Fetch products data grouped by collection
$query = "SELECT products_id, name, image, category, price, description, collection FROM products WHERE category='men'";
$result = $conn->query($query);

// Initialize an array to store products by collection
$collections = [];

// Group products by collection
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $collections[$row['collection']][] = $row;
    }
}

// Check if the "Add to Cart" button was clicked
if (isset($_POST['add_to_cart'])) {
    // Get the product_id from the POST data
    $product_id = $_POST['product_id'];
    $quantity = 1; // Default quantity, you can make this dynamic if needed

    // Insert the product into the cart table
    $insertQuery = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("iii", $user_id, $product_id, $quantity); // Bind the user_id, product_id, and quantity
    $stmt->execute();
    $stmt->close();

    // Optionally, show a success message or redirect to cart page
    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfume Luxury</title>
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
    </header><br><br><br><br><br>

    <section class="categories" id="categories">
        <br><br><br>
        <?php
        // Check if collections have any data and loop through each collection
        if (!empty($collections)) {
            foreach ($collections as $collectionName => $products) {
                echo '<div class="collection" style="text-align:center;">';
                echo '<h1 class="heading">' . htmlspecialchars($collectionName) . ' <span>collection</span></h1>';
                echo '<div class="box-container" style="display: flex; justify-content: center; flex-wrap: wrap;">';

                foreach ($products as $product) {
                    $image = $product['image'];
                    $imagePath = "uploads/" . $image;

                    echo '
                    <div class="box" style="margin: 10px; text-align: center;">
                        <img src="' . htmlspecialchars($imagePath) . '" alt="Image" style="width: 200px; height: auto;">
                        <h3>' . htmlspecialchars($product['name']) . '</h3>
                        <p>' . htmlspecialchars($product['description']) . '</p>
                        <div class="price">$' . htmlspecialchars($product['price']) . '</div>

                        <!-- Add to Cart Button -->
                        <form method="POST" action="">
                            <input type="hidden" name="product_id" value="' . htmlspecialchars($product['products_id']) . '">
                            <button type="submit" name="add_to_cart" class="btn">Add to Cart</button>
                        </form>
                    </div>';
                }

                echo '</div>'; // Close box-container
                echo '</div>'; // Close collection
            }
        } else {
            echo "<p>No collections found.</p>";
        }
        ?>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>
</html>
