    <?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin-login.php");
    exit;
}

include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productName  = $_POST['product_name'];
    $productPrice = $_POST['product_price'];
    $image        = $_FILES['product_image'];

    if ($image['error'] === 0) {
        $targetDir = "uploads/";

        // Create uploads folder if it doesn't exist
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $targetFile = $targetDir . basename($image['name']);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if file is an actual image
        if (getimagesize($image['tmp_name'])) {
            if (move_uploaded_file($image['tmp_name'], $targetFile)) {
                $stmt = $conn->prepare("INSERT INTO jewellerys (product_name, product_price, image) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $productName, $productPrice, $targetFile);
                $stmt->execute();
                echo "<p style='color:green;'>Product added successfully!</p>";
            } else {
                echo "<p style='color:red;'>Failed to upload image. Please check folder permissions.</p>";
            }
        } else {
            echo "<p style='color:red;'>Only image files are allowed.</p>";
        }
    } else {
        echo "<p style='color:red;'>Error uploading image: " . $image['error'] . "</p>";
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6f9;
            display: flex;
        }

        .sidebar {
            width: 220px;
            background-color: #343a40;
            height: 100vh;
            padding-top: 30px;
            position: fixed;
            top: 0;
            left: 0;
            color: white;
        }

        .sidebar h2 {
            text-align: center;
            color: #fff;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            color: #ddd;
            padding: 15px 20px;
            text-decoration: none;
            font-weight: bold;
        }

        .sidebar a:hover {
            background-color: #007bff;
            color: white;
        }

        .main-content {
            margin-left: 220px;
            padding: 30px;
            width: 100%;
        }

        .header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logout-btn {
            background: #dc3545;
            border: none;
            padding: 8px 16px;
            color: white;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: #c82333;
        }

        .section {
            background: white;
            padding: 20px;
            margin-top: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th, table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #f1f1f1;
        }

        /* Form Styling */
        .form-container {
            background-color: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        .form-container label {
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
        }

        .form-container input[type="text"],
        .form-container input[type="number"],
        .form-container input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        .form-container button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #218838;
        }

    </style>
</head>
<body>

<div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="admin-dashboard.php">Users</a>
    <a href="#add-product">Add Product</a>
    <a href="products.php">Products</a>
    <a href="payment1.php">orders</a>
    <form action="logout.php" method="post" style="margin-top: 30px; text-align: center;">
        <button class="logout-btn" type="submit">Logout</button>
    </form>
</div>

<div class="main-content">
    <div class="header">
        <h1>Dashboard Overview</h1>
    </div>

    <!-- ADD NEW JEWELRY FORM -->
    <div id="add-product" class="section">
        <h2>Add New Jewellery</h2>
        <div class="form-container">
            <form action="" method="post" enctype="multipart/form-data">
                <label for="product_name">Product Name:</label>
                <input type="text" name="product_name" id="product_name" required>

                <label for="product_price">Price:</label>
                <input type="number" step="0.01" name="product_price" id="product_price" required>

                <label for="product_image">Image:</label>
                <input type="file" name="product_image" id="image" required>

                <button type="submit">Add Product</button>
            </form>
        </div>
    </div>

</div>

</body>
</html>
