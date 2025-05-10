<?php
session_start();

include 'db.php';

if (!isset($_SESSION['client_id']) || !isset($_SESSION['client_username'])) {
    header("Location: clientlogin.php");
    exit();
}

include 'header.php';
$client_name = $_SESSION['client_username'];
$client_id = $_SESSION['client_id'];
?>
<link rel="stylesheet" href="css/login.css">
<div class="login-container">
    <div class="login-box">
        <h2>
            Welcome,<br>
            <?php echo htmlspecialchars($client_name); ?>
        </h2>
        <p>You are successfully logged in as a client.</p>
        <form action="clientlogout.php" method="post">
            <button type="submit">Log Out</button>
        </form>
    </div>
</div>

<?php
$stmt = $conn->prepare("SELECT coffee_type, quantity, total_price, created_at, name, surname, address, status FROM orders WHERE client_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $client_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0): ?>
    <div class="order-history-panel">
        <h3>🛒 Your Order History</h3>

        <div class="order-table-scroll">
            <table>
                <tr>
                    <th>Coffee</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Address</th>
                    <th>Status</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['coffee_type']); ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td>$<?php echo number_format($row['total_price'], 2); ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['surname']); ?></td>
                        <td><?php echo htmlspecialchars($row['address']); ?></td>
                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>

        <?php?>
        <?php $result->data_seek(0);?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="mobile-order-card">
                <p><strong>Coffee:</strong> <?= htmlspecialchars($row['coffee_type']) ?></p>
                <p><strong>Quantity:</strong> <?= $row['quantity'] ?></p>
                <p><strong>Total Price:</strong> $<?= number_format($row['total_price'], 2) ?></p>
                <p><strong>Date:</strong> <?= $row['created_at'] ?></p>
                <p><strong>Name:</strong> <?= htmlspecialchars($row['name']) ?></p>
                <p><strong>Surname:</strong> <?= htmlspecialchars($row['surname']) ?></p>
                <p><strong>Address:</strong> <?= htmlspecialchars($row['address']) ?></p>
                <p><strong>Status:</strong> <?= htmlspecialchars($row['status']) ?></p>
            </div>
        <?php endwhile; ?>

    </div>
<?php else: ?>
    <p style="text-align:center; margin-top:30px;">📝 You haven't placed any orders yet.</p>
<?php endif;

$stmt->close();
$conn->close();

include 'footer.php';
?>