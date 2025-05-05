<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>

<div class="page-wrapper">
    <?php include 'header.php'; ?>

    <div class="container">
        <h1>Admin Panel – Coffee Orders</h1>
        <p><a href="logout.php">Log out</a></p>

        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Coffee Type</th>
                    <th>Quantity</th>
                    <th>Total Price ($)</th>
                    <th>Order Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT * FROM orders ORDER BY created_at DESC");

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['surname']}</td>
                                <td>{$row['phone']}</td>
                                <td>{$row['address']}</td>
                                <td>{$row['coffee_type']}</td>
                                <td>{$row['quantity']}</td>
                                <td>\${$row['total_price']}</td>
                                <td>{$row['created_at']}</td>
                                <td>
                                    <a href='edit_order.php?id={$row['id']}'>Edit</a> | 
                                    <a href='delete_order.php?id={$row['id']}' onclick=\"return confirm('Are you sure you want to delete this order?');\">Delete</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No orders found.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
