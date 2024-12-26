<?php
// Start session and include the database configuration
session_start();
require_once '../connection.php'; // Ensure this file contains your DB connection setup

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = $_POST['name'];
    $category = $_POST['category']; // Category (Men or Women)
    $collection = $_POST['collection']; // Collection (Spring, Winter, etc.)
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Handle file upload
    $image = '';
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "../uploads/";
        $image = basename($_FILES['image']['name']);
        $targetFile = $targetDir . $image;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $image = $targetFile; // Store the image path in the database
        } else {
            echo "Error uploading the file.";
            exit();
        }
    }

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO products (name, image, category, collection, price, description) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssds", $name, $image, $category, $collection, $price, $description);

    if ($stmt->execute()) {
        // Redirect to fetch_products.php after successful insertion
        header("Location: fetch_products.php");
        exit(); // Make sure no further code is executed
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
    <link rel="stylesheet" href="css/add_products.css">
    <title>Add Product</title>
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
   
    <form action="" method="POST" enctype="multipart/form-data">
    <h1>Add Product</h1>
        <input type="text" id="name" name="name" required placeholder="products name"><br><br>

        
       

       
        <select id="category" name="category" required>
            <option value="Men">Men</option>
            <option value="Women">Women</option>
        </select><br><br>

        
        <input type="text" id="collection" name="collection" required placeholder="collection"><br><br>

        
        <input type="number" id="price" name="price" step="0.01" required placeholder="Price"><br><br>

       
        <textarea id="description" name="description" required placeholder="description"></textarea><br><br>
        <input type="file" id="image" name="image" accept="image/*" required placeholder="products image"><br><br>

        <button type="submit">Add Product</button>
    </form>
</body>
</html>
