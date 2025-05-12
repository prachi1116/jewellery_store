<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin-login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['product_id'])) {
    $orderId = $_POST['product_id'];

    $conn = new mysqli("localhost", "root", "", "jewellery");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepared statement for safe deletion
    $stmt = $conn->prepare("DELETE FROM orders WHERE id = ?");
    $stmt->bind_param("i", $orderId);

    if ($stmt->execute()) {
        // Redirect back to orders page after successful deletion
        header("Location: payment1.php");
        exit;
    } else {
        echo "Error deleting order: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    // Invalid request fallback
    header("Location: payment1.php");
    exit;
}
