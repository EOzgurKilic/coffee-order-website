<?php
$servername = "localhost";
$username = "root"; // Şifre koyduysan buraya eklemelisin
$password = "";
$dbname = "coffee_shop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
?>
