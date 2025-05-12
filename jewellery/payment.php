<?php
include 'conn.php'; // Ensure this file connects to your MySQL database

$product = $_GET["product"] ?? "Unknown";
$price = $_GET["price"] ?? 0;
$quantity = $_GET["quantity"] ?? 0;
$total = $_GET["total"] ?? 0;

$payment_success = false;
$selected_method = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $selected_method = $_POST["payment_method"] ?? "Unknown";

    // Save payment info to database
    $sql = "INSERT INTO orders (product_name, price_per_item, quantity, total, payment_method)
            VALUES ('$product', $price, $quantity, $total, '$selected_method')";
    if (mysqli_query($conn, $sql)) {
        $payment_success = true;
    } else {
        echo "<p style='color:red;'>Payment DB error: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Payment</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            padding: 50px;
        }

        .payment-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 500px;
            width: 100%;
        }

        h2 {
            text-align: center;
            color: #4caf50;
        }

        .details p {
            margin: 8px 0;
            font-size: 16px;
        }

        .payment-methods {
            margin-top: 20px;
        }

        .payment-methods label {
            display: block;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .pay-btn {
            margin-top: 20px;
            padding: 12px;
            width: 100%;
            background: #4caf50;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        .pay-btn:hover {
            background: #388e3c;
        }

        .success-box {
            background: #e8f5e9;
            border-left: 5px solid #4caf50;
            padding: 15px;
            margin-top: 25px;
            border-radius: 6px;
        }
    </style>
</head>
<body>
    <div class="payment-box">
        <h2>Payment Page</h2>
        <?php if ($payment_success): ?>
            <div class="success-box">
                <p><strong>Payment Method:</strong> <?= htmlspecialchars($selected_method) ?></p>
                <p><strong>Total amount:</strong> ₹<?= number_format($total) ?></p>
                <p style="color: green;"><strong>Thank you! Your order has been placed successfully.</strong></p>
                <a href="index1.html">back to home</a>
            </div>
        <?php else: ?>
            <div class="details">
                <p><strong>Product:</strong> <?= htmlspecialchars($product) ?></p>
                <p><strong>Price per item:</strong> ₹<?= number_format($price) ?></p>
                <p><strong>Quantity:</strong> <?= $quantity ?></p>
                <hr>
                <p><strong>Total:</strong> ₹<?= number_format($total) ?></p>
            </div>

            <form method="post">
                <div class="payment-methods">
                    <p><strong>Select Payment Method :</strong></p>
                    <label><input type="radio" name="payment_method" value="Cash on Delivery" required> Cash on Delivery</label>
                    <label><input type="radio" name="payment_method" value="UPI" required> UPI</label>
                    <label><input type="radio" name="payment_method" value="Credit/Debit Card" required> Credit/Debit Card</label>
                    <label><input type="radio" name="payment_method" value="Net Banking" required> Net Banking</label>
                </div>

                <input type="hidden" name="total" value="<?= $total ?>">
                <button type="submit" class="pay-btn">Pay Now</button>
            </form>
        <?php endif; ?>
    </div>

</body>
</html>
