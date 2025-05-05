<?php
include 'header.php';

$coffeeType = $_GET['coffee'] ?? "Unknown";

$prices = [
    "Espresso" => 2.50,
    "Latte" => 3.00,
    "Cappuccino" => 3.20,
    "Americano" => 2.80,
    "Mocha" => 3.50
];

$descriptions = [
    "Espresso" => "Strong and bold coffee, perfect for a quick energy boost.",
    "Latte" => "Smooth blend of espresso and steamed milk.",
    "Cappuccino" => "Classic Italian coffee with rich foam.",
    "Americano" => "Espresso with added hot water for a milder flavor.",
    "Mocha" => "Delicious mix of chocolate, espresso and milk."
];

$images = [
    "Espresso" => "images/espresso.jpg",
    "Latte" => "images/latte.jpg",
    "Cappuccino" => "images/cappuccino.jpg",
    "Americano" => "images/americano.jpg",
    "Mocha" => "images/mocha.jpg"
];

$description = $descriptions[$coffeeType] ?? "No description available.";
$price = $prices[$coffeeType] ?? 0;
$image = $images[$coffeeType] ?? "images/default.jpg";
?>

<link rel="stylesheet" href="css/coffee_detail.css">

<div class="detail-background">
    <div class="detail-container">
        <div class="coffee-info">
            <img src="<?php echo $image; ?>" alt="<?php echo $coffeeType; ?>">
            <h2><?php echo $coffeeType; ?></h2>
            <p><?php echo $description; ?></p>
        </div>

        <div class="order-form">
            <h3>Order Now</h3>
            <form action="order.php" method="post" oninput="calculateTotal()">
                <input type="text" name="name" placeholder="First Name" required><br>
                <input type="text" name="surname" placeholder="Last Name" required><br>
                <input type="text" name="phone" placeholder="Phone Number" required><br>
                <textarea name="address" placeholder="Delivery Address" required></textarea><br>

                <input type="hidden" name="coffee_type" value="<?php echo htmlspecialchars($coffeeType); ?>">
                <input type="hidden" id="price_per_cup" value="<?php echo $price; ?>">

                <label>Quantity:</label>
                <input type="number" id="quantity" name="quantity" placeholder="Quantity" min="1" required><br>

                <p><strong>Total Price:</strong> $<span id="total_price">0.00</span></p>
                <input type="hidden" name="total_price" id="total_price_input">

                <button type="submit">Place Order</button>
            </form>
        </div>
    </div>
</div>

<script>
function calculateTotal() {
    let price = parseFloat(document.getElementById('price_per_cup').value);
    let quantity = parseInt(document.getElementById('quantity').value);
    if (!isNaN(price) && !isNaN(quantity)) {
        let total = (price * quantity).toFixed(2);
        document.getElementById('total_price').innerText = total;
        document.getElementById('total_price_input').value = total;
    }
}
</script>

<?php include 'footer.php'; ?>
