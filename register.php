<?php
include 'header.php';
include 'db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO clients (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);
    
    if ($stmt->execute()) {
        $message = "Registration successful. You can now <a href='clientlogin.php'>login</a>.";
    } else {
        $message = "Registration failed: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<link rel="stylesheet" href="css/login.css">
<div class="login-container">
    <div class="login-box">
        <h2>Client Sign Up</h2>
        <?php if ($message) echo "<p>$message</p>"; ?>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
    </div>
</div>
<?php include 'footer.php'; ?>
