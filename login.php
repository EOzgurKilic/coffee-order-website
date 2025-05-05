<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
?>

<?php include 'header.php'; ?>
<link rel="stylesheet" href="css/login.css">

<div class="login-container">
    <div class="login-box">
        <h2>Admin Login</h2>
        <?php if (!empty($error)): ?>
            <p class="error-msg"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
        </form>
        <p><a href="coffees.php">← Back to Home</a></p>
    </div>
</div>

<?php include 'footer.php'; ?>
