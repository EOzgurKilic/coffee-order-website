<?php
include 'header.php';
include 'db.php';
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, password FROM clients WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            $_SESSION["client_logged_in"] = true;
            $_SESSION["client_id"] = $user["id"];
            header("Location: coffees.php");
            exit;
        }
    }

    $error = "Invalid credentials";
}
?>

<link rel="stylesheet" href="css/login.css">
<div class="login-container">
    <div class="login-box">
        <h2>Client Login</h2>
        <?php if ($error) echo "<p class='error-msg'>$error</p>"; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</div>
<?php include 'footer.php'; ?>
