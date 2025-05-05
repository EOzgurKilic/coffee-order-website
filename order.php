<?php
include 'db.php';
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $surname = $_POST['surname'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    $coffee_type = $_POST['coffee_type'] ?? '';
    $quantity = intval($_POST['quantity'] ?? 0);
    $total_price = floatval(str_replace(",", ".", $_POST['total_price'] ?? '0'));

    if ($name && $surname && $phone && $address && $coffee_type && $quantity > 0) {
        $stmt = $conn->prepare("INSERT INTO orders (name, surname, phone, address, coffee_type, quantity, total_price) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssid", $name, $surname, $phone, $address, $coffee_type, $quantity, $total_price);

        if ($stmt->execute()) {
            ?>
            <link rel="stylesheet" href="css/order.css">
            <div class="confirmation-container">
                <div class="confirmation-box">
                    <img src="images/check.png" alt="Success" class="check-icon">
                    <h1>Thank You!</h1>
                    <p>Your order for <strong><?php echo $quantity . ' ' . $coffee_type; ?></strong> has been received.</p>
                    <p>Total Price: <strong>$<?php echo number_format($total_price, 2); ?></strong></p>
                    <a href="coffees.php" class="back-button">← Back to Menu</a>
                </div>
            </div>
            <?php
        } else {
            echo "<p style='color:red; text-align:center;'>❌ Database error: " . $conn->error . "</p>";
        }

        $stmt->close();
    } else {
        echo "<p style='color:red; text-align:center;'>⚠️ Missing required form data. Please try again.</p>";
    }

    $conn->close();
} else {
    echo "<p style='color:red; text-align:center;'>Invalid request method.</p>";
}

include 'footer.php';
?>
