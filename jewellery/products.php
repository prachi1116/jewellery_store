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
$products = $conn->query("SELECT * FROM jewellerys");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - View Products</title>
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

        .sidebar form {
            text-align: center;
            margin-top: 30px;
        }

        .logout-btn {
            background: #dc3545;
            border: none;
            padding: 10px 20px;
            color: white;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: #c82333;
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
            margin-bottom: 30px;
        }

        .section {
            background: white;
            padding: 20px;
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
            text-align: center;
        }

        table th {
            background-color: #f1f1f1;
        }

        img {
            border-radius: 8px;
        }

        button {
            padding: 6px 12px;
            background-color: #dc3545;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        button.edit-btn {
            background-color: #28a745;
            margin-right: 5px;
        }

        button:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="admin-dashboard.php">Users</a>
    <a href="addproduct.php">Add Product</a>
    <a href="products.php">Products</a>
    <a href="payment1.php">orders</a>
    <form action="logout.php" method="post">
        <button class="logout-btn" type="submit">Logout</button>
    </form>
</div>

<div class="main-content">
    <div class="header">
        <h1>Jewellery Products</h1>
    </div>

    <div class="section">
        <table>
            <thead>
                <tr>
                    <th>ID</th><th>Name</th><th>Price</th><th>Image</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($product = $products->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($product['Id']) ?></td>
                        <td><?= htmlspecialchars($product['product_name']) ?></td>
                        <td>Rs <?= htmlspecialchars($product['product_price']) ?></td>
                        <td><img src="<?= htmlspecialchars($product['image']) ?>" width="100" alt="Product Image"></td>
                        <td>
                            <form action="editproduct.php" method="get" style="display:inline;">
                                <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['Id']) ?>">
                                <button type="submit" class="edit-btn">Edit</button>
                            </form>

                            <form action="deleteproduct.php" method="post" onsubmit="return confirm('Delete this item?');" style="display:inline;">
                                <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['Id']) ?>">
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
