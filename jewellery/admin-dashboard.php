<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin-login.php");
    exit;
}

include 'conn.php'; // Include your database connection file




// Fetch Users and Products
$users = $conn->query("SELECT * FROM users");

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

    </style>
</head>
<body>

<div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="#users">Users detail</a>
    <a href="addproduct.php">Add Product</a>
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

    <!-- USERS TABLE -->
    <div id="users" class="section">
        <h2>Users</h2>
        <table>
            <tr>
                <th>ID</th><th>Full Name</th><th>Email</th><th>Password</th>
            </tr>
            <?php while ($user = $users->fetch_assoc()): ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['password']) ?></td>
                   
        <td>
            <a href="deleteuser.php?id=<?= $user['id'] ?>" 
               onclick="return confirm('Are you sure you want to delete this user?');" 
               style="color: red; font-weight: bold; text-decoration: none; padding: 5px 10px; background-color: #f44336; color: white; border-radius: 5px;">
               Delete
            </a>
        </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

 

 
</div>

</body>
</html>
