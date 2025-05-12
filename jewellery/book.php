<?php
include 'conn.php';

$jewellery = [
    "necklace" => ["name" => "Gold Necklace", "price" => 3000],
    "gold chain necklace" => ["name" => "Gold Necklace", "price" => 3500],
    "heart necklace" => ["name" => "Heart Necklace", "price" => 2000],
    "ring"     => ["name" => "Diamond Ring", "price" => 1800],
    "diamond ring"     => ["name" => "Diamond Ring", "price" => 4000],
    "earnings" => ["name" => "Earrings", "price" => 1500],
    "pendal" => ["name" => "pendal", "price" => 80000],
    
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_key = $_POST["product"];
    $quantity    = (int) $_POST["quantity"];

    if (isset($jewellery[$product_key])) {
        $product = $jewellery[$product_key];
        $price   = $product["price"];
        $total   = $price * $quantity;
        $product_name = $product["name"];

        $sql = "INSERT INTO products (product_name, price_per_item, quantity, total_price)
                VALUES ('$product_name', $price, $quantity, $total)";
        if (mysqli_query($conn, $sql)) {
            header("Location: payment.php?product=" . urlencode($product_name) . "&price=$price&quantity=$quantity&total=$total");
            exit;
        } else {
            echo "<p style='color:red;'>Database error: " . mysqli_error($conn) . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jewellery Order</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .order-box {
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            border: 1px solid #ddd;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            max-width: 500px;
            width: 100%;
        }

        h2 {
            text-align: center;
            color: #b5854a;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }

        select, input[type="number"] {
            width: 100%;
            padding: 10px 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .submit-btn {
            background: #b5854a;
            color: white;
            border: none;
            padding: 12px;
            font-size: 16px;
            width: 100%;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .submit-btn:hover {
            background: #926b38;
        }

        .form-group p {
            margin: 8px 0 0;
            font-size: 15px;
        }

        #priceDisplay, #totalDisplay {
            font-weight: bold;
        }
    </style>
    <script>
        const products = <?= json_encode($jewellery) ?>;

        function updateTotal() {
            const productKey = document.getElementById("product").value;
            const quantity = parseInt(document.getElementById("quantity").value);
            const price = products[productKey]["price"];
            const total = price * quantity;

            document.getElementById("priceDisplay").innerText = "₹" + price.toLocaleString();
            document.getElementById("totalDisplay").innerText = "₹" + total.toLocaleString();
        }

        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("product").addEventListener("change", updateTotal);
            document.getElementById("quantity").addEventListener("input", updateTotal);
            updateTotal();
        });
    </script>
</head>
<body>
    <div class="order-box">
        <h2>Jewellery Order</h2>
        <form method="post">
            <div class="form-group">
                <label for="product">Select Jewellery</label>
                <select name="product" id="product" required>
                    <?php foreach ($jewellery as $key => $item): ?>
                        <option value="<?= $key ?>"><?= $item["name"] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" id="quantity" required min="1" value="1">
            </div>

            <div class="form-group">
                <p>Price per item: <span id="priceDisplay"></span></p>
                <p>Total Price: <span id="totalDisplay"></span></p>
            </div>

            <input type="submit" value="Place Order" class="submit-btn">
        </form>
    </div>
</body>
</html>
