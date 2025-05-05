<?php
session_start();

$admin_user = "admin";
$admin_pass = "1234";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $admin_user && $password === $admin_pass) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}

include 'header.php';
?>

<link rel="stylesheet" href="css/login.css">

<div class="login-container">
    <div class="login-box">
        <h2>Admin Login</h2>
        <?php if (!empty($error)) echo "<p class='error-msg'>$error</p>"; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Admin Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p><a href="coffees.php">← Back to Home</a></p>
    </div>
</div>

<?php include 'footer.php'; ?>
