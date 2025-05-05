<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $coffee_type = $_POST['coffee_type'];
    $quantity = intval($_POST['quantity']);
    $total_price = floatval(str_replace(",", ".", $_POST['total_price'])); 

    $stmt = $conn->prepare("UPDATE orders SET name=?, surname=?, phone=?, address=?, coffee_type=?, quantity=?, total_price=? WHERE id=?");
    $stmt->bind_param("ssssssdi", $name, $surname, $phone, $address, $coffee_type, $quantity, $total_price, $id);

    if ($stmt->execute()) {
        header("Location: admin.php"); 
        exit();
    } else {
        echo "Error updating order: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
