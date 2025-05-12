<?php
// Database connection
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
    <title>View Jewellery Products</title>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background-color: #f4f4f4; }
        h2 { margin-bottom: 20px; }
        img { border-radius: 8px; }
        .logout-btn {
            background: #dc3545;
            border: none;
            color: white;
            padding: 6px 12px;
            cursor: pointer;
            border-radius: 4px;
        }
        .success-msg {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>
<body>

    <h2>Jewellery Products</h2>

    <?php if (isset($_GET['deleted'])): ?>
        <div class="success-msg">Product deleted successfully!</div>
    <?php endif; ?>

    <table id="productsTable" class="display">
        <thead>
            <tr>
                <th>ID</th><th>Name</th><th>Price</th><th>Image</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($product = $products->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($product['Id']) ?></td>
                    <td><?= htmlspecialchars($product['product_name']) ?></td>
                    <td>$<?= htmlspecialchars($product['product_price']) ?></td>
                    <td><img src="<?= htmlspecialchars($product['image']) ?>" width="100" alt="Product Image"></td>
                    <td>
                        <form action="delete-product.php" method="post" onsubmit="return confirm('Are you sure you want to delete this product?');">
                            <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['Id']) ?>">
                            <button type="submit" class="logout-btn">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#productsTable').DataTable();
        });
    </script>

</body>
</html>
