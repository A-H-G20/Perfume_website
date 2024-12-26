<?php
session_start();

// Check if the user is logged in by verifying the session variables
if (!isset($_SESSION['id']) || !isset($_SESSION['role'])) {
    header("Location: login.php");
    exit();
}

// Get the user_id from the session
$user_id = $_SESSION['id']; 
include("connection.php");

// Handle delete item action
if (isset($_GET['delete'])) {
    $cart_id = $_GET['delete'];
    $delete_query = "DELETE FROM cart WHERE cart_id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $cart_id);
    $stmt->execute();
    header("Location: cart.php");
    exit();
}

// Handle update quantity action
if (isset($_POST['update'])) {
    $cart_id = $_POST['cart_id'];
    $quantity = $_POST['quantity'];
    $update_query = "UPDATE cart SET quantity = ? WHERE cart_id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ii", $quantity, $cart_id);
    $stmt->execute();
    header("Location: cart.php");
    exit();
}

// Fetch cart items for the user along with product details
$cart_query = "SELECT c.cart_id, p.products_id, p.name, p.price, p.description, p.image, c.quantity 
               FROM cart c 
               JOIN products p ON c.product_id = p.products_id
               WHERE c.user_id = ?";
$stmt = $conn->prepare($cart_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/collection.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">
    <link rel="stylesheet" href="css/cart.css">
    <title>Your Cart</title>
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

       
              
           

       

    </header>
<br><br><br><br><br><br><br><br><br><br>
    <h1>Your Cart</h1>
    <form method="post">
        <table border="1">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                 
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $totalPrice = 0;
                while ($row = $result->fetch_assoc()):
                    $total = $row['price'] * $row['quantity'];
                    $totalPrice += $total;
                ?>
                    <tr>
                        <td><img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="Product Image" width="100"></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td>
                            <input type="number" name="quantity" value="<?php echo htmlspecialchars($row['quantity']); ?>" min="1">
                        </td>
                        <td>$<?php echo number_format($row['price'], 2); ?></td>
                       
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td>
                            <a href="cart.php?delete=<?php echo $row['cart_id']; ?>">Delete</a>
                            <input type="hidden" name="cart_id" value="<?php echo $row['cart_id']; ?>">
                            <button type="submit" name="update">Update Quantity</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table><br>
        <h3>Total Price: $<?php echo number_format($totalPrice, 2); ?></h3><br>
        <a href="checkout.php"><button type="button">Proceed to Checkout</button></a>
                </form>

    <script src="js/all.js"></script>
</body>
</html>
<style>
 
</style>