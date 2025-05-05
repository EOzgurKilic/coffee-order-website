<?php
session_start();
if (!isset($_SESSION['client_username'])) {
    header("Location: clientlogin.php");
    exit;
}
include 'header.php';
?>

<link rel="stylesheet" href="css/login.css">

<div class="login-container">
    <div class="login-box">
        <h2>
            Welcome,<br>
            <?php
            if (isset($_SESSION['client_username'])) {
                echo htmlspecialchars($_SESSION['client_username']);
            } else {
                echo "<span style='color:red'>[Unknown]</span>";
            }
            ?>
        </h2>
        <p>You are successfully logged in as a client.</p>
        <form action="clientlogout.php" method="post">
            <button type="submit">Log Out</button>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
