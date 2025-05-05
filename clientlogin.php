<?php
session_start();
include 'db.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM clients WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 1) {
        $user = $res->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['client_id'] = $user['id'];
            $_SESSION['client_username'] = $username;

          
            if (isset($_GET['redirect']) && $_GET['redirect'] === 'coffee_detail.php' && isset($_GET['coffee'])) {
                $coffee = urlencode($_GET['coffee']);
                header("Location: coffee_detail.php?coffee=$coffee");
                exit();
            }

           
            header("Location: coffees.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "User not found.";
    }

    $stmt->close();
}

$conn->close();
?>

<?php include 'header.php'; ?>
<link rel="stylesheet" href="css/login.css">

<div class="login-container">
    <div class="login-box">
        <h2>Client Login</h2>
        <?php if ($error): ?>
            <div class="error-msg"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
        </form>
        <br>
        <a href="register.php">← Don't have an account? Register</a>
    </div>
</div>

<?php include 'footer.php'; ?>
