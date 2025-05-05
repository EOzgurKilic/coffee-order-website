<?php
$servername = "localhost";
$username = "root";
$password = "1234";  // <-- Replace this with your actual password
$database = "coffee_shop";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

