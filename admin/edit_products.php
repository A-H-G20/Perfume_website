<?php
// Start session and include the database configuration
session_start();
require_once '../connection.php'; // Ensure this file contains your DB connection setup

// Check if the product ID is provided in the query string
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Fetch the product details from the database
    $sql = "SELECT * FROM products WHERE products_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    // If the product exists, fetch the details
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Product not found.";
        exit();
    }
} else {
    echo "Product ID not provided.";
    exit();
}

// Handle form submission for updating the product
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = $_POST['name'];
    $category = $_POST['category'];
    $collection = $_POST['collection'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Handle file upload for image
    $image = $product['image']; // Keep the current image if no new image is uploaded
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "../uploads/";
        $image = basename($_FILES['image']['name']);
        $targetFile = $targetDir . $image;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $image = $targetFile; // Update the image path if a new image is uploaded
        } else {
            echo "Error uploading the file.";
            exit();
        }
    }

    // Update the product in the database
    $updateSql = "UPDATE products SET name = ?, category = ?, collection = ?, price = ?, description = ?, image = ? WHERE products_id = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("ssssssi", $name, $category, $collection, $price, $description, $image, $productId);

    if ($stmt->execute()) {
        echo "Product updated successfully!";
        header("Location: fetch_products.php"); // Redirect back to the product list
        exit();
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
    <link rel="stylesheet" href="css/edit_products.css">
    <title>Edit Product</title>
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
    <h1>Edit Product</h1>
    <form  method="POST" enctype="multipart/form-data">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>

        <label for="category">Category:</label>
        <input type="text" id="category" name="category" value="<?php echo htmlspecialchars($product['category']); ?>" required>

        <label for="collection">Collection:</label>
        <select id="collection" name="collection" required>
            <option value="Spring" <?php echo ($product['collection'] == 'Spring') ? 'selected' : ''; ?>>Spring</option>
            <option value="Summer" <?php echo ($product['collection'] == 'Summer') ? 'selected' : ''; ?>>Summer</option>
            <option value="Fall" <?php echo ($product['collection'] == 'Fall') ? 'selected' : ''; ?>>Fall</option>
            <option value="Winter" <?php echo ($product['collection'] == 'Winter') ? 'selected' : ''; ?>>Winter</option>
        </select>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" value="<?php echo $product['price']; ?>" step="0.01" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea>

        <label for="image">Product Image:</label>
        <input type="file" id="image" name="image" accept="image/*">
        <p>Current Image: <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" width="100"></p>

        <button type="submit">Update Product</button>
    </form>
</body>
</html>
