<?php
include("connection.php");
session_start();

// Check if the user is logged in by verifying the session variables
if (!isset($_SESSION['id']) || !isset($_SESSION['role'])) {
    // If session variables are not set, redirect to the login page
    header("Location: login.php");
    exit(); // Make sure to stop the execution after redirecting
}

// Get the user_id from the session
$user_id = $_SESSION['id']; // Ensure you are getting the user_id from the session

// Fetch items for "men" category
$men_query = "SELECT products_id, name, image, price FROM products WHERE category = 'men' LIMIT 3";
$men_result = $conn->query($men_query);

// Fetch items for "women" category
$women_query = "SELECT products_id, name, image, price FROM products WHERE category = 'women' LIMIT 3";
$women_result = $conn->query($women_query);

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
    <title>Category</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href=".css">
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
            <label for="search-box" class="fas fa-search"></label>
        </form>
    </header><br><br><br><br><br>

    <section class="newArrivals" id="newArrivals">
        <h1 class="heading">New <span>Arrivals</span></h1>

        <!-- New Arrivals for Men -->
        <div class="swiper product-slider">
            <div class="swiper-wrapper">
                <?php while ($men_item = $men_result->fetch_assoc()): ?>
                    <div class="swiper-slide box" style="margin: 10px; text-align: center;">
                        <?php 
                            $image = $men_item['image'];
                            $imagePath = "uploads/" . $image;
                        ?>
                        <img src="<?php echo htmlspecialchars($imagePath); ?>" alt="Image" style="width: 200px; height: auto;">
                        <h3><?php echo htmlspecialchars($men_item['name']); ?></h3>
                        <div class="price">$<?php echo htmlspecialchars($men_item['price']); ?></div>
                        
                        <form method="POST" action="">
                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($men_item['products_id']); ?>">
                            <button type="submit" name="add_to_cart" class="btn">Add to Cart</button>
                        </form>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <!-- New Arrivals for Women -->
        <div class="swiper product-slider">
            <div class="swiper-wrapper">
                <?php while ($women_item = $women_result->fetch_assoc()): ?>
                    <div class="swiper-slide box" style="margin: 10px; text-align: center;">
                        <?php 
                            $image = $women_item['image'];
                            $imagePath = "uploads/" . $image;
                        ?>
                        <img src="<?php echo htmlspecialchars($imagePath); ?>" alt="Image" style="width: 200px; height: auto;">
                        <h3><?php echo htmlspecialchars($women_item['name']); ?></h3>
                        <div class="price">$<?php echo htmlspecialchars($women_item['price']); ?></div>
                        
                        <form method="POST" action="">
                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($women_item['products_id']); ?>">
                            <button type="submit" name="add_to_cart" class="btn">Add to Cart</button>
                        </form>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

    <footer>
        <h1>"Fill the Senses with the Mysterious"</h1>
        <div class="icons">
            <a href="https://www.facebook.com"><i class="fa-brands fa-square-facebook"></i></a>
            <a href="https://www.instagram.com"><i class="fa-brands fa-square-instagram"></i></a>
            <a href="https://wa.me"><i class="fa-brands fa-square-whatsapp"></i></a>
            <p>Copyright &copy; 2024 PerfumeLuxury®. All rights reserved</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="js/all.js"></script>
</body>
</html>
