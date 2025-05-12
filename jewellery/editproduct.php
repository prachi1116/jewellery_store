<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin-login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "jewellery");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$product = null;
$updateMessage = "";

// Get product ID from URL
if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];

    // Fetch product data
    $stmt = $conn->prepare("SELECT * FROM jewellerys WHERE Id = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();

    if (!$product) {
        die("Product not found.");
    }
}

// Handle update on POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product_id'];
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];
    $currentImage = $_POST['current_image'];
    $newImagePath = $currentImage;

    // Check if a new image was uploaded
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === 0) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $newImagePath = $targetDir . basename($_FILES['product_image']['name']);
        move_uploaded_file($_FILES['product_image']['tmp_name'], $newImagePath);

        // Optionally delete old image file
        if ($currentImage && file_exists($currentImage) && $currentImage !== $newImagePath) {
            unlink($currentImage);
        }
    }

    // Update product in DB
    $stmt = $conn->prepare("UPDATE jewellerys SET product_name = ?, product_price = ?, image = ? WHERE Id = ?");
    $stmt->bind_param("sssi", $name, $price, $newImagePath, $productId);
    $stmt->execute();
    $stmt->close();

    $updateMessage = "Product updated successfully!";
    // Refresh product data
    header("Location: products.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f9;
            padding: 30px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 6px;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        button {
            background-color: #28a745;
            border: none;
            padding: 10px 20px;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .back-btn {
            background-color: #007bff;
            text-decoration: none;
            color: white;
            padding: 10px 16px;
            border-radius: 5px;
        }

        .back-btn:hover {
            background-color: #0056b3;
        }

        img {
            max-width: 150px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .success {
            color: green;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Product</h2>

    <?php if ($product): ?>
        <?php if ($updateMessage): ?>
            <p class="success"><?= $updateMessage ?></p>
        <?php endif; ?>

        <form action="editproduct.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['Id']) ?>">
            <input type="hidden" name="current_image" value="<?= htmlspecialchars($product['image']) ?>">

            <label for="product_name">Product Name:</label>
            <input type="text" name="product_name" value="<?= htmlspecialchars($product['product_name']) ?>" required>

            <label for="product_price">Price (Rs):</label>
            <input type="number" name="product_price" step="0.01" value="<?= htmlspecialchars($product['product_price']) ?>" required>

            <label>Current Image:</label>
            <img src="<?= htmlspecialchars($product['image']) ?>" alt="Product Image">

            <label for="product_image">Change Image (optional):</label>
            <input type="file" name="product_image" accept="image/*">

            <div class="form-actions">
                <button type="submit">Update Product</button>
                <a href="products.php" class="back-btn">Back to Products</a>
            </div>
        </form>
    <?php else: ?>
        <p>Product not found.</p>
    <?php endif; ?>
</div>

</body>
</html>
