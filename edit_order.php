<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

include 'db.php';
include 'header.php';
?>
<link rel="stylesheet" href="css/edit_order.css">

<div class="edit-container">
    <div class="edit-box">
        <h2>Edit Order</h2>

        <?php
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $result = $conn->query("SELECT * FROM orders WHERE id = $id");

            if ($result->num_rows > 0) {
                $order = $result->fetch_assoc();
        ?>

        <form action="update_order.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $order['id']; ?>">

            <input type="text" name="name" placeholder="First Name" value="<?php echo $order['name']; ?>" required><br>
            <input type="text" name="surname" placeholder="Last Name" value="<?php echo $order['surname']; ?>" required><br>
            <input type="text" name="phone" placeholder="Phone" value="<?php echo $order['phone']; ?>" required><br>
            <input type="text" name="address" placeholder="Address" value="<?php echo $order['address']; ?>" required><br>
            <input type="text" name="coffee_type" placeholder="Coffee Type" value="<?php echo $order['coffee_type']; ?>" required><br>
            <input type="number" name="quantity" placeholder="Quantity" value="<?php echo $order['quantity']; ?>" required><br>
            <input type="number" step="0.01" name="total_price" placeholder="Total Price" value="<?php echo $order['total_price']; ?>" readonly><br>


            <button type="submit">Update Order</button>
        </form>
        <script>
    const priceMap = {
        'Espresso': 2.50,
        'Latte': 3.50,
        'Cappuccino': 3.00,
        'Americano': 2.00,
        'Mocha': 4.00
    };

    const quantityInput = document.querySelector('input[name="quantity"]');
    const coffeeInput = document.querySelector('input[name="coffee_type"]');
    const priceInput = document.querySelector('input[name="total_price"]');

    function updateTotalPrice() {
        const qty = parseInt(quantityInput.value) || 0;
        const coffee = coffeeInput.value;
        const unitPrice = priceMap[coffee] || 0;
        const total = (qty * unitPrice).toFixed(2);
        priceInput.value = total;
    }

    quantityInput.addEventListener('input', updateTotalPrice);
    coffeeInput.addEventListener('input', updateTotalPrice);
</script>

        <?php
            } else {
                echo "<p>Order not found.</p>";
            }
        } else {
            echo "<p>No order ID provided.</p>";
        }

        $conn->close();
        ?>
    </div>
</div>

<?php include 'footer.php'; ?>
