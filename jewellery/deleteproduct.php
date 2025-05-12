<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin-login.php");
    exit;
}

include 'conn.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['product_id'])) {
        $productId = $_POST['product_id'];

        // Get the image path first so we can delete the file
        $stmt = $conn->prepare("SELECT image FROM jewellerys WHERE Id = ?");
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $stmt->bind_result($imagePath);
        $stmt->fetch();
        $stmt->close();

        // Delete product from DB
        $stmt = $conn->prepare("DELETE FROM jewellerys WHERE Id = ?");
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $stmt->close();

        // Delete image from folder (optional, only if stored locally)
        if ($imagePath && file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Redirect back to the products page
        header("Location: products.php");
        exit;
    } else {
        echo "Product ID not provided.";
    }
} else {
    echo "Invalid request method.";
}
?>
