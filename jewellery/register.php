<?php
// Basic form handling (this is just for demo purposes — in production, validate and sanitize inputs properly)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $name     = $_POST["name"];
    $email    = $_POST["email"];
    $password = $_POST["password"];
    $confirm  = $_POST["confirm_password"];

    if ($password === $confirm) {
        header("location:index1.html");
        // You can add database storage logic here
    } else {
        echo "<p style='color: red; text-align: center;'>Passwords do not match.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .register-form {
            background: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        .register-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-group input:focus {
            border-color: #007bff;
            outline: none;
        }

        .form-submit {
            margin-top: 20px;
        }

        .form-submit input[type="submit"] {
            width: 100%;
            background: #007bff;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .form-submit input[type="submit"]:hover {
            background: #0056b3;
        }

        .admin-login {
            margin-top: 15px;
            text-align: center;
        }

        .admin-login a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        .admin-login a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <form class="register-form" method="post" action="">
        <h2>Create Account</h2>
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" name="name" id="name" required placeholder="John Doe">
        </div>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" required placeholder="email@example.com">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required placeholder="Enter password">
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password" required placeholder="Confirm password">
        </div>
        <div class="form-submit">
            <input type="submit" name="register" value="Register">
        </div>
        <div class="admin-login">
            <p>Are you an admin? <a href="admin-login.php">Login here</a></p>
        </div>
    </form>
</body>
</html>
