<?php
session_start();
if (!isset($_SESSION['client_logged_in']) || $_SESSION['client_logged_in'] !== true) {
    header("Location: clientlogin.php");
    exit();
}
?>

<?php include 'header.php'; ?>
<link rel="stylesheet" href="css/login.css"> <!-- Reuse same style -->

<div class="login-container">
    <div class="login-box">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['client_username']); ?>!</h2>
        <p>You are successfully logged in as a client.</p>
        <br>
        <form action="clientlogout.php" method="post">
            <button type="submit">Log Out</button>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
