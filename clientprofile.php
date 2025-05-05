<?php
session_start();
include 'db.php';

// If client is not logged in, redirect
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
// Fetch orders for this client
$stmt = $conn->prepare("SELECT coffee_type, quantity, total_price, created_at FROM orders WHERE client_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $client_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0): ?>
    <div style="max-width: 800px; margin: 40px auto; background: white; padding: 30px; border-radius: 10px;">
        <h3 style="text-align:center;">🛒 Your Order History</h3>
        <table style="width:100%; border-collapse: collapse; margin-top: 20px;">
            <tr style="background-color: #f4f4f4;">
                <th style="padding: 10px; border: 1px solid #ddd;">Coffee</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Quantity</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Total Price</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Date</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd;"><?php echo htmlspecialchars($row['coffee_type']); ?></td>
                <td style="padding: 10px; border: 1px solid #ddd;"><?php echo $row['quantity']; ?></td>
                <td style="padding: 10px; border: 1px solid #ddd;">$<?php echo number_format($row['total_price'], 2); ?></td>
                <td style="padding: 10px; border: 1px solid #ddd;"><?php echo $row['created_at']; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
<?php else: ?>
    <p style="text-align:center; margin-top:30px;">📭 You haven't placed any orders yet.</p>
<?php endif;

$stmt->close();
$conn->close();

include 'footer.php';
?>
