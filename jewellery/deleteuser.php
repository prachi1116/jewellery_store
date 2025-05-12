<?php
session_start();

// Check admin login
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin-login.php");
    exit;
}

include 'conn.php'; // DB connection

// Validate user ID
if (isset($_GET['id'])) {
    $userId = intval($_GET['id']);

    // Run delete query
    $deleteQuery = "DELETE FROM users WHERE id = $userId";
    if (mysqli_query($conn, $deleteQuery)) {
        echo "<script>alert('User deleted successfully.'); window.location.href = 'admin-dashboard.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error deleting user: " . mysqli_error($conn) . "'); window.location.href = 'admin-dashboard.php';</script>";
    }
} else {
    echo "<script>alert('Invalid user ID.'); window.location.href = 'admin-dashboard.php';</script>";
}
?>

